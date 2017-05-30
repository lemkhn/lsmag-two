<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

class ItemPriceCheckRequest
{

    /**
     * @property string $CurrencyCode
     */
    protected $CurrencyCode = null;

    /**
     * @property int $CurrencyFactor
     */
    protected $CurrencyFactor = null;

    /**
     * @property string $CustDiscGroup
     */
    protected $CustDiscGroup = null;

    /**
     * @property string $CustomerId
     */
    protected $CustomerId = null;

    /**
     * @property string $Id
     */
    protected $Id = null;

    /**
     * @property ArrayOfItemPriceCheckLineRequest $ItemPriceCheckLineRequests
     */
    protected $ItemPriceCheckLineRequests = null;

    /**
     * @property string $MemberCardNo
     */
    protected $MemberCardNo = null;

    /**
     * @property string $MemberPriceGroupCode
     */
    protected $MemberPriceGroupCode = null;

    /**
     * @property string $StaffId
     */
    protected $StaffId = null;

    /**
     * @property string $StoreId
     */
    protected $StoreId = null;

    /**
     * @property string $TerminalId
     */
    protected $TerminalId = null;

    /**
     * @param string $CurrencyCode
     * @return $this
     */
    public function setCurrencyCode($CurrencyCode)
    {
        $this->CurrencyCode = $CurrencyCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->CurrencyCode;
    }

    /**
     * @param int $CurrencyFactor
     * @return $this
     */
    public function setCurrencyFactor($CurrencyFactor)
    {
        $this->CurrencyFactor = $CurrencyFactor;
        return $this;
    }

    /**
     * @return int
     */
    public function getCurrencyFactor()
    {
        return $this->CurrencyFactor;
    }

    /**
     * @param string $CustDiscGroup
     * @return $this
     */
    public function setCustDiscGroup($CustDiscGroup)
    {
        $this->CustDiscGroup = $CustDiscGroup;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustDiscGroup()
    {
        return $this->CustDiscGroup;
    }

    /**
     * @param string $CustomerId
     * @return $this
     */
    public function setCustomerId($CustomerId)
    {
        $this->CustomerId = $CustomerId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerId()
    {
        return $this->CustomerId;
    }

    /**
     * @param string $Id
     * @return $this
     */
    public function setId($Id)
    {
        $this->Id = $Id;
        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param ArrayOfItemPriceCheckLineRequest $ItemPriceCheckLineRequests
     * @return $this
     */
    public function setItemPriceCheckLineRequests($ItemPriceCheckLineRequests)
    {
        $this->ItemPriceCheckLineRequests = $ItemPriceCheckLineRequests;
        return $this;
    }

    /**
     * @return ArrayOfItemPriceCheckLineRequest
     */
    public function getItemPriceCheckLineRequests()
    {
        return $this->ItemPriceCheckLineRequests;
    }

    /**
     * @param string $MemberCardNo
     * @return $this
     */
    public function setMemberCardNo($MemberCardNo)
    {
        $this->MemberCardNo = $MemberCardNo;
        return $this;
    }

    /**
     * @return string
     */
    public function getMemberCardNo()
    {
        return $this->MemberCardNo;
    }

    /**
     * @param string $MemberPriceGroupCode
     * @return $this
     */
    public function setMemberPriceGroupCode($MemberPriceGroupCode)
    {
        $this->MemberPriceGroupCode = $MemberPriceGroupCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getMemberPriceGroupCode()
    {
        return $this->MemberPriceGroupCode;
    }

    /**
     * @param string $StaffId
     * @return $this
     */
    public function setStaffId($StaffId)
    {
        $this->StaffId = $StaffId;
        return $this;
    }

    /**
     * @return string
     */
    public function getStaffId()
    {
        return $this->StaffId;
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

