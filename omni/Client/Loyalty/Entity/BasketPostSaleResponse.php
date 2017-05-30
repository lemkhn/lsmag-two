<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use Ls\Omni\Client\Loyalty\Entity\Enum\DocumentType;
use Ls\Omni\Exception\InvalidEnumException;
use Ls\Omni\Client\IResponse;

class BasketPostSaleResponse implements IResponse
{

    /**
     * @property string $BasketPrice
     */
    protected $BasketPrice = null;

    /**
     * @property string $CardId
     */
    protected $CardId = null;

    /**
     * @property string $ContactId
     */
    protected $ContactId = null;

    /**
     * @property string $DocumentNumber
     */
    protected $DocumentNumber = null;

    /**
     * @property DocumentType $DocumentType
     */
    protected $DocumentType = null;

    /**
     * @property string $Id
     */
    protected $Id = null;

    /**
     * @property string $StoreId
     */
    protected $StoreId = null;

    /**
     * @param string $BasketPrice
     * @return $this
     */
    public function setBasketPrice($BasketPrice)
    {
        $this->BasketPrice = $BasketPrice;
        return $this;
    }

    /**
     * @return string
     */
    public function getBasketPrice()
    {
        return $this->BasketPrice;
    }

    /**
     * @param string $CardId
     * @return $this
     */
    public function setCardId($CardId)
    {
        $this->CardId = $CardId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCardId()
    {
        return $this->CardId;
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
     * @param string $DocumentNumber
     * @return $this
     */
    public function setDocumentNumber($DocumentNumber)
    {
        $this->DocumentNumber = $DocumentNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocumentNumber()
    {
        return $this->DocumentNumber;
    }

    /**
     * @param DocumentType|string $DocumentType
     * @return $this
     * @throws InvalidEnumException
     */
    public function setDocumentType($DocumentType)
    {
        if ( DocumentType::isValid( $DocumentType) ) 
            $this->DocumentType = new DocumentType( $DocumentType );
        elseif ( DocumentType::isValidKey( $DocumentType) ) 
            $this->DocumentType = new DocumentType( constant( "DocumentType::$DocumentType" ) );
        else 
            throw new InvalidEnumException();
        return $this;
    }

    /**
     * @return DocumentType
     */
    public function getDocumentType()
    {
        return $this->DocumentType;
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
     * @return string
     */
    public function getResult()
    {
        return $this->BasketPrice;
    }


}

