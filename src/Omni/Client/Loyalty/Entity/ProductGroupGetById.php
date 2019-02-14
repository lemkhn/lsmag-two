<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use \Ls\Omni\Client\RequestInterface;

class ProductGroupGetById implements RequestInterface
{

    /**
     * @property string $productGroupId
     */
    protected $productGroupId = null;

    /**
     * @property boolean $includeDetails
     */
    protected $includeDetails = null;

    /**
     * @param string $productGroupId
     * @return $this
     */
    public function setProductGroupId($productGroupId)
    {
        $this->productGroupId = $productGroupId;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductGroupId()
    {
        return $this->productGroupId;
    }

    /**
     * @param boolean $includeDetails
     * @return $this
     */
    public function setIncludeDetails($includeDetails)
    {
        $this->includeDetails = $includeDetails;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIncludeDetails()
    {
        return $this->includeDetails;
    }


}

