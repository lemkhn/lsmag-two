<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use Ls\Omni\Client\Ecommerce\Entity\Enum\ListType;
use Ls\Omni\Exception\InvalidEnumException;
use Ls\Omni\Client\IRequest;

class OneListDeleteById implements IRequest
{

    /**
     * @property string $oneListId
     */
    protected $oneListId = null;

    /**
     * @property ListType $listType
     */
    protected $listType = null;

    /**
     * @param string $oneListId
     * @return $this
     */
    public function setOneListId($oneListId)
    {
        $this->oneListId = $oneListId;
        return $this;
    }

    /**
     * @return string
     */
    public function getOneListId()
    {
        return $this->oneListId;
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


}

