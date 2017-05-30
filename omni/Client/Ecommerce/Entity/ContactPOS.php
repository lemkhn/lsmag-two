<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use Ls\Omni\Client\Ecommerce\Entity\Enum\Gender;
use Ls\Omni\Client\Ecommerce\Entity\Enum\MaritalStatus;
use Ls\Omni\Exception\InvalidEnumException;

class ContactPOS
{

    /**
     * @property Account $Account
     */
    protected $Account = null;

    /**
     * @property ArrayOfAddress $Addresses
     */
    protected $Addresses = null;

    /**
     * @property string $AlternateId
     */
    protected $AlternateId = null;

    /**
     * @property string $BirthDay
     */
    protected $BirthDay = null;

    /**
     * @property string $BlockedReason
     */
    protected $BlockedReason = null;

    /**
     * @property Card $Card
     */
    protected $Card = null;

    /**
     * @property ArrayOfCard $Cards
     */
    protected $Cards = null;

    /**
     * @property ArrayOfCoupon $Coupons
     */
    protected $Coupons = null;

    /**
     * @property string $Email
     */
    protected $Email = null;

    /**
     * @property string $FirstName
     */
    protected $FirstName = null;

    /**
     * @property Gender $Gender
     */
    protected $Gender = null;

    /**
     * @property string $Id
     */
    protected $Id = null;

    /**
     * @property boolean $IsBlocked
     */
    protected $IsBlocked = null;

    /**
     * @property string $LastName
     */
    protected $LastName = null;

    /**
     * @property MaritalStatus $MaritalStatus
     */
    protected $MaritalStatus = null;

    /**
     * @property string $MiddleName
     */
    protected $MiddleName = null;

    /**
     * @property string $MobilePhone
     */
    protected $MobilePhone = null;

    /**
     * @property ArrayOfOffer $Offers
     */
    protected $Offers = null;

    /**
     * @property string $Password
     */
    protected $Password = null;

    /**
     * @property string $Phone
     */
    protected $Phone = null;

    /**
     * @property ArrayOfProfile $Profiles
     */
    protected $Profiles = null;

    /**
     * @property ArrayOfTransaction $Transactions
     */
    protected $Transactions = null;

    /**
     * @property string $UserName
     */
    protected $UserName = null;

    /**
     * @param Account $Account
     * @return $this
     */
    public function setAccount($Account)
    {
        $this->Account = $Account;
        return $this;
    }

    /**
     * @return Account
     */
    public function getAccount()
    {
        return $this->Account;
    }

    /**
     * @param ArrayOfAddress $Addresses
     * @return $this
     */
    public function setAddresses($Addresses)
    {
        $this->Addresses = $Addresses;
        return $this;
    }

    /**
     * @return ArrayOfAddress
     */
    public function getAddresses()
    {
        return $this->Addresses;
    }

