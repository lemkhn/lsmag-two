<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use IteratorAggregate;
use ArrayIterator;

class ArrayOfCouponDetails implements IteratorAggregate
{

    /**
     * @property CouponDetails[] $CouponDetails
     */
    protected $CouponDetails = array(
        
    );

    /**
     * @param CouponDetails[] $CouponDetails
     * @return $this
     */
    public function setCouponDetails($CouponDetails)
    {
        $this->CouponDetails = $CouponDetails;
        return $this;
    }

    /**
     * @return CouponDetails[]
     */
    public function getIterator()
    {
        return new ArrayIterator( $this->CouponDetails );
    }

    /**
     * @return CouponDetails[]
     */
    public function getCouponDetails()
    {
        return $this->CouponDetails;
    }


}

