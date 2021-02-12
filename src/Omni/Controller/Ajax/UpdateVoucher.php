<?php

namespace Ls\Omni\Controller\Ajax;

use Exception;
use \Ls\Omni\Helper\BasketHelper;
use \Ls\Omni\Helper\Data;
use \Ls\Omni\Helper\VoucherHelper;
use Magento\Checkout\Model\Session\Proxy;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Model\Quote;

/**
 * Class UpdatePoints
 * @package Ls\Omni\Controller\Ajax
 */
class UpdateVoucher extends Action
{

    /** @var JsonFactory */
    public $resultJsonFactory;

    /** @var RawFactory */
    public $resultRawFactory;

    /** @var VoucherHelper */
    public $voucherHelper;

    /**
     * @var BasketHelper
     */
    public $basketHelper;

    /**
     * @var Proxy
     */
    public $checkoutSession;

    /**
     * @var \Magento\Customer\Model\Session\Proxy
     */
    public $customerSession;

    /**
     * @var CartRepositoryInterface
     */
    public $cartRepository;

    /**
     * @var \Magento\Framework\Pricing\Helper\Data
     */
    public $priceHelper;

    /**
     * @var Data
     */
    public $data;

    /**
     * UpdateVoucher constructor.
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param RawFactory $resultRawFactory
     * @param \Magento\Customer\Model\Session\Proxy $customerSession
     * @param VoucherHelper $voucherHelper
     * @param BasketHelper $basketHelper
     * @param Proxy $checkoutSession
     * @param CartRepositoryInterface $cartRepository
     * @param \Magento\Framework\Pricing\Helper\Data $priceHelper
     * @param Data $data
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        RawFactory $resultRawFactory,
        \Magento\Customer\Model\Session\Proxy $customerSession,
        VoucherHelper $voucherHelper,
        BasketHelper $basketHelper,
        Proxy $checkoutSession,
        CartRepositoryInterface $cartRepository,
        \Magento\Framework\Pricing\Helper\Data $priceHelper,
        Data $data
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->resultRawFactory  = $resultRawFactory;
        $this->voucherHelper    = $voucherHelper;
        $this->basketHelper      = $basketHelper;
        $this->checkoutSession   = $checkoutSession;
        $this->customerSession   = $customerSession;
        $this->cartRepository    = $cartRepository;
        $this->priceHelper       = $priceHelper;
        $this->data              = $data;
    }

    /**
     * @return ResponseInterface|Json|Raw|ResultInterface
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $httpBadRequestCode = 400;
        /** @var Raw $resultRaw */
        $resultRaw = $this->resultRawFactory->create();
        if ($this->getRequest()->getMethod() !== 'POST' || !$this->getRequest()->isXmlHttpRequest()) {
            return $resultRaw->setHttpResponseCode($httpBadRequestCode);
        }

        /** @var Json $resultJson */
        $resultJson            = $this->resultJsonFactory->create();
        $base_currency         = $this->checkoutSession->getQuote()->getBaseCurrencyCode();
        $post                  = $this->getRequest()->getContent();
        $postData              = json_decode($post);
        $voucherNo            = $postData->voucher_no;
        $voucherAmount        = $postData->voucher_amount;
        $voucherBalanceAmount = 0;
        $cartId                = $this->checkoutSession->getQuoteId();
        $quote                 = $this->cartRepository->get($cartId);
        if ($voucherNo != null && $voucherAmount != 0) {
            // see Helper Folder
            $voucherResponse = $this->voucherHelper->getVoucherBalance($voucherNo);

            if (is_object($voucherResponse)) {
                $voucherBalanceAmount = $voucherResponse->getBalance();
            } else {
                $voucherBalanceAmount = $voucherResponse;
            }
        } else {
            $response = [
                'success' => 'true',
                'message' => __(
                    'You have successfully cancelled the voucher.'
                )
            ];
            $quote->setLsVoucherNo($voucherNo);
            $quote->setLsVoucherAmountUsed($voucherAmount);
            $quote->setCouponCode($this->checkoutSession->getCouponCode());
            $this->validateQuote($quote);
            $quote->collectTotals();
            $this->cartRepository->save($quote);
            return $resultJson->setData($response);
        }

        if (empty($voucherResponse)) {
            $response = [
                'error'   => 'true',
                'message' => __(
                    'The voucher code %1 is not valid.',
                    $voucherNo
                )
            ];
            return $resultJson->setData($response);
        }

        $orderBalance = $this->data->getOrderBalance(
            0,
            $quote->getLsPointsSpent(),
            $this->basketHelper->getBasketSessionValue()
        );

        $isVoucherAmountValid = $this->voucherHelper->isVoucherAmountValid(
            $orderBalance,
            $voucherAmount,
            $voucherBalanceAmount
        );

        if (!is_numeric($voucherAmount) || $voucherAmount < 0 || !$isVoucherAmountValid) {
            $response = [
                'error'   => 'true',
                'message' => __(
                    'The applied amount %3' .
                    ' is greater than voucher balance amount (%1) or it is greater than order balance (Excl. Shipping Amount) (%2).',
                    $this->priceHelper->currency($voucherBalanceAmount, true, false),
                    $this->priceHelper->currency($orderBalance, true, false),
                    $this->priceHelper->currency($voucherAmount, true, false)
                )
            ];
            return $resultJson->setData($response);
        }
        try {
            if ($isVoucherAmountValid) {
                $quote->setLsVoucherNo($voucherNo);
                $quote->setLsVoucherAmountUsed($voucherAmount);
                $this->validateQuote($quote);
                $quote->collectTotals();
                $this->cartRepository->save($quote);
                $response = ['success' => 'true'];
            } else {
                $response = [
                    'error'   => 'true',
                    'message' => __(
                        'The voucher amount "%1" is not valid.',
                        $this->priceHelper->currency($voucherAmount, true, false)
                    )
                ];
            }
        } catch (Exception $e) {
            $response = ['error' => 'true', 'message' => $e->getMessage()];
        }
        return $resultJson->setData($response);
    }

    /**
     * @param Quote $quote
     * @return void
     * @throws LocalizedException
     */
    protected function validateQuote(Quote $quote)
    {
        if ($quote->getItemsCount() === 0) {
            throw new LocalizedException(
                __('Totals calculation is not applicable to empty cart.')
            );
        }
    }
}
