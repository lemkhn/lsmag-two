<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use Ls\Omni\Client\IResponse;

class ReplEcommCurrencyResponse implements IResponse
{

    /**
     * @property ReplCurrencyResponse $ReplEcommCurrencyResult
     */
    protected $ReplEcommCurrencyResult = null;

    /**
     * @param ReplCurrencyResponse $ReplEcommCurrencyResult
     * @return $this
     */
    public function setReplEcommCurrencyResult($ReplEcommCurrencyResult)
    {
        $this->ReplEcommCurrencyResult = $ReplEcommCurrencyResult;
        return $this;
    }

    /**
     * @return ReplCurrencyResponse
     */
    public function getReplEcommCurrencyResult()
    {
        return $this->ReplEcommCurrencyResult;
    }

    /**
     * @return ReplCurrencyResponse
     */
    public function getResult()
    {
        return $this->ReplEcommCurrencyResult;
    }


}

