<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use Ls\Omni\Client\IResponse;

class TransactionGetByIdResponse implements IResponse
{

    /**
     * @property Transaction $TransactionGetByIdResult
     */
    protected $TransactionGetByIdResult = null;

    /**
     * @param Transaction $TransactionGetByIdResult
     * @return $this
     */
    public function setTransactionGetByIdResult($TransactionGetByIdResult)
    {
        $this->TransactionGetByIdResult = $TransactionGetByIdResult;
        return $this;
    }

    /**
     * @return Transaction
     */
    public function getTransactionGetByIdResult()
    {
        return $this->TransactionGetByIdResult;
    }

    /**
     * @return Transaction
     */
    public function getResult()
    {
        return $this->TransactionGetByIdResult;
    }


}

