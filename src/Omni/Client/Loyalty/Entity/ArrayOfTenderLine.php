<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use IteratorAggregate;
use ArrayIterator;

class ArrayOfTenderLine implements IteratorAggregate
{

    /**
     * @property TenderLine[] $TenderLine
     */
    protected $TenderLine = array(
        
    );

    /**
     * @param TenderLine[] $TenderLine
     * @return $this
     */
    public function setTenderLine($TenderLine)
    {
        $this->TenderLine = $TenderLine;
        return $this;
    }

    /**
     * @return TenderLine[]
     */
    public function getIterator()
    {
        return new ArrayIterator( $this->TenderLine );
    }

    /**
     * @return TenderLine[]
     */
    public function getTenderLine()
    {
        return $this->TenderLine;
    }


}

