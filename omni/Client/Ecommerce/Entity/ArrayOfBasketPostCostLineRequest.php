<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use IteratorAggregate;
use ArrayIterator;

class ArrayOfBasketPostCostLineRequest implements IteratorAggregate
{

    /**
     * @property BasketPostCostLineRequest[] $BasketPostCostLineRequest
     */
    protected $BasketPostCostLineRequest = array(
        
    );

    /**
     * @param BasketPostCostLineRequest[] $BasketPostCostLineRequest
     * @return $this
     */
    public function setBasketPostCostLineRequest($BasketPostCostLineRequest)
    {
        $this->BasketPostCostLineRequest = $BasketPostCostLineRequest;
        return $this;
    }

    /**
     * @return BasketPostCostLineRequest[]
     */
    public function getIterator()
    {
        return new ArrayIterator( $this->BasketPostCostLineRequest );
    }

    /**
     * @return BasketPostCostLineRequest[]
     */
    public function getBasketPostCostLineRequest()
    {
        return $this->BasketPostCostLineRequest;
    }


}

