<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

class ReceiptInfo
{

    /**
     * @property boolean $IsLargeValue
     */
    protected $IsLargeValue = null;

    /**
     * @property string $Key
     */
    protected $Key = null;

    /**
     * @property string $Type
     */
    protected $Type = null;

    /**
     * @property string $Value
     */
    protected $Value = null;

    /**
     * @param boolean $IsLargeValue
     * @return $this
     */
    public function setIsLargeValue($IsLargeValue)
    {
        $this->IsLargeValue = $IsLargeValue;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsLargeValue()
    {
        return $this->IsLargeValue;
    }

    /**
     * @param string $Key
     * @return $this
     */
    public function setKey($Key)
    {
        $this->Key = $Key;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->Key;
    }

    /**
     * @param string $Type
     * @return $this
     */
    public function setType($Type)
    {
        $this->Type = $Type;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * @param string $Value
     * @return $this
     */
    public function setValue($Value)
    {
        $this->Value = $Value;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->Value;
    }


}

