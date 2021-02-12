<?php

namespace Ls\Omni\Observer;

use Exception;
use \Ls\Core\Model\LSR;
use \Ls\Omni\Client\Ecommerce\Entity\OneList;
use \Ls\Omni\Client\Ecommerce\Entity\Order;
use \Ls\Omni\Exception\InvalidEnumException;
use \Ls\Omni\Helper\BasketHelper;
use \Ls\Omni\Helper\Data;
use \LS\Omni\Helper\ItemHelper;
use Magento\Checkout\Model\Session\Proxy as CheckoutProxy;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

/**
 * CartObserver Observer
 * This class is overriding in hospitality module
 */
class CartObserver implements ObserverInterface
{

    /**
     * @var BasketHelper
     */
    public $basketHelper;

    /**
     * @var ItemHelper
     */
    public $itemHelper;

    /**
     * @var LoggerInterface
     */
    public $logger;

    /**
     * @var CheckoutProxy
     */
    public $checkoutSession;

    /**
     * @var bool
     */
    public $watchNextSave = false;

    /**
     * @var LSR
     */
    public $lsr;

    /**
     * @var Data
     */
    public $data;

    /**
     * CartObserver constructor.
     * @param BasketHelper $basketHelper
     * @param ItemHelper $itemHelper
     * @param LoggerInterface $logger
     * @param CheckoutProxy $checkoutSession
     * @param LSR $LSR
     * @param Data $data
     */
    public function __construct(
        BasketHelper $basketHelper,
        ItemHelper $itemHelper,
        LoggerInterface $logger,
        CheckoutProxy $checkoutSession,
        LSR $LSR,
        Data $data
    ) {
        $this->basketHelper    = $basketHelper;
        $this->itemHelper      = $itemHelper;
        $this->logger          = $logger;
        $this->checkoutSession = $checkoutSession;
        $this->lsr             = $LSR;
        $this->data            = $data;
    }

    /**
     * @param Observer $observer
     * @return $this|void
     * @throws NoSuchEntityException
     * @throws InvalidEnumException
     * @throws LocalizedException
     */
    public function execute(Observer $observer)
    {
        /*
          * Adding condition to only process if LSR is enabled.
          */
        if ($this->lsr->isLSR($this->lsr->getCurrentStoreId())) {
            try {
                $quote      = $this->checkoutSession->getQuote();
                $couponCode = $this->basketHelper->getCouponCodeFromCheckoutSession();
                // This will create one list if not created and will return onelist if its already created.
                /** @var OneList|null $oneList */
                $oneList = $this->basketHelper->get();
                // add items from the quote to the oneList and return the updated onelist
                $oneList = $this->basketHelper->setOneListQuote($quote, $oneList);
                if (!empty($couponCode)) {
                    $status = $this->basketHelper->setCouponCode($couponCode);
                    if (!is_object($status)) {
                        $this->basketHelper->setCouponCodeInCheckoutSession('');
                    }
                }
                if (count($quote->getAllItems()) == 0) {
                    $quote->setLsGiftCardAmountUsed(0);
                    $quote->setLsGiftCardNo(null);
                    $quote->setLsPointsSpent(0);
                    $quote->setLsPointsEarn(0);
                    $quote->setGrandTotal(0);
                    $quote->setBaseGrandTotal(0);
                    $this->basketHelper->quoteRepository->save($quote);
                }
                /** @var Order $basketData */
                $basketData = $this->basketHelper->update($oneList);
                $this->itemHelper->setDiscountedPricesForItems($quote, $basketData);
                if (!empty($basketData)) {
                    $this->checkoutSession->getQuote()->setLsPointsEarn($basketData->getPointsRewarded())->save();
                }
                if ($this->checkoutSession->getQuote()->getLsGiftCardAmountUsed() > 0 ||
                    $this->checkoutSession->getQuote()->getLsPointsSpent() > 0) {
                    $this->data->orderBalanceCheck(
                        $this->checkoutSession->getQuote()->getLsGiftCardNo(),
                        $this->checkoutSession->getQuote()->getLsGiftCardAmountUsed(),
                        $this->checkoutSession->getQuote()->getLsPointsSpent(),
                        $basketData
                    );
                }
            } catch (Exception $e) {
                $this->logger->error($e->getMessage());
            }
        }
        return $this;
    }
}
