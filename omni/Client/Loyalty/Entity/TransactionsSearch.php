<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use Ls\Omni\Client\IRequest;

class TransactionsSearch implements IRequest
{

    /**
     * @property string $contactId
     */
    protected $contactId = null;

    /**
     * @property string $itemSearch
     */
    protected $itemSearch = null;

    /**
     * @property int $maxNumberOfTransactions
     */
    protected $maxNumberOfTransactions = null;

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
     * @param string $itemSearch
     * @return $this
     */
    public function setItemSearch($itemSearch)
    {
        $this->itemSearch = $itemSearch;
        return $this;
    }

    /**
     * @return string
     */
    public function getItemSearch()
    {
        return $this->itemSearch;
    }

    /**
     * @param int $maxNumberOfTransactions
     * @return $this
     */
    public function setMaxNumberOfTransactions($maxNumberOfTransactions)
    {
        $this->maxNumberOfTransactions = $maxNumberOfTransactions;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxNumberOfTransactions()
    {
        return $this->maxNumberOfTransactions;
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

