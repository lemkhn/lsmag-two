<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use Ls\Omni\Client\IRequest;

class CouponGetById implements IRequest
{

    /**
     * @property string $couponId
     */
    protected $couponId = null;

    /**
     * @param string $couponId
     * @return $this
     */
    public function setCouponId($couponId)
    {
        $this->couponId = $couponId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCouponId()
    {
        return $this->couponId;
    }


}

