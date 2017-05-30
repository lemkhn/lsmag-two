<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

class SaleLine
{

    /**
     * @property string $Amount
     */
    protected $Amount = null;

    /**
     * @property float $Amt
     */
    protected $Amt = null;

    /**
     * @property string $DiscountAmount
     */
    protected $DiscountAmount = null;

    /**
     * @property float $DiscountAmt
     */
    protected $DiscountAmt = null;

    /**
     * @property ArrayOfExtraInfoLine $ExtraInfoLines
     */
    protected $ExtraInfoLines = null;

    /**
     * @property string $Id
     */
    protected $Id = null;

    /**
     * @property Item $Item
     */
    protected $Item = null;

    /**
     * @property string $NetAmount
     */
    protected $NetAmount = null;

    /**
     * @property float $NetAmt
     */
    protected $NetAmt = null;

    /**
     * @property float $Quantity
     */
    protected $Quantity = null;

    /**
     * @property string $StoreId
     */
    protected $StoreId = null;

    /**
     * @property string $TerminalId
     */
    protected $TerminalId = null;

    /**
     * @property string $TransactionId
     */
    protected $TransactionId = null;

    /**
     * @property UOM $Uom
     */
    protected $Uom = null;

    /**
     * @property Variant $Variant
     */
    protected $Variant = null;

    /**
     * @property string $VatAmount
     */
    protected $VatAmount = null;

    /**
     * @property float $VatAmt
     */
    protected $VatAmt = null;

    /**
     * @param string $Amount
     * @return $this
     */
    public function setAmount($Amount)
    {
        $this->Amount = $Amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->Amount;
    }

    /**
     * @param float $Amt
     * @return $this
     */
    public function setAmt($Amt)
    {
        $this->Amt = $Amt;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmt()
    {
        return $this->Amt;
    }

    /**
     * @param string $DiscountAmount
     * @return $this
     */
    public function setDiscountAmount($DiscountAmount)
    {
        $this->DiscountAmount = $DiscountAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getDiscountAmount()
    {
        return $this->DiscountAmount;
    }

    /**
     * @param float $DiscountAmt
     * @return $this
     */
    public function setDiscountAmt($DiscountAmt)
    {
        $this->DiscountAmt = $DiscountAmt;
        return $this;
    }

    /**
     * @return float
     */
    public function getDiscountAmt()
    {
        return $this->DiscountAmt;
    }

    /**
     * @param ArrayOfExtraInfoLine $ExtraInfoLines
     * @return $this
     */
    public function setExtraInfoLines($ExtraInfoLines)
    {
        $this->ExtraInfoLines = $ExtraInfoLines;
        return $this;
    }

    /**
     * @return ArrayOfExtraInfoLine
     */
    public function getExtraInfoLines()
    {
        return $this->ExtraInfoLines;
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
     * @param Item $Item
     * @return $this
     */
    public function setItem($Item)
    {
        $this->Item = $Item;
        return $this;
    }

    /**
     * @return Item
     */
    public function getItem()
    {
        return $this->Item;
    }

    /**
     * @param string $NetAmount
     * @return $this
     */
    public function setNetAmount($NetAmount)
    {
        $this->NetAmount = $NetAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getNetAmount()
    {
        return $this->NetAmount;
    }

    /**
     * @param float $NetAmt
     * @return $this
     */
    public function setNetAmt($NetAmt)
    {
        $this->NetAmt = $NetAmt;
        return $this;
    }

    /**
     * @return float
     */
    public function getNetAmt()
    {
        return $this->NetAmt;
    }

    /**
     * @param float $Quantity
     * @return $this
     */
    public function setQuantity($Quantity)
    {
        $this->Quantity = $Quantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getQuantity()
    {
        return $this->Quantity;
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
     * @param string $TransactionId
     * @return $this
     */
    public function setTransactionId($TransactionId)
    {
        $this->TransactionId = $TransactionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->TransactionId;
    }

    /**
     * @param UOM $Uom
     * @return $this
     */
    public function setUom($Uom)
    {
        $this->Uom = $Uom;
        return $this;
    }

    /**
     * @return UOM
     */
    public function getUom()
    {
        return $this->Uom;
    }

    /**
     * @param Variant $Variant
     * @return $this
     */
    public function setVariant($Variant)
    {
        $this->Variant = $Variant;
        return $this;
    }

    /**
     * @return Variant
     */
    public function getVariant()
    {
        return $this->Variant;
    }

    /**
     * @param string $VatAmount
     * @return $this
     */
    public function setVatAmount($VatAmount)
    {
        $this->VatAmount = $VatAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getVatAmount()
    {
        return $this->VatAmount;
    }

    /**
     * @param float $VatAmt
     * @return $this
     */
    public function setVatAmt($VatAmt)
    {
        $this->VatAmt = $VatAmt;
        return $this;
    }

    /**
     * @return float
     */
    public function getVatAmt()
    {
        return $this->VatAmt;
    }


}

