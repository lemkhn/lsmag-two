<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use Ls\Omni\Client\IResponse;

class TransactionHeadersGetByContactIdResponse implements IResponse
{

    /**
     * @property ArrayOfTransaction $TransactionHeadersGetByContactIdResult
     */
    protected $TransactionHeadersGetByContactIdResult = null;

    /**
     * @param ArrayOfTransaction $TransactionHeadersGetByContactIdResult
     * @return $this
     */
    public function setTransactionHeadersGetByContactIdResult($TransactionHeadersGetByContactIdResult)
    {
        $this->TransactionHeadersGetByContactIdResult = $TransactionHeadersGetByContactIdResult;
        return $this;
    }

    /**
     * @return ArrayOfTransaction
     */
    public function getTransactionHeadersGetByContactIdResult()
    {
        return $this->TransactionHeadersGetByContactIdResult;
    }

    /**
     * @return ArrayOfTransaction
     */
    public function getResult()
    {
        return $this->TransactionHeadersGetByContactIdResult;
    }


}

