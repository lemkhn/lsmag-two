<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use Ls\Omni\Client\IResponse;

class ForgotPasswordExResponse implements IResponse
{

    /**
     * @property boolean $ForgotPasswordExResult
     */
    protected $ForgotPasswordExResult = null;

    /**
     * @param boolean $ForgotPasswordExResult
     * @return $this
     */
    public function setForgotPasswordExResult($ForgotPasswordExResult)
    {
        $this->ForgotPasswordExResult = $ForgotPasswordExResult;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getForgotPasswordExResult()
    {
        return $this->ForgotPasswordExResult;
    }

    /**
     * @return boolean
     */
    public function getResult()
    {
        return $this->ForgotPasswordExResult;
    }


}

