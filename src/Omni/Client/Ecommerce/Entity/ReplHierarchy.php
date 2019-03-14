<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use Ls\Omni\Client\Ecommerce\Entity\Enum\HierarchyType;
use Ls\Omni\Exception\InvalidEnumException;

class ReplHierarchy
{

    /**
     * @property string $Description
     */
    protected $Description = null;

    /**
     * @property string $Id
     */
    protected $Id = null;

    /**
     * @property boolean $IsDeleted
     */
    protected $IsDeleted = null;

    /**
     * @property HierarchyType $Type
     */
    protected $Type = null;

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
     * @param HierarchyType|string $Type
     * @return $this
     * @throws InvalidEnumException
     */
    public function setType($Type)
    {
        if ( ! $Type instanceof HierarchyType ) {
            if ( HierarchyType::isValid( $Type ) ) 
                $Type = new HierarchyType( $Type );
            elseif ( HierarchyType::isValidKey( $Type ) ) 
                $Type = new HierarchyType( constant( "HierarchyType::$Type" ) );
            elseif ( ! $Type instanceof HierarchyType )
                throw new InvalidEnumException();
        }
        $this->Type = $Type->getValue();

        return $this;
    }

    /**
     * @return HierarchyType
     */
    public function getType()
    {
        return $this->Type;
    }


}

