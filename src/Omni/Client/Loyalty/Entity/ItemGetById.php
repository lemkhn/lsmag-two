<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use \Ls\Omni\Client\RequestInterface;

class ItemGetById implements RequestInterface
{

    /**
     * @property string $itemId
     */
    protected $itemId = null;

    /**
     * @param string $itemId
     * @return $this
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
        return $this;
    }

    /**
     * @return string
     */
    public function getItemId()
    {
        return $this->itemId;
    }


}

