<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use Ls\Omni\Client\IResponse;

class OrderMessageSaveResponse implements IResponse
{

    /**
     * @property OrderMessage $OrderMessageSaveResult
     */
    protected $OrderMessageSaveResult = null;

    /**
     * @param OrderMessage $OrderMessageSaveResult
     * @return $this
     */
    public function setOrderMessageSaveResult($OrderMessageSaveResult)
    {
        $this->OrderMessageSaveResult = $OrderMessageSaveResult;
        return $this;
    }

    /**
     * @return OrderMessage
     */
    public function getOrderMessageSaveResult()
    {
        return $this->OrderMessageSaveResult;
    }

    /**
     * @return OrderMessage
     */
    public function getResult()
    {
        return $this->OrderMessageSaveResult;
    }


}

