<?php

namespace Ls\Omni\Block\Cart;

use \Ls\Omni\Helper\VoucherHelper;
use Magento\Checkout\Block\Cart\AbstractCart;
use Magento\Checkout\Model\Session\Proxy;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Voucher
 * @package Ls\Omni\Block\Cart
 */
class Voucher extends AbstractCart
{

    /**
     * @var VoucherHelper
     */
    public $voucherHelper;

    /**
     * Voucher constructor.
     * @param VoucherHelper $voucherHelper
     * @param Context $context
     * @param \Magento\Customer\Model\Session\Proxy $customerSession
     * @param Proxy $checkoutSession
     * @param array $data
     */
    public function __construct(
        VoucherHelper $voucherHelper,
        Context $context,
        \Magento\Customer\Model\Session\Proxy $customerSession,
        Proxy $checkoutSession,
        array $data = []
    ) {
        parent::__construct($context, $customerSession, $checkoutSession, $data);
        $this->voucherHelper  = $voucherHelper;
        $this->_isScopePrivate = true;
    }

    /**
     * @return float|null
     */
    public function getVoucherBalance()
    {
        return $this->voucherHelper->getVoucherBalance();
    }

    /**
     * @return mixed
     */
    public function getVoucherAmountUsed()
    {
        if ($this->getQuote()->getLsVoucherAmountUsed() > 0) {
            return $this->getQuote()->getLsVoucherAmountUsed();
        }
    }

    /**
     * @return mixed
     */
    public function getVoucherNo()
    {
        return $this->getQuote()->getLsVoucherNo();
    }

    /**
     * @return string
     */
    public function getVoucherActive()
    {
        return $this->voucherHelper->isVoucherEnabled('cart');
    }
}
