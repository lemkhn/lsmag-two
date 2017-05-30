<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

class ReplRequest
{

    /**
     * @property int $BatchSize
     */
    protected $BatchSize = null;

    /**
     * @property boolean $FullReplication
     */
    protected $FullReplication = null;

    /**
     * @property string $LastKey
     */
    protected $LastKey = null;

    /**
     * @property string $MaxKey
     */
    protected $MaxKey = null;

    /**
     * @property string $StoreId
     */
    protected $StoreId = null;

    /**
     * @property string $TerminalId
     */
    protected $TerminalId = null;

    /**
     * @param int $BatchSize
     * @return $this
     */
    public function setBatchSize($BatchSize)
    {
        $this->BatchSize = $BatchSize;
        return $this;
    }

    /**
     * @return int
     */
    public function getBatchSize()
    {
        return $this->BatchSize;
    }

    /**
     * @param boolean $FullReplication
     * @return $this
     */
    public function setFullReplication($FullReplication)
    {
        $this->FullReplication = $FullReplication;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getFullReplication()
    {
        return $this->FullReplication;
    }

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
     * @param string $StoreId
     * @return $this
     */
    public function setStoreId($StoreId)
    {
        $this->StoreId = $StoreId;
        return $this;
    }

    /**
     * @return string
     */
    public function getStoreId()
    {
        return $this->StoreId;
    }

    /**
     * @param string $TerminalId
     * @return $this
     */
    public function setTerminalId($TerminalId)
    {
        $this->TerminalId = $TerminalId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTerminalId()
    {
        return $this->TerminalId;
    }


}

