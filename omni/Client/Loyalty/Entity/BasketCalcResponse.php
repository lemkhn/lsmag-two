<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use Ls\Omni\Client\Loyalty\Entity\Enum\EntryStatus;
use Ls\Omni\Exception\InvalidEnumException;
use Ls\Omni\Client\IResponse;

class BasketCalcResponse implements IResponse
{

    /**
     * @property ArrayOfBasketLineCalcResponse $BasketLineCalcResponses
     */
    protected $BasketLineCalcResponses = null;

    /**
     * @property string $BusinessTAXCode
     */
    protected $BusinessTAXCode = null;

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
     * @property EntryStatus $EntryStatus
     */
    protected $EntryStatus = null;

    /**
     * @property string $Id
     */
    protected $Id = null;

    /**
     * @property string $ManualTotalDiscAmount
     */
    protected $ManualTotalDiscAmount = null;

    /**
     * @property string $ManualTotalDiscPercent
     */
    protected $ManualTotalDiscPercent = null;

    /**
     * @property string $MemberCardNo
     */
    protected $MemberCardNo = null;

    /**
     * @property string $MemberPriceGroupCode
     */
    protected $MemberPriceGroupCode = null;

    /**
     * @property string $PriceGroupCode
     */
    protected $PriceGroupCode = null;

    /**
     * @property string $ReceiptNo
     */
    protected $ReceiptNo = null;

    /**
     * @property string $ShippingPrice
     */
    protected $ShippingPrice = null;

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
     * @property string $TotalAmount
     */
    protected $TotalAmount = null;

    /**
     * @property string $TotalDiscAmount
     */
    protected $TotalDiscAmount = null;

    /**
     * @property string $TotalNetAmount
     */
    protected $TotalNetAmount = null;

    /**
     * @property string $TotalTaxAmount
     */
    protected $TotalTaxAmount = null;

    /**
     * @property string $TransDate
     */
    protected $TransDate = null;

    /**
     * @property string $TransactionNo
     */
    protected $TransactionNo = null;

    /**
     * @param ArrayOfBasketLineCalcResponse $BasketLineCalcResponses
     * @return $this
     */
    public function setBasketLineCalcResponses($BasketLineCalcResponses)
    {
        $this->BasketLineCalcResponses = $BasketLineCalcResponses;
        return $this;
    }

    /**
     * @return ArrayOfBasketLineCalcResponse
     */
    public function getBasketLineCalcResponses()
    {
        return $this->BasketLineCalcResponses;
    }

    /**
     * @param string $BusinessTAXCode
     * @return $this
     */
    public function setBusinessTAXCode($BusinessTAXCode)
    {
        $this->BusinessTAXCode = $BusinessTAXCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getBusinessTAXCode()
    {
        return $this->BusinessTAXCode;
    }

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
     * @param EntryStatus|string $EntryStatus
     * @return $this
     * @throws InvalidEnumException
     */
    public function setEntryStatus($EntryStatus)
    {
        if ( EntryStatus::isValid( $EntryStatus) ) 
            $this->EntryStatus = new EntryStatus( $EntryStatus );
        elseif ( EntryStatus::isValidKey( $EntryStatus) ) 
            $this->EntryStatus = new EntryStatus( constant( "EntryStatus::$EntryStatus" ) );
        else 
            throw new InvalidEnumException();
        return $this;
    }

    /**
     * @return EntryStatus
     */
    public function getEntryStatus()
    {
        return $this->EntryStatus;
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
     * @param string $ManualTotalDiscAmount
     * @return $this
     */
    public function setManualTotalDiscAmount($ManualTotalDiscAmount)
    {
        $this->ManualTotalDiscAmount = $ManualTotalDiscAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getManualTotalDiscAmount()
    {
        return $this->ManualTotalDiscAmount;
    }

    /**
     * @param string $ManualTotalDiscPercent
     * @return $this
     */
    public function setManualTotalDiscPercent($ManualTotalDiscPercent)
    {
        $this->ManualTotalDiscPercent = $ManualTotalDiscPercent;
        return $this;
    }

    /**
     * @return string
     */
    public function getManualTotalDiscPercent()
    {
        return $this->ManualTotalDiscPercent;
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
     * @param string $PriceGroupCode
     * @return $this
     */
    public function setPriceGroupCode($PriceGroupCode)
    {
        $this->PriceGroupCode = $PriceGroupCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getPriceGroupCode()
    {
        return $this->PriceGroupCode;
    }

    /**
     * @param string $ReceiptNo
     * @return $this
     */
    public function setReceiptNo($ReceiptNo)
    {
        $this->ReceiptNo = $ReceiptNo;
        return $this;
    }

    /**
     * @return string
     */
    public function getReceiptNo()
    {
        return $this->ReceiptNo;
    }

    /**
     * @param string $ShippingPrice
     * @return $this
     */
    public function setShippingPrice($ShippingPrice)
    {
        $this->ShippingPrice = $ShippingPrice;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingPrice()
    {
        return $this->ShippingPrice;
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

    /**
     * @param string $TotalAmount
     * @return $this
     */
    public function setTotalAmount($TotalAmount)
    {
        $this->TotalAmount = $TotalAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getTotalAmount()
    {
        return $this->TotalAmount;
    }

    /**
     * @param string $TotalDiscAmount
     * @return $this
     */
    public function setTotalDiscAmount($TotalDiscAmount)
    {
        $this->TotalDiscAmount = $TotalDiscAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getTotalDiscAmount()
    {
        return $this->TotalDiscAmount;
    }

    /**
     * @param string $TotalNetAmount
     * @return $this
     */
    public function setTotalNetAmount($TotalNetAmount)
    {
        $this->TotalNetAmount = $TotalNetAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getTotalNetAmount()
    {
        return $this->TotalNetAmount;
    }

    /**
     * @param string $TotalTaxAmount
     * @return $this
     */
    public function setTotalTaxAmount($TotalTaxAmount)
    {
        $this->TotalTaxAmount = $TotalTaxAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getTotalTaxAmount()
    {
        return $this->TotalTaxAmount;
    }

    /**
     * @param string $TransDate
     * @return $this
     */
    public function setTransDate($TransDate)
    {
        $this->TransDate = $TransDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransDate()
    {
        return $this->TransDate;
    }

    /**
     * @param string $TransactionNo
     * @return $this
     */
    public function setTransactionNo($TransactionNo)
    {
        $this->TransactionNo = $TransactionNo;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionNo()
    {
        return $this->TransactionNo;
    }

    /**
     * @return ArrayOfBasketLineCalcResponse
     */
    public function getResult()
    {
        return $this->BasketLineCalcResponses;
    }


}

