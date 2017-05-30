<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

class ReplVendorItemMappingResponse
{

    /**
     * @property string $LastKey
     */
    protected $LastKey = null;

    /**
     * @property ArrayOfVendorItemMapping $Mapping
     */
    protected $Mapping = null;

    /**
     * @property string $MaxKey
     */
    protected $MaxKey = null;

    /**
     * @property int $RecordsRemaining
     */
    protected $RecordsRemaining = null;

    /**
     * @param string $LastKey
     * @return $this
     */
    public function setLastKey($LastKey)
    {
        $this->LastKey = $LastKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastKey()
    {
        return $this->LastKey;
    }

    /**
     * @param ArrayOfVendorItemMapping $Mapping
     * @return $this
     */
    public function setMapping($Mapping)
    {
        $this->Mapping = $Mapping;
        return $this;
    }

    /**
     * @return ArrayOfVendorItemMapping
     */
    public function getMapping()
    {
        return $this->Mapping;
    }

    /**
     * @param string $MaxKey
     * @return $this
     */
    public function setMaxKey($MaxKey)
    {
        $this->MaxKey = $MaxKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getMaxKey()
    {
        return $this->MaxKey;
    }

    /**
     * @param int $RecordsRemaining
     * @return $this
     */
    public function setRecordsRemaining($RecordsRemaining)
    {
        $this->RecordsRemaining = $RecordsRemaining;
        return $this;
    }

    /**
     * @return int
     */
    public function getRecordsRemaining()
    {
        return $this->RecordsRemaining;
    }


}

