<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use \Ls\Omni\Client\ResponseInterface;

class StoresGetByCoordinatesResponse implements ResponseInterface
{

    /**
     * @property ArrayOfStore $StoresGetByCoordinatesResult
     */
    protected $StoresGetByCoordinatesResult = null;

    /**
     * @param ArrayOfStore $StoresGetByCoordinatesResult
     * @return $this
     */
    public function setStoresGetByCoordinatesResult($StoresGetByCoordinatesResult)
    {
        $this->StoresGetByCoordinatesResult = $StoresGetByCoordinatesResult;
        return $this;
    }

    /**
     * @return ArrayOfStore
     */
    public function getStoresGetByCoordinatesResult()
    {
        return $this->StoresGetByCoordinatesResult;
    }

    /**
     * @return ArrayOfStore
     */
    public function getResult()
    {
        return $this->StoresGetByCoordinatesResult;
    }


}

