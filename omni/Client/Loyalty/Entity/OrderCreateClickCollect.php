<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use Ls\Omni\Client\IRequest;

class OrderCreateClickCollect implements IRequest
{

    /**
     * @property OrderClickCollect $request
     */
    protected $request = null;

    /**
     * @param OrderClickCollect $request
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return OrderClickCollect
     */
    public function getRequest()
    {
        return $this->request;
    }


}

