<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use IteratorAggregate;
use ArrayIterator;

class ArrayOfVariant implements IteratorAggregate
{

    /**
     * @property Variant[] $Variant
     */
    protected $Variant = array(
        
    );

    /**
     * @param Variant[] $Variant
     * @return $this
     */
    public function setVariant($Variant)
    {
        $this->Variant = $Variant;
        return $this;
    }

    /**
     * @return Variant[]
     */
    public function getIterator()
    {
        return new ArrayIterator( $this->Variant );
    }

    /**
     * @return Variant[]
     */
    public function getVariant()
    {
        return $this->Variant;
    }


}

