<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use Ls\Omni\Client\IRequest;

class NotificationCountGetUnread implements IRequest
{

    /**
     * @property string $contactId
     */
    protected $contactId = null;

    /**
     * @property string $lastChecked
     */
    protected $lastChecked = null;

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
     * @param string $lastChecked
     * @return $this
     */
    public function setLastChecked($lastChecked)
    {
        $this->lastChecked = $lastChecked;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastChecked()
    {
        return $this->lastChecked;
    }


}

