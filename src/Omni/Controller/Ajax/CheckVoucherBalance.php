<?php

namespace Ls\Omni\Controller\Ajax;

use \Ls\Omni\Helper\voucherHelper;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Pricing\Helper\Data;

/**
 * Class CheckvoucherBalance
 * @package Ls\Omni\Controller\Ajax
 */
class CheckVoucherBalance extends Action
{

    /** @var JsonFactory */
    public $resultJsonFactory;

    /**
     * @var RawFactory
     */
    public $resultRawFactory;

    /** @var VoucherHelper */
    private $VoucherHelper;

    /**
     * @var Data
     */
    public $priceHelper;

    /**
     * CheckVoucherBalance constructor.
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param RawFactory $resultRawFactory
     * @param VoucherHelper $gvoucherHelper
     * @param Data $priceHelper
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        RawFactory $resultRawFactory,
        VoucherHelper $voucherHelper,
        Data $priceHelper
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->resultRawFactory  = $resultRawFactory;
        $this->voucherHelper    = $voucherHelper;
        $this->priceHelper       = $priceHelper;
    }

    /**
     * @return ResponseInterface|Json|Raw|ResultInterface
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
        $resultJson   = $this->resultJsonFactory->create();
        $post         = $this->getRequest()->getContent();
        $postData     = json_decode($post);
        $voucherCode = $postData->voucher_code;
        $data         = [];
        if ($voucherCode != null) {
            $voucherResponse = $this->voucherHelper->getvoucherBalance($voucherCode);
            if (is_object($voucherResponse)) {
                $data['voucherbalance'] = $this->priceHelper->currency($voucherResponse->getBalance(), true, false);
                $data['expirydate']      = $voucherResponse->getExpireDate();
            } else {
                $data['voucherbalance'] = $this->priceHelper->currency($voucherResponse, true, false);
                $data['expirydate']      = null;
            }
            if (empty($voucherResponse)) {
                $response = [
                    'error'   => 'true',
                    'message' => __(
                        'The voucher code %1 is not valid.',
                        $voucherCode
                    )
                ];
            } else {
                $response = [
                    'success' => 'true',
                    'data'    => json_encode($data)
                ];
            }
            return $resultJson->setData($response);
        } else {
            $response = [
                'error'   => 'true',
                'message' => __(
                    'The voucher code %1 is not valid.',
                    $voucherCode
                )
            ];
            return $resultJson->setData($response);
        }

        return $resultJson->setData($response);
    }
}
