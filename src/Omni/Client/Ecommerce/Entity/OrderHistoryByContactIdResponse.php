<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use Ls\Omni\Client\ResponseInterface;

class OrderHistoryByContactIdResponse implements ResponseInterface
{

    /**
     * @property ArrayOfOrder $OrderHistoryByContactIdResult
     */
    protected $OrderHistoryByContactIdResult = null;

    /**
     * @param ArrayOfOrder $OrderHistoryByContactIdResult
     * @return $this
     */
    public function setOrderHistoryByContactIdResult($OrderHistoryByContactIdResult)
    {
        $this->OrderHistoryByContactIdResult = $OrderHistoryByContactIdResult;
        return $this;
    }

    /**
     * @return ArrayOfOrder
     */
    public function getOrderHistoryByContactIdResult()
    {
        return $this->OrderHistoryByContactIdResult;
    }

    /**
     * @return ArrayOfOrder
     */
    public function getResult()
    {
        return $this->OrderHistoryByContactIdResult;
    }


}