    /**
     * @param string $AlternateId
     * @return $this
     */
    public function setAlternateId($AlternateId)
    {
        $this->AlternateId = $AlternateId;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlternateId()
    {
        return $this->AlternateId;
    }

    /**
     * @param string $BirthDay
     * @return $this
     */
    public function setBirthDay($BirthDay)
    {
        $this->BirthDay = $BirthDay;
        return $this;
    }

    /**
     * @return string
     */
    public function getBirthDay()
    {
        return $this->BirthDay;
    }

    /**
     * @param string $BlockedReason
     * @return $this
     */
    public function setBlockedReason($BlockedReason)
    {
        $this->BlockedReason = $BlockedReason;
        return $this;
    }

    /**
     * @return string
     */
    public function getBlockedReason()
    {
        return $this->BlockedReason;
    }

    /**
     * @param Card $Card
     * @return $this
     */
    public function setCard($Card)
    {
        $this->Card = $Card;
        return $this;
    }

    /**
     * @return Card
     */
    public function getCard()
    {
        return $this->Card;
    }

    /**
     * @param ArrayOfCard $Cards
     * @return $this
     */
    public function setCards($Cards)
    {
        $this->Cards = $Cards;
        return $this;
    }

    /**
     * @return ArrayOfCard
     */
    public function getCards()
    {
        return $this->Cards;
    }

    /**
     * @param ArrayOfCoupon $Coupons
     * @return $this
     */
    public function setCoupons($Coupons)
    {
        $this->Coupons = $Coupons;
        return $this;
    }

    /**
     * @return ArrayOfCoupon
     */
    public function getCoupons()
    {
        return $this->Coupons;
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
     * @param string $FirstName
     * @return $this
     */
    public function setFirstName($FirstName)
    {
        $this->FirstName = $FirstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->FirstName;
    }

    /**
     * @param Gender|string $Gender
     * @return $this
     * @throws InvalidEnumException
     */
    public function setGender($Gender)
    {
        if ( Gender::isValid( $Gender) ) 
            $this->Gender = new Gender( $Gender );
        elseif ( Gender::isValidKey( $Gender) ) 
            $this->Gender = new Gender( constant( "Gender::$Gender" ) );
        else 
            throw new InvalidEnumException();
        return $this;
    }

    /**
     * @return Gender
     */
    public function getGender()
    {
        return $this->Gender;
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
     * @param boolean $IsBlocked
     * @return $this
     */
    public function setIsBlocked($IsBlocked)
    {
        $this->IsBlocked = $IsBlocked;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsBlocked()
    {
        return $this->IsBlocked;
    }

    /**
     * @param string $LastName
     * @return $this
     */
    public function setLastName($LastName)
    {
        $this->LastName = $LastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->LastName;
    }

    /**
     * @param MaritalStatus|string $MaritalStatus
     * @return $this
     * @throws InvalidEnumException
     */
    public function setMaritalStatus($MaritalStatus)
    {
        if ( MaritalStatus::isValid( $MaritalStatus) ) 
            $this->MaritalStatus = new MaritalStatus( $MaritalStatus );
        elseif ( MaritalStatus::isValidKey( $MaritalStatus) ) 
            $this->MaritalStatus = new MaritalStatus( constant( "MaritalStatus::$MaritalStatus" ) );
        else 
            throw new InvalidEnumException();
        return $this;
    }

    /**
     * @return MaritalStatus
     */
    public function getMaritalStatus()
    {
        return $this->MaritalStatus;
    }

    /**
     * @param string $MiddleName
     * @return $this
     */
    public function setMiddleName($MiddleName)
    {
        $this->MiddleName = $MiddleName;
        return $this;
    }

    /**
     * @return string
     */
    public function getMiddleName()
    {
        return $this->MiddleName;
    }

    /**
     * @param string $MobilePhone
     * @return $this
     */
    public function setMobilePhone($MobilePhone)
    {
        $this->MobilePhone = $MobilePhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getMobilePhone()
    {
        return $this->MobilePhone;
    }

    /**
     * @param ArrayOfOffer $Offers
     * @return $this
     */
    public function setOffers($Offers)
    {
        $this->Offers = $Offers;
        return $this;
    }

    /**
     * @return ArrayOfOffer
     */
    public function getOffers()
    {
        return $this->Offers;
    }

    /**
     * @param string $Password
     * @return $this
     */
    public function setPassword($Password)
    {
        $this->Password = $Password;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * @param string $Phone
     * @return $this
     */
    public function setPhone($Phone)
    {
        $this->Phone = $Phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->Phone;
    }

    /**
     * @param ArrayOfProfile $Profiles
     * @return $this
     */
    public function setProfiles($Profiles)
    {
        $this->Profiles = $Profiles;
        return $this;
    }

    /**
     * @return ArrayOfProfile
     */
    public function getProfiles()
    {
        return $this->Profiles;
    }

    /**
     * @param ArrayOfTransaction $Transactions
     * @return $this
     */
    public function setTransactions($Transactions)
    {
        $this->Transactions = $Transactions;
        return $this;
    }

    /**
     * @return ArrayOfTransaction
     */
    public function getTransactions()
    {
        return $this->Transactions;
    }

    /**
     * @param string $UserName
     * @return $this
     */
    public function setUserName($UserName)
    {
        $this->UserName = $UserName;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->UserName;
    }


}

