<?php
namespace Ls\Omni\Observer;

use Ls\Omni\Helper\BasketHelper;
use Magento\Framework\Event\ObserverInterface;
use Ls\Omni\Helper\ContactHelper;
use Ls\Omni\Client\Ecommerce\Entity;
use Ls\Customer\Model\LSR;

class CartObserver implements ObserverInterface
{
    private $contactHelper;
    protected $basketHelper;
    protected $logger;
    protected $customerSession;
    protected $checkoutSession;
    protected $watchNextSave = FALSE;

    public function __construct(
        ContactHelper $contactHelper,
        BasketHelper $basketHelper,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Checkout\Model\Session $checkoutSession
    )
    {
        $this->contactHelper = $contactHelper;
        $this->basketHelper = $basketHelper;
        $this->logger = $logger;
        $this->customerSession = $customerSession;
        $this->checkoutSession = $checkoutSession;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->watchNextSave) {
            // taken over from LSR_Core_Model_Observer_Cart::update_basket from LS Mag for Magento 1
            /** @var \Magento\Quote\Model\Quote $quote */
            $quote = $this->checkoutSession->getQuote();

            // $helper->get() loads the OneList from Omni
            // TODO: load the oneList from the user, only if empty, use the one from nav to speed up things
            $oneList = $this->basketHelper->get();

            // add items from the quote to the oneList
            $this->basketHelper->setOneListQuote($quote, $oneList);

            $this->basketHelper->update($oneList);
        }
        return $this;
    }

    public function watchNextSave(bool $value = TRUE) {
        $this->watchNextSave = $value;
    }
}