<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use Ls\Omni\Client\Ecommerce\Entity\Enum\ListType;
use Ls\Omni\Exception\InvalidEnumException;
use Ls\Omni\Client\IRequest;

class OneListGetByContactId implements IRequest
{

    /**
     * @property string $contactId
     */
    protected $contactId = null;

    /**
     * @property ListType $listType
     */
    protected $listType = null;

    /**
     * @property boolean $includeLines
     */
    protected $includeLines = null;

    /**
     * @param string $contactId
     * @return $this
     */
    public function setContactId($contactId)
    {
        $this->contactId = $contactId;
        return $this;
    }

    /**
     * @return string
     */
    public function getContactId()
    {
        return $this->contactId;
    }

    /**
     * @param ListType|string $listType
     * @return $this
     * @throws InvalidEnumException
     */
    public function setListType($listType)
    {
        if ( ListType::isValid( $listType) ) 
            $this->listType = new ListType( $listType );
        elseif ( ListType::isValidKey( $listType) ) 
            $this->listType = new ListType( constant( "ListType::$listType" ) );
        else 
            throw new InvalidEnumException();
        return $this;
    }

    /**
     * @return ListType
     */
    public function getListType()
    {
        return $this->listType;
    }

    /**
     * @param boolean $includeLines
     * @return $this
     */
    public function setIncludeLines($includeLines)
    {
        $this->includeLines = $includeLines;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIncludeLines()
    {
        return $this->includeLines;
    }


}

