<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

class ReplItem
{

    /**
     * @property string $BaseUnitOfMeasure
     */
    protected $BaseUnitOfMeasure = null;

    /**
     * @property int $BlockDiscount
     */
    protected $BlockDiscount = null;

    /**
     * @property int $BlockDistribution
     */
    protected $BlockDistribution = null;

    /**
     * @property int $BlockManualPriceChange
     */
    protected $BlockManualPriceChange = null;

    /**
     * @property int $BlockNegativeAdjustment
     */
    protected $BlockNegativeAdjustment = null;

    /**
     * @property int $BlockPositiveAdjustment
     */
    protected $BlockPositiveAdjustment = null;

    /**
     * @property int $BlockPurchaseReturn
     */
    protected $BlockPurchaseReturn = null;

    /**
     * @property int $Blocked
     */
    protected $Blocked = null;

    /**
     * @property int $BlockedOnECom
     */
    protected $BlockedOnECom = null;

    /**
     * @property int $BlockedOnPos
     */
    protected $BlockedOnPos = null;

    /**
     * @property int $CrossSellingExists
     */
    protected $CrossSellingExists = null;

    /**
     * @property string $DateBlocked
     */
    protected $DateBlocked = null;

    /**
     * @property string $DateToActivateItem
     */
    protected $DateToActivateItem = null;

    /**
     * @property string $Description
     */
    protected $Description = null;

    /**
     * @property string $Details
     */
    protected $Details = null;

    /**
     * @property float $GrossWeight
     */
    protected $GrossWeight = null;

    /**
     * @property string $Id
     */
    protected $Id = null;

    /**
     * @property boolean $IsDeleted
     */
    protected $IsDeleted = null;

    /**
     * @property string $ItemCategoryCode
     */
    protected $ItemCategoryCode = null;

    /**
     * @property string $ItemFamilyCode
     */
    protected $ItemFamilyCode = null;

    /**
     * @property int $KeyingInPrice
     */
    protected $KeyingInPrice = null;

    /**
     * @property int $KeyingInQty
     */
    protected $KeyingInQty = null;

    /**
     * @property int $MustKeyInComment
     */
    protected $MustKeyInComment = null;

    /**
     * @property int $NoDiscountAllowed
     */
    protected $NoDiscountAllowed = null;

    /**
     * @property string $ProductGroupId
     */
    protected $ProductGroupId = null;

    /**
     * @property string $PurchUnitOfMeasure
     */
    protected $PurchUnitOfMeasure = null;

    /**
     * @property string $SalseUnitOfMeasure
     */
    protected $SalseUnitOfMeasure = null;

    /**
     * @property int $ScaleItem
     */
    protected $ScaleItem = null;

    /**
     * @property string $SeasonCode
     */
    protected $SeasonCode = null;

    /**
     * @property string $TaxItemGroupId
     */
    protected $TaxItemGroupId = null;

    /**
     * @property float $UnitPrice
     */
    protected $UnitPrice = null;

    /**
     * @property float $UnitVolume
     */
    protected $UnitVolume = null;

    /**
     * @property float $UnitsPerParcel
     */
    protected $UnitsPerParcel = null;

    /**
     * @property string $VendorId
     */
    protected $VendorId = null;

    /**
     * @property string $VendorItemId
     */
    protected $VendorItemId = null;

    /**
     * @property int $ZeroPriceValId
     */
    protected $ZeroPriceValId = null;

    /**
     * @property string $scope
     */
    protected $scope = null;

    /**
     * @property int $scope_id
     */
    protected $scope_id = null;

    /**
     * @param string $BaseUnitOfMeasure
     * @return $this
     */
    public function setBaseUnitOfMeasure($BaseUnitOfMeasure)
    {
        $this->BaseUnitOfMeasure = $BaseUnitOfMeasure;
        return $this;
    }

    /**
     * @return string
     */
    public function getBaseUnitOfMeasure()
    {
        return $this->BaseUnitOfMeasure;
    }

    /**
     * @param int $BlockDiscount
     * @return $this
     */
    public function setBlockDiscount($BlockDiscount)
    {
        $this->BlockDiscount = $BlockDiscount;
        return $this;
    }

    /**
     * @return int
     */
    public function getBlockDiscount()
    {
        return $this->BlockDiscount;
    }

    /**
     * @param int $BlockDistribution
     * @return $this
     */
    public function setBlockDistribution($BlockDistribution)
    {
        $this->BlockDistribution = $BlockDistribution;
        return $this;
    }

    /**
     * @return int
     */
    public function getBlockDistribution()
    {
        return $this->BlockDistribution;
    }

    /**
     * @param int $BlockManualPriceChange
     * @return $this
     */
    public function setBlockManualPriceChange($BlockManualPriceChange)
    {
        $this->BlockManualPriceChange = $BlockManualPriceChange;
        return $this;
    }

    /**
     * @return int
     */
    public function getBlockManualPriceChange()
    {
        return $this->BlockManualPriceChange;
    }

