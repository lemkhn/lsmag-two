<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use IteratorAggregate;
use ArrayIterator;

class ArrayOfOneListPublishedOffer implements IteratorAggregate
{

    /**
     * @property OneListPublishedOffer[] $OneListPublishedOffer
     */
    protected $OneListPublishedOffer = array(
        
    );

    /**
     * @param OneListPublishedOffer[] $OneListPublishedOffer
     * @return $this
     */
    public function setOneListPublishedOffer($OneListPublishedOffer)
    {
        $this->OneListPublishedOffer = $OneListPublishedOffer;
        return $this;
    }

    /**
     * @return OneListPublishedOffer[]
     */
    public function getIterator()
    {
        return new ArrayIterator( $this->OneListPublishedOffer );
    }

    /**
     * @return OneListPublishedOffer[]
     */
    public function getOneListPublishedOffer()
    {
        return $this->OneListPublishedOffer;
    }


}

