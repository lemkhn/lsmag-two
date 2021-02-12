<?php

namespace Ls\Omni\Block\Cart;

use \Ls\Omni\Helper\GiftCardHelper;
use Magento\Checkout\Block\Cart\AbstractCart;
use Magento\Checkout\Model\Session\Proxy;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Giftcard
 * @package Ls\Omni\Block\Cart
 */
class Voucher extends AbstractCart
{

    /**
     * @var GiftCardHelper
     */
    public $giftCardHelper;

    /**
     * Giftcard constructor.
     * @param GiftCardHelper $giftCardHelper
     * @param Context $context
     * @param \Magento\Customer\Model\Session\Proxy $customerSession
     * @param Proxy $checkoutSession
     * @param array $data
     */
    public function __construct(
        GiftCardHelper $giftCardHelper,
        Context $context,
        \Magento\Customer\Model\Session\Proxy $customerSession,
        Proxy $checkoutSession,
        array $data = []
    ) {
        parent::__construct($context, $customerSession, $checkoutSession, $data);
        $this->giftCardHelper  = $giftCardHelper;
        $this->_isScopePrivate = true;
    }

    /**
     * @return float|null
     */
    public function getVoucherBalance()
    {
        return $this->giftCardHelper->getGiftCardBalance();
    }

    /**
     * @return mixed
     */
    public function getVoucherAmountUsed()
    {
        if ($this->getQuote()->getLsGiftCardAmountUsed() > 0) {
            return $this->getQuote()->getLsGiftCardAmountUsed();
        }
    }

    /**
     * @return mixed
     */
    public function getVoucherNo()
    {
        return $this->getQuote()->getLsGiftCardNo();
    }

    /**
     * @return string
     */
    public function getVoucherActive()
    {
        return $this->giftCardHelper->isGiftCardEnabled('cart');
    }
}
