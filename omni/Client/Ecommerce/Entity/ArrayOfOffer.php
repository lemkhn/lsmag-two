<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use IteratorAggregate;
use ArrayIterator;

class ArrayOfOffer implements IteratorAggregate
{

    /**
     * @property Offer[] $Offer
     */
    protected $Offer = array(
        
    );

    /**
     * @param Offer[] $Offer
     * @return $this
     */
    public function setOffer($Offer)
    {
        $this->Offer = $Offer;
        return $this;
    }

    /**
     * @return Offer[]
     */
    public function getIterator()
    {
        return new ArrayIterator( $this->Offer );
    }

    /**
     * @return Offer[]
     */
    public function getOffer()
    {
        return $this->Offer;
    }


}

