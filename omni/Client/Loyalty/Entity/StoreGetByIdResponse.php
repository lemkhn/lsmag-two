<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use Ls\Omni\Client\IResponse;

class StoreGetByIdResponse implements IResponse
{

    /**
     * @property Store $StoreGetByIdResult
     */
    protected $StoreGetByIdResult = null;

    /**
     * @param Store $StoreGetByIdResult
     * @return $this
     */
    public function setStoreGetByIdResult($StoreGetByIdResult)
    {
        $this->StoreGetByIdResult = $StoreGetByIdResult;
        return $this;
    }

    /**
     * @return Store
     */
    public function getStoreGetByIdResult()
    {
        return $this->StoreGetByIdResult;
    }

    /**
     * @return Store
     */
    public function getResult()
    {
        return $this->StoreGetByIdResult;
    }


}