    /**
     * @param int $BlockNegativeAdjustment
     * @return $this
     */
    public function setBlockNegativeAdjustment($BlockNegativeAdjustment)
    {
        $this->BlockNegativeAdjustment = $BlockNegativeAdjustment;
        return $this;
    }

    /**
     * @return int
     */
    public function getBlockNegativeAdjustment()
    {
        return $this->BlockNegativeAdjustment;
    }

    /**
     * @param int $BlockPositiveAdjustment
     * @return $this
     */
    public function setBlockPositiveAdjustment($BlockPositiveAdjustment)
    {
        $this->BlockPositiveAdjustment = $BlockPositiveAdjustment;
        return $this;
    }

    /**
     * @return int
     */
    public function getBlockPositiveAdjustment()
    {
        return $this->BlockPositiveAdjustment;
    }

    /**
     * @param int $BlockPurchaseReturn
     * @return $this
     */
    public function setBlockPurchaseReturn($BlockPurchaseReturn)
    {
        $this->BlockPurchaseReturn = $BlockPurchaseReturn;
        return $this;
    }

    /**
     * @return int
     */
    public function getBlockPurchaseReturn()
    {
        return $this->BlockPurchaseReturn;
    }

    /**
     * @param int $Blocked
     * @return $this
     */
    public function setBlocked($Blocked)
    {
        $this->Blocked = $Blocked;
        return $this;
    }

    /**
     * @return int
     */
    public function getBlocked()
    {
        return $this->Blocked;
    }

    /**
     * @param int $BlockedOnECom
     * @return $this
     */
    public function setBlockedOnECom($BlockedOnECom)
    {
        $this->BlockedOnECom = $BlockedOnECom;
        return $this;
    }

    /**
     * @return int
     */
    public function getBlockedOnECom()
    {
        return $this->BlockedOnECom;
    }

    /**
     * @param int $BlockedOnPos
     * @return $this
     */
    public function setBlockedOnPos($BlockedOnPos)
    {
        $this->BlockedOnPos = $BlockedOnPos;
        return $this;
    }

    /**
     * @return int
     */
    public function getBlockedOnPos()
    {
        return $this->BlockedOnPos;
    }

    /**
     * @param int $CrossSellingExists
     * @return $this
     */
    public function setCrossSellingExists($CrossSellingExists)
    {
        $this->CrossSellingExists = $CrossSellingExists;
        return $this;
    }

    /**
     * @return int
     */
    public function getCrossSellingExists()
    {
        return $this->CrossSellingExists;
    }

