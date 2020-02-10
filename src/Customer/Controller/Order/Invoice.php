<?php

namespace Ls\Customer\Controller\Order;

use \Ls\Omni\Client\Ecommerce\Entity\Order;
use \Ls\Omni\Client\Ecommerce\Entity\OrderGetByIdResponse;
use \Ls\Omni\Client\ResponseInterface;
use \Ls\Omni\Helper\OrderHelper;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Invoice
 * @package Ls\Customer\Controller\Order
 */
class Invoice extends Action
{
    /**
     * @var ManagerInterface
     */
    public $messageManager;

    /**
     * @var ResultFactory
     */
    public $resultRedirect;

    /** @var PageFactory */
    public $resultPageFactory;

    /**
     * @var Http $request
     */
    public $request;

    /**
     * @var OrderHelper
     */
    public $orderHelper;

    /**
     * @var Registry
     */
    public $registry;

    /**
     * Invoice constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Http $request
     * @param OrderHelper $orderHelper
     * @param Registry $registry
     * @param ResultFactory $result
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Http $request,
        OrderHelper $orderHelper,
        Registry $registry,
        ResultFactory $result,
        ManagerInterface $messageManager
    ) {
        $this->resultRedirect    = $result;
        $this->messageManager    = $messageManager;
        $this->request           = $request;
        $this->registry          = $registry;
        $this->orderHelper       = $orderHelper;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        $response = null;
        if ($this->request->getParam('order_id')) {
            $orderId  = $this->request->getParam('order_id');
            $response = $this->setCurrentOrderInRegistry($orderId);
            if ($response === null || !$this->orderHelper->isAuthorizedForOrder($response)) {
                return $this->_redirect('sales/order/history/');
            }
            $this->setCurrentMagOrderInRegistry($orderId);
            $this->setInvoiceId();
            $this->setPrintInvoiceOption();
        }
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }

    /**
     * @param $orderId
     * @return Order|OrderGetByIdResponse|ResponseInterface|null
     */
    public function setCurrentOrderInRegistry($orderId)
    {
        $response = $this->orderHelper->getOrderDetailsAgainstId($orderId);
        if ($response) {
            $this->setOrderInRegistry($response);
        }
        return $response;
    }

    /**
     * @param $order
     */
    public function setOrderInRegistry($order)
    {
        $this->registry->register('current_order', $order);
    }

    /**
     * @param $orderId
     */
    public function setCurrentMagOrderInRegistry($orderId)
    {
        $order = $this->orderHelper->getOrderByDocumentId($orderId);
        $this->registry->register('current_mag_order', $order);
    }

    /**
     * @param $orderId
     */
    public function setInvoiceId()
    {
        $order = $this->registry->registry('current_mag_order');
        foreach ($order->getInvoiceCollection() as $invoice) {
            $this->registry->register('current_invoice_id', $invoice->getIncrementId());
        }
    }

    /**
     *  Print Invoice Option
     */
    public function setPrintInvoiceOption()
    {
        $order = $this->registry->registry('current_mag_order');
        if (!empty($order)) {
            if (!empty($order->getInvoiceCollection())) {
                $this->registry->register('current_invoice_option', true);
            } else {
                $this->registry->register('current_invoice_option', false);
            }
        }
    }
}
