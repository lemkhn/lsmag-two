<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use IteratorAggregate;
use ArrayIterator;

class ArrayOfRecommendedItem implements IteratorAggregate
{

    /**
     * @property RecommendedItem[] $RecommendedItem
     */
    protected $RecommendedItem = array(
        
    );

    /**
     * @param RecommendedItem[] $RecommendedItem
     * @return $this
     */
    public function setRecommendedItem($RecommendedItem)
    {
        $this->RecommendedItem = $RecommendedItem;
        return $this;
    }

    /**
     * @return RecommendedItem[]
     */
    public function getIterator()
    {
        return new ArrayIterator( $this->RecommendedItem );
    }

    /**
     * @return RecommendedItem[]
     */
    public function getRecommendedItem()
    {
        return $this->RecommendedItem;
    }


}

