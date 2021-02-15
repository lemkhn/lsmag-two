<?php

namespace Ls\Omni\Helper;

use Exception;
use \Ls\Core\Model\LSR;
use \Ls\Omni\Client\Ecommerce\Entity;
use \Ls\Omni\Client\Ecommerce\Operation;
use Magento\Checkout\Model\Session\Proxy;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Filesystem;

/**
 * Class VoucherHelper
 * @package Ls\Omni\Helper
 */
class VoucherHelper extends AbstractHelper
{

    const SERVICE_TYPE = 'ecommerce';

    /**
     * @var Proxy
     */
    public $checkoutSession;

    /**
     * @var Filesystem
     */
    public $filesystem;

    /**
     * @var LSR
     */
    public $lsr;

    /**
     * VoucherHelper constructor.
     * @param Context $context
     * @param Proxy $checkoutSession
     * @param Filesystem $filesystem
     * @param LSR $Lsr
     */
    public function __construct(
        Context $context,
        Proxy $checkoutSession,
        Filesystem $filesystem,
        LSR $Lsr
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->filesystem      = $filesystem;
        $this->lsr             = $Lsr;
        parent::__construct(
            $context
        );
    }

    /**
     * @param $voucherNo
     * @return float|Entity\Voucher|null
     */
    public function getVoucherBalance($voucherNo)
    {
        $response = null;
        // @codingStandardsIgnoreStart
        $request = new Operation\VoucherGetBalance();
        $entity  = new Entity\VoucherGetBalance();
        $entity->setCardNo($voucherNo);
        // @codingStandardsIgnoreEnd
        try {
            $responseData = $request->execute($entity);
            $response     = $responseData ? $responseData->getResult() : $response;
        } catch (Exception $e) {
            $this->_logger->error($e->getMessage());
        }
        $this->checkoutSession->setVoucher($response);
        return $response;
    }

    /**
     * @param $grandTotal
     * @param $voucherAmount
     * @param $voucherBalanceAmount
     * @return bool
     */
    public function isVoucherAmountValid($grandTotal, $voucherAmount, $voucherBalanceAmount)
    {
        if ($voucherAmount <= $grandTotal && $voucherAmount <= $voucherBalanceAmount) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $area
     * @return string
     * @throws NoSuchEntityException
     */
    public function isVoucherEnabled($area)
    {
        if ($this->lsr->isLSR($this->lsr->getCurrentStoreId())) {
            if ($area == 'cart') {
                return $this->lsr->getStoreConfig(
                    LSR::LS_VOUCHER_SHOW_ON_CART,
                    $this->lsr->getCurrentStoreId()
                );
            }
            return $this->lsr->getStoreConfig(
                LSR::LS_VOUCHER_SHOW_ON_CHECKOUT,
                $this->lsr->getCurrentStoreId()
            );
        } else {
            return false;
        }
    }
}
