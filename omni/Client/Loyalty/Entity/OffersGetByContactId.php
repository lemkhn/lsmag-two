<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use Ls\Omni\Client\IRequest;

class OffersGetByContactId implements IRequest
{

    /**
     * @property string $contactId
     */
    protected $contactId = null;

    /**
     * @property int $numberOfOffers
     */
    protected $numberOfOffers = null;

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
     * @param int $numberOfOffers
     * @return $this
     */
    public function setNumberOfOffers($numberOfOffers)
    {
        $this->numberOfOffers = $numberOfOffers;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumberOfOffers()
    {
        return $this->numberOfOffers;
    }


}

