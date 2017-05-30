<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use Ls\Omni\Client\Loyalty\Entity\Enum\OfferType;
use Ls\Omni\Exception\InvalidEnumException;

class Offer
{

    /**
     * @property string $Description
     */
    protected $Description = null;

    /**
     * @property string $Details
     */
    protected $Details = null;

    /**
     * @property string $ExpirationDate
     */
    protected $ExpirationDate = null;

    /**
     * @property string $Id
     */
    protected $Id = null;

    /**
     * @property ArrayOfImageView $Images
     */
    protected $Images = null;

    /**
     * @property int $RV
     */
    protected $RV = null;

    /**
     * @property OfferType $Type
     */
    protected $Type = null;

    /**
     * @property string $ValidationText
     */
    protected $ValidationText = null;

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
     * @param string $ExpirationDate
     * @return $this
     */
    public function setExpirationDate($ExpirationDate)
    {
        $this->ExpirationDate = $ExpirationDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpirationDate()
    {
        return $this->ExpirationDate;
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
     * @param ArrayOfImageView $Images
     * @return $this
     */
    public function setImages($Images)
    {
        $this->Images = $Images;
        return $this;
    }

    /**
     * @return ArrayOfImageView
     */
    public function getImages()
    {
        return $this->Images;
    }

    /**
     * @param int $RV
     * @return $this
     */
    public function setRV($RV)
    {
        $this->RV = $RV;
        return $this;
    }

    /**
     * @return int
     */
    public function getRV()
    {
        return $this->RV;
    }

    /**
     * @param OfferType|string $Type
     * @return $this
     * @throws InvalidEnumException
     */
    public function setType($Type)
    {
        if ( OfferType::isValid( $Type) ) 
            $this->Type = new OfferType( $Type );
        elseif ( OfferType::isValidKey( $Type) ) 
            $this->Type = new OfferType( constant( "OfferType::$Type" ) );
        else 
            throw new InvalidEnumException();
        return $this;
    }

    /**
     * @return OfferType
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * @param string $ValidationText
     * @return $this
     */
    public function setValidationText($ValidationText)
    {
        $this->ValidationText = $ValidationText;
        return $this;
    }

    /**
     * @return string
     */
    public function getValidationText()
    {
        return $this->ValidationText;
    }


}

