<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use Ls\Omni\Client\IResponse;

class ReplEcommCurrencyRateResponse implements IResponse
{

    /**
     * @property ReplCurrencyRateResponse $ReplEcommCurrencyRateResult
     */
    protected $ReplEcommCurrencyRateResult = null;

    /**
     * @param ReplCurrencyRateResponse $ReplEcommCurrencyRateResult
     * @return $this
     */
    public function setReplEcommCurrencyRateResult($ReplEcommCurrencyRateResult)
    {
        $this->ReplEcommCurrencyRateResult = $ReplEcommCurrencyRateResult;
        return $this;
    }

    /**
     * @return ReplCurrencyRateResponse
     */
    public function getReplEcommCurrencyRateResult()
    {
        return $this->ReplEcommCurrencyRateResult;
    }

    /**
     * @return ReplCurrencyRateResponse
     */
    public function getResult()
    {
        return $this->ReplEcommCurrencyRateResult;
    }


}

