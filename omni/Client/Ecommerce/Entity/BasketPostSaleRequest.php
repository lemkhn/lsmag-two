<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use Ls\Omni\Client\Ecommerce\Entity\Enum\ItemNumberType;
use Ls\Omni\Client\Ecommerce\Entity\Enum\SourceType;
use Ls\Omni\Exception\InvalidEnumException;

class BasketPostSaleRequest
{

    /**
     * @property ArrayOfBasketPostCostLineRequest $BasketPostCostLineRequests
     */
    protected $BasketPostCostLineRequests = null;

    /**
     * @property ArrayOfBasketPostSaleDiscLineRequest $BasketPostSaleDiscLineRequests
     */
    protected $BasketPostSaleDiscLineRequests = null;

    /**
     * @property ArrayOfBasketPostSaleLineRequest $BasketPostSaleLineRequests
     */
    protected $BasketPostSaleLineRequests = null;

    /**
     * @property float $BasketPrice
     */
    protected $BasketPrice = null;

    /**
     * @property Address $BillingAddress
     */
    protected $BillingAddress = null;

    /**
     * @property string $ContactId
     */
    protected $ContactId = null;

    /**
     * @property string $CurrencyCode
     */
    protected $CurrencyCode = null;

    /**
     * @property string $Email
     */
    protected $Email = null;

    /**
     * @property string $ExternalOrderId
     */
    protected $ExternalOrderId = null;

    /**
     * @property string $FullName
     */
    protected $FullName = null;

    /**
     * @property string $Id
     */
    protected $Id = null;

    /**
     * @property ItemNumberType $ItemNumberType
     */
    protected $ItemNumberType = null;

    /**
     * @property string $MemberCardNo
     */
    protected $MemberCardNo = null;

    /**
     * @property string $MobilePhoneNumber
     */
    protected $MobilePhoneNumber = null;

    /**
     * @property string $PhoneNumber
     */
    protected $PhoneNumber = null;

    /**
     * @property boolean $PriceIncludesVAT
     */
    protected $PriceIncludesVAT = null;

    /**
     * @property string $ShipmentMethodCode
     */
    protected $ShipmentMethodCode = null;

    /**
     * @property Address $ShippingAddress
     */
    protected $ShippingAddress = null;

    /**
     * @property ShippingDetails $ShippingInformation
     */
    protected $ShippingInformation = null;

    /**
     * @property SourceType $SourceType
     */
    protected $SourceType = null;

    /**
     * @property ArrayOfTenderPaymentLine $TenderLines
     */
    protected $TenderLines = null;

    /**
     * @param ArrayOfBasketPostCostLineRequest $BasketPostCostLineRequests
     * @return $this
     */
    public function setBasketPostCostLineRequests($BasketPostCostLineRequests)
    {
        $this->BasketPostCostLineRequests = $BasketPostCostLineRequests;
        return $this;
    }

    /**
     * @return ArrayOfBasketPostCostLineRequest
     */
    public function getBasketPostCostLineRequests()
    {
        return $this->BasketPostCostLineRequests;
    }

    /**
     * @param ArrayOfBasketPostSaleDiscLineRequest $BasketPostSaleDiscLineRequests
     * @return $this
     */
    public function setBasketPostSaleDiscLineRequests($BasketPostSaleDiscLineRequests)
    {
        $this->BasketPostSaleDiscLineRequests = $BasketPostSaleDiscLineRequests;
        return $this;
    }

    /**
     * @return ArrayOfBasketPostSaleDiscLineRequest
     */
    public function getBasketPostSaleDiscLineRequests()
    {
        return $this->BasketPostSaleDiscLineRequests;
    }

    /**
     * @param ArrayOfBasketPostSaleLineRequest $BasketPostSaleLineRequests
     * @return $this
     */
    public function setBasketPostSaleLineRequests($BasketPostSaleLineRequests)
    {
        $this->BasketPostSaleLineRequests = $BasketPostSaleLineRequests;
        return $this;
    }

    /**
     * @return ArrayOfBasketPostSaleLineRequest
     */
    public function getBasketPostSaleLineRequests()
    {
        return $this->BasketPostSaleLineRequests;
    }

