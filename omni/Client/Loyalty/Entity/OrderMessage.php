<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use Ls\Omni\Client\Loyalty\Entity\Enum\OrderMessageStatus;
use Ls\Omni\Exception\InvalidEnumException;

class OrderMessage
{

    /**
     * @property string $DateCreated
     */
    protected $DateCreated = null;

    /**
     * @property string $DateLastModified
     */
    protected $DateLastModified = null;

    /**
     * @property string $Description
     */
    protected $Description = null;

    /**
     * @property string $Details
     */
    protected $Details = null;

    /**
     * @property string $Guid
     */
    protected $Guid = null;

    /**
     * @property int $Id
     */
    protected $Id = null;

    /**
     * @property OrderMessageStatus $OrderQueueStatus
     */
    protected $OrderQueueStatus = null;

    /**
     * @param string $DateCreated
     * @return $this
     */
    public function setDateCreated($DateCreated)
    {
        $this->DateCreated = $DateCreated;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateCreated()
    {
        return $this->DateCreated;
    }

    /**
     * @param string $DateLastModified
     * @return $this
     */
    public function setDateLastModified($DateLastModified)
    {
        $this->DateLastModified = $DateLastModified;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateLastModified()
    {
        return $this->DateLastModified;
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
     * @param string $Guid
     * @return $this
     */
    public function setGuid($Guid)
    {
        $this->Guid = $Guid;
        return $this;
    }

    /**
     * @return string
     */
    public function getGuid()
    {
        return $this->Guid;
    }

    /**
     * @param int $Id
     * @return $this
     */
    public function setId($Id)
    {
        $this->Id = $Id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param OrderMessageStatus|string $OrderQueueStatus
     * @return $this
     * @throws InvalidEnumException
     */
    public function setOrderQueueStatus($OrderQueueStatus)
    {
        if ( OrderMessageStatus::isValid( $OrderQueueStatus) ) 
            $this->OrderQueueStatus = new OrderMessageStatus( $OrderQueueStatus );
        elseif ( OrderMessageStatus::isValidKey( $OrderQueueStatus) ) 
            $this->OrderQueueStatus = new OrderMessageStatus( constant( "OrderMessageStatus::$OrderQueueStatus" ) );
        else 
            throw new InvalidEnumException();
        return $this;
    }

    /**
     * @return OrderMessageStatus
     */
    public function getOrderQueueStatus()
    {
        return $this->OrderQueueStatus;
    }


}