    /**
     * @param string $DateBlocked
     * @return $this
     */
    public function setDateBlocked($DateBlocked)
    {
        $this->DateBlocked = $DateBlocked;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateBlocked()
    {
        return $this->DateBlocked;
    }

    /**
     * @param string $DateToActivateItem
     * @return $this
     */
    public function setDateToActivateItem($DateToActivateItem)
    {
        $this->DateToActivateItem = $DateToActivateItem;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateToActivateItem()
    {
        return $this->DateToActivateItem;
    }

    /**
     * @param string $Description
     * @return $this
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param string $Details
     * @return $this
     */
    public function setDetails($Details)
    {
        $this->Details = $Details;
        return $this;
    }

    /**
     * @return string
     */
    public function getDetails()
    {
        return $this->Details;
    }

    /**
     * @param float $GrossWeight
     * @return $this
     */
    public function setGrossWeight($GrossWeight)
    {
        $this->GrossWeight = $GrossWeight;
        return $this;
    }

    /**
     * @return float
     */
    public function getGrossWeight()
    {
        return $this->GrossWeight;
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
     * @param boolean $IsDeleted
     * @return $this
     */
    public function setIsDeleted($IsDeleted)
    {
        $this->IsDeleted = $IsDeleted;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsDeleted()
    {
        return $this->IsDeleted;
    }

    /**
     * @param string $ItemCategoryCode
     * @return $this
     */
    public function setItemCategoryCode($ItemCategoryCode)
    {
        $this->ItemCategoryCode = $ItemCategoryCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getItemCategoryCode()
    {
        return $this->ItemCategoryCode;
    }

    /**
     * @param string $ItemFamilyCode
     * @return $this
     */
    public function setItemFamilyCode($ItemFamilyCode)
    {
        $this->ItemFamilyCode = $ItemFamilyCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getItemFamilyCode()
    {
        return $this->ItemFamilyCode;
    }

    /**
     * @param int $KeyingInPrice
     * @return $this
     */
    public function setKeyingInPrice($KeyingInPrice)
    {
        $this->KeyingInPrice = $KeyingInPrice;
        return $this;
    }

    /**
     * @return int
     */
    public function getKeyingInPrice()
    {
        return $this->KeyingInPrice;
    }

    /**
     * @param int $KeyingInQty
     * @return $this
     */
    public function setKeyingInQty($KeyingInQty)
    {
        $this->KeyingInQty = $KeyingInQty;
        return $this;
    }

    /**
     * @return int
     */
    public function getKeyingInQty()
    {
        return $this->KeyingInQty;
    }

    /**
     * @param int $MustKeyInComment
     * @return $this
     */
    public function setMustKeyInComment($MustKeyInComment)
    {
        $this->MustKeyInComment = $MustKeyInComment;
        return $this;
    }

    /**
     * @return int
     */
    public function getMustKeyInComment()
    {
        return $this->MustKeyInComment;
    }

    /**
     * @param int $NoDiscountAllowed
     * @return $this
     */
    public function setNoDiscountAllowed($NoDiscountAllowed)
    {
        $this->NoDiscountAllowed = $NoDiscountAllowed;
        return $this;
    }

    /**
     * @return int
     */
    public function getNoDiscountAllowed()
    {
        return $this->NoDiscountAllowed;
    }

    /**
     * @param string $ProductGroupId
     * @return $this
     */
    public function setProductGroupId($ProductGroupId)
    {
        $this->ProductGroupId = $ProductGroupId;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductGroupId()
    {
        return $this->ProductGroupId;
    }

    /**
     * @param string $PurchUnitOfMeasure
     * @return $this
     */
    public function setPurchUnitOfMeasure($PurchUnitOfMeasure)
    {
        $this->PurchUnitOfMeasure = $PurchUnitOfMeasure;
        return $this;
    }

    /**
     * @return string
     */
    public function getPurchUnitOfMeasure()
    {
        return $this->PurchUnitOfMeasure;
    }

    /**
     * @param string $SalseUnitOfMeasure
     * @return $this
     */
    public function setSalseUnitOfMeasure($SalseUnitOfMeasure)
    {
        $this->SalseUnitOfMeasure = $SalseUnitOfMeasure;
        return $this;
    }

    /**
     * @return string
     */
    public function getSalseUnitOfMeasure()
    {
        return $this->SalseUnitOfMeasure;
    }

    /**
     * @param int $ScaleItem
     * @return $this
     */
    public function setScaleItem($ScaleItem)
    {
        $this->ScaleItem = $ScaleItem;
        return $this;
    }

    /**
     * @return int
     */
    public function getScaleItem()
    {
        return $this->ScaleItem;
    }

    /**
     * @param string $SeasonCode
     * @return $this
     */
    public function setSeasonCode($SeasonCode)
    {
        $this->SeasonCode = $SeasonCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getSeasonCode()
    {
        return $this->SeasonCode;
    }

    /**
     * @param string $TaxItemGroupId
     * @return $this
     */
    public function setTaxItemGroupId($TaxItemGroupId)
    {
        $this->TaxItemGroupId = $TaxItemGroupId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTaxItemGroupId()
    {
        return $this->TaxItemGroupId;
    }

    /**
     * @param float $UnitPrice
     * @return $this
     */
    public function setUnitPrice($UnitPrice)
    {
        $this->UnitPrice = $UnitPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getUnitPrice()
    {
        return $this->UnitPrice;
    }

    /**
     * @param float $UnitVolume
     * @return $this
     */
    public function setUnitVolume($UnitVolume)
    {
        $this->UnitVolume = $UnitVolume;
        return $this;
    }

    /**
     * @return float
     */
    public function getUnitVolume()
    {
        return $this->UnitVolume;
    }

    /**
     * @param float $UnitsPerParcel
     * @return $this
     */
    public function setUnitsPerParcel($UnitsPerParcel)
    {
        $this->UnitsPerParcel = $UnitsPerParcel;
        return $this;
    }

    /**
     * @return float
     */
    public function getUnitsPerParcel()
    {
        return $this->UnitsPerParcel;
    }

    /**
     * @param string $VendorId
     * @return $this
     */
    public function setVendorId($VendorId)
    {
        $this->VendorId = $VendorId;
        return $this;
    }

    /**
     * @return string
     */
    public function getVendorId()
    {
        return $this->VendorId;
    }

    /**
     * @param string $VendorItemId
     * @return $this
     */
    public function setVendorItemId($VendorItemId)
    {
        $this->VendorItemId = $VendorItemId;
        return $this;
    }

    /**
     * @return string
     */
    public function getVendorItemId()
    {
        return $this->VendorItemId;
    }

    /**
     * @param int $ZeroPriceValId
     * @return $this
     */
    public function setZeroPriceValId($ZeroPriceValId)
    {
        $this->ZeroPriceValId = $ZeroPriceValId;
        return $this;
    }

    /**
     * @return int
     */
    public function getZeroPriceValId()
    {
        return $this->ZeroPriceValId;
    }

    /**
     * @param string $scope
     * @return $this
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
        return $this;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param int $scope_id
     * @return $this
     */
    public function setScopeId($scope_id)
    {
        $this->scope_id = $scope_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getScopeId()
    {
        return $this->scope_id;
    }


}

