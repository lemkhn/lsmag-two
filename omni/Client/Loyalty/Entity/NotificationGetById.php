<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use Ls\Omni\Client\IRequest;

class NotificationGetById implements IRequest
{

    /**
     * @property string $notificationId
     */
    protected $notificationId = null;

    /**
     * @param string $notificationId
     * @return $this
     */
    public function setNotificationId($notificationId)
    {
        $this->notificationId = $notificationId;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotificationId()
    {
        return $this->notificationId;
    }


}