    /**
     * @param float $BasketPrice
     * @return $this
     */
    public function setBasketPrice($BasketPrice)
    {
        $this->BasketPrice = $BasketPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getBasketPrice()
    {
        return $this->BasketPrice;
    }

    /**
     * @param Address $BillingAddress
     * @return $this
     */
    public function setBillingAddress($BillingAddress)
    {
        $this->BillingAddress = $BillingAddress;
        return $this;
    }

    /**
     * @return Address
     */
    public function getBillingAddress()
    {
        return $this->BillingAddress;
    }

    /**
     * @param string $ContactId
     * @return $this
     */
    public function setContactId($ContactId)
    {
        $this->ContactId = $ContactId;
        return $this;
    }

    /**
     * @return string
     */
    public function getContactId()
    {
        return $this->ContactId;
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
     * @param string $Email
     * @return $this
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param string $ExternalOrderId
     * @return $this
     */
    public function setExternalOrderId($ExternalOrderId)
    {
        $this->ExternalOrderId = $ExternalOrderId;
        return $this;
    }

    /**
     * @return string
     */
    public function getExternalOrderId()
    {
        return $this->ExternalOrderId;
    }

    /**
     * @param string $FullName
     * @return $this
     */
    public function setFullName($FullName)
    {
        $this->FullName = $FullName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->FullName;
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
     * @param ItemNumberType|string $ItemNumberType
     * @return $this
     * @throws InvalidEnumException
     */
    public function setItemNumberType($ItemNumberType)
    {
        if ( ItemNumberType::isValid( $ItemNumberType) ) 
            $this->ItemNumberType = new ItemNumberType( $ItemNumberType );
        elseif ( ItemNumberType::isValidKey( $ItemNumberType) ) 
            $this->ItemNumberType = new ItemNumberType( constant( "ItemNumberType::$ItemNumberType" ) );
        else 
            throw new InvalidEnumException();
        return $this;
    }

    /**
     * @return ItemNumberType
     */
    public function getItemNumberType()
    {
        return $this->ItemNumberType;
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
     * @param string $MobilePhoneNumber
     * @return $this
     */
    public function setMobilePhoneNumber($MobilePhoneNumber)
    {
        $this->MobilePhoneNumber = $MobilePhoneNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getMobilePhoneNumber()
    {
        return $this->MobilePhoneNumber;
    }

    /**
     * @param string $PhoneNumber
     * @return $this
     */
    public function setPhoneNumber($PhoneNumber)
    {
        $this->PhoneNumber = $PhoneNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->PhoneNumber;
    }

    /**
     * @param boolean $PriceIncludesVAT
     * @return $this
     */
    public function setPriceIncludesVAT($PriceIncludesVAT)
    {
        $this->PriceIncludesVAT = $PriceIncludesVAT;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getPriceIncludesVAT()
    {
        return $this->PriceIncludesVAT;
    }

    /**
     * @param string $ShipmentMethodCode
     * @return $this
     */
    public function setShipmentMethodCode($ShipmentMethodCode)
    {
        $this->ShipmentMethodCode = $ShipmentMethodCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getShipmentMethodCode()
    {
        return $this->ShipmentMethodCode;
    }

    /**
     * @param Address $ShippingAddress
     * @return $this
     */
    public function setShippingAddress($ShippingAddress)
    {
        $this->ShippingAddress = $ShippingAddress;
        return $this;
    }

    /**
     * @return Address
     */
    public function getShippingAddress()
    {
        return $this->ShippingAddress;
    }

    /**
     * @param ShippingDetails $ShippingInformation
     * @return $this
     */
    public function setShippingInformation($ShippingInformation)
    {
        $this->ShippingInformation = $ShippingInformation;
        return $this;
    }

    /**
     * @return ShippingDetails
     */
    public function getShippingInformation()
    {
        return $this->ShippingInformation;
    }

    /**
     * @param SourceType|string $SourceType
     * @return $this
     * @throws InvalidEnumException
     */
    public function setSourceType($SourceType)
    {
        if ( SourceType::isValid( $SourceType) ) 
            $this->SourceType = new SourceType( $SourceType );
        elseif ( SourceType::isValidKey( $SourceType) ) 
            $this->SourceType = new SourceType( constant( "SourceType::$SourceType" ) );
        else 
            throw new InvalidEnumException();
        return $this;
    }

    /**
     * @return SourceType
     */
    public function getSourceType()
    {
        return $this->SourceType;
    }

    /**
     * @param ArrayOfTenderPaymentLine $TenderLines
     * @return $this
     */
    public function setTenderLines($TenderLines)
    {
        $this->TenderLines = $TenderLines;
        return $this;
    }

    /**
     * @return ArrayOfTenderPaymentLine
     */
    public function getTenderLines()
    {
        return $this->TenderLines;
    }


}

