<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use IteratorAggregate;
use ArrayIterator;

class ArrayOfOrderPaymentCreateRequest implements IteratorAggregate
{

    /**
     * @property OrderPaymentCreateRequest[] $OrderPaymentCreateRequest
     */
    protected $OrderPaymentCreateRequest = array(
        
    );

    /**
     * @param OrderPaymentCreateRequest[] $OrderPaymentCreateRequest
     * @return $this
     */
    public function setOrderPaymentCreateRequest($OrderPaymentCreateRequest)
    {
        $this->OrderPaymentCreateRequest = $OrderPaymentCreateRequest;
        return $this;
    }

    /**
     * @return OrderPaymentCreateRequest[]
     */
    public function getIterator()
    {
        return new ArrayIterator( $this->OrderPaymentCreateRequest );
    }

    /**
     * @return OrderPaymentCreateRequest[]
     */
    public function getOrderPaymentCreateRequest()
    {
        return $this->OrderPaymentCreateRequest;
    }


}

