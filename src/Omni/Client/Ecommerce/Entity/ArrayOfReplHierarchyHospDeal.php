<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use IteratorAggregate;
use ArrayIterator;

class ArrayOfReplHierarchyHospDeal implements IteratorAggregate
{

    /**
     * @property ReplHierarchyHospDeal[] $ReplHierarchyHospDeal
     */
    protected $ReplHierarchyHospDeal = [
        
    ];

    /**
     * @param ReplHierarchyHospDeal[] $ReplHierarchyHospDeal
     * @return $this
     */
    public function setReplHierarchyHospDeal($ReplHierarchyHospDeal)
    {
        $this->ReplHierarchyHospDeal = $ReplHierarchyHospDeal;
        return $this;
    }

    /**
     * @return ReplHierarchyHospDeal[]
     */
    public function getIterator()
    {
        return new ArrayIterator( $this->ReplHierarchyHospDeal );
    }

    /**
     * @return ReplHierarchyHospDeal[]
     */
    public function getReplHierarchyHospDeal()
    {
        return $this->ReplHierarchyHospDeal;
    }


}

