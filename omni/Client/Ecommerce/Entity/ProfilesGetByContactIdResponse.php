<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use Ls\Omni\Client\IResponse;

class ProfilesGetByContactIdResponse implements IResponse
{

    /**
     * @property ArrayOfProfile $ProfilesGetByContactIdResult
     */
    protected $ProfilesGetByContactIdResult = null;

    /**
     * @param ArrayOfProfile $ProfilesGetByContactIdResult
     * @return $this
     */
    public function setProfilesGetByContactIdResult($ProfilesGetByContactIdResult)
    {
        $this->ProfilesGetByContactIdResult = $ProfilesGetByContactIdResult;
        return $this;
    }

    /**
     * @return ArrayOfProfile
     */
    public function getProfilesGetByContactIdResult()
    {
        return $this->ProfilesGetByContactIdResult;
    }

    /**
     * @return ArrayOfProfile
     */
    public function getResult()
    {
        return $this->ProfilesGetByContactIdResult;
    }


}

