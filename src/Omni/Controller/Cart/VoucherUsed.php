<?php

namespace Ls\Omni\Controller\Cart;

use Exception;
use \Ls\Omni\Helper\BasketHelper;
use \Ls\Omni\Helper\Data;
use \Ls\Omni\Helper\VoucherHelper;
use Magento\Checkout\Model\Cart;
use Magento\Checkout\Model\Session\Proxy;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class VoucherUsed extends \Magento\Checkout\Controller\Cart
{
    /**
     * Sales quote repository
     *
     * @var CartRepositoryInterface
     */
    public $quoteRepository;

    /**
     * @var VoucherHelper
     */
    public $voucherHelper;

    /**
     * @var BasketHelper
     */
    public $basketHelper;

    /**
     * @var \Magento\Framework\Pricing\Helper\Data
     */
    public $priceHelper;

    /**
     * @var Data
     */
    public $data;

    /**
     * VoucherHelper constructor.
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param Proxy $checkoutSession
     * @param StoreManagerInterface $storeManager
     * @param Validator $formKeyValidator
     * @param Cart $cart
     * @param CartRepositoryInterface $quoteRepository
     * @param VoucherHelper $voucherHelper
     * @param BasketHelper $basketHelper
     * @param \Magento\Framework\Pricing\Helper\Data $priceHelper
     * @param Data $data
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        Proxy $checkoutSession,
        StoreManagerInterface $storeManager,
        Validator $formKeyValidator,
        Cart $cart,
        CartRepositoryInterface $quoteRepository,
        VoucherHelper $voucherHelper,
        BasketHelper $basketHelper,
        \Magento\Framework\Pricing\Helper\Data $priceHelper,
        Data $data
    ) {
        parent::__construct(
            $context,
            $scopeConfig,
            $checkoutSession,
            $storeManager,
            $formKeyValidator,
            $cart
        );
        $this->quoteRepository = $quoteRepository;
        $this->voucherHelper  = $voucherHelper;
        $this->priceHelper     = $priceHelper;
        $this->basketHelper    = $basketHelper;
        $this->data            = $data;
    }

    /**
     * Initialize coupon
     *
     * @return Redirect
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $voucherNo            = $this->getRequest()->getParam('voucherno');
        $voucherBalanceAmount = 0;
        $voucherAmount        = $this->getRequest()->getParam('removevoucher') == 1
            ? 0
            : trim($this->getRequest()->getParam('voucheramount'));

        $voucherAmount = (float)$voucherAmount;
        try {
            if (!is_numeric($voucherAmount) || $voucherAmount < 0) {
                $this->messageManager->addErrorMessage(
                    __(
                        'The voucher Amount "%1" is not valid.',
                        $this->priceHelper->currency($voucherAmount, true, false)
                    )
                );
                return $this->_goBack();
            }
            if ($voucherNo != null) {
                $voucherResponse = $this->voucherHelper->getVoucherBalance($voucherNo);

                if (is_object($voucherResponse)) {
                    $voucherBalanceAmount = $voucherResponse->getBalance();
                } else {
                    $voucherBalanceAmount = $voucherResponse;
                }
            }

            if (empty($voucherResponse)) {
                $this->messageManager->addErrorMessage(__('The voucher code %1 is not valid.', $voucherNo));
                return $this->_goBack();
            }

            $cartQuote    = $this->cart->getQuote();
            $itemsCount   = $cartQuote->getItemsCount();
            // voucher 
            $orderBalance = $this->data->getOrderBalance(
                0,
                0,
                $cartQuote->getLsPointsSpent(),
                $this->basketHelper->getBasketSessionValue()
            );

            $isVoucherAmountValid = $this->voucherHelper->isVoucherAmountValid(
                $orderBalance,
                $voucherAmount,
                $voucherBalanceAmount
            );

            if ($isVoucherAmountValid == false) {
                $this->messageManager->addErrorMessage(
                    __(
                        'The applied amount %3' .
                        ' is greater than voucher balance amount (%1) or it is greater than order balance (Excl. Shipping Amount) (%2).',
                        $this->priceHelper->currency(
                            $voucherBalanceAmount,
                            true,
                            false
                        ),
                        $this->priceHelper->currency(
                            $orderBalance,
                            true,
                            false
                        ),
                        $this->priceHelper->currency(
                            $voucherAmount,
                            true,
                            false
                        )
                    )
                );
                return $this->_goBack();
            }
            if ($itemsCount && !empty($voucherResponse) && $isVoucherAmountValid) {
                $cartQuote->getShippingAddress()->setCollectShippingRates(true);
                $cartQuote->setLsVoucherAmountUsed($voucherAmount)->collectTotals();
                $cartQuote->setLsVoucherNo($voucherNo)->collectTotals();
                $cartQuote->setCouponCode($this->_checkoutSession->getCouponCode())->collectTotals();
                $this->quoteRepository->save($cartQuote);
            }
            if ($voucherAmount) {
                if ($itemsCount) {
                    if (!empty($voucherResponse) && $isVoucherAmountValid) {
                        $this->_checkoutSession->getQuote()->setLsVoucherAmountUsed($voucherAmount)->save();
                        $this->_checkoutSession->getQuote()->setLsVoucherNo($voucherNo)->save();
                        $this->messageManager->addSuccessMessage(
                            __(
                                'You have used "%1" amount from voucher.',
                                $this->priceHelper->currency($voucherAmount, true, false)
                            )
                        );
                    } else {
                        $this->messageManager->addErrorMessage(
                            __(
                                'The voucher amount "%1" is not valid.',
                                $this->getBaseCurrencyCode() . $voucherAmount
                            )
                        );
                    }
                } else {
                    $this->messageManager->addErrorMessage(
                        __(
                            "Voucher cannot be applied."
                        )
                    );
                }
            } else {
                if ($voucherAmount == 0) {
                    $this->_checkoutSession->getQuote()->setLsVoucherNo(null)->save();
                }
                $this->messageManager->addSuccessMessage(__('You have successfully cancelled the voucher.'));
            }
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(__('Voucher cannot be applied.'));
        }

        return $this->_goBack();
    }

    /**
     * @return string
     */
    public function getBaseCurrencyCode()
    {
        return $this->_checkoutSession->getQuote()->getBaseCurrencyCode();
    }
}
