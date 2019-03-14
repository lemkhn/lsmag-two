<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Replication\Api\Data;

interface ReplTaxSetupInterface
{

    /**
     * @param string $BusinessTaxGroup
     * @return $this
     */
    public function setBusinessTaxGroup($BusinessTaxGroup);

    /**
     * @return string
     */
    public function getBusinessTaxGroup();

    /**
     * @param boolean $IsDeleted
     * @return $this
     */
    public function setIsDeleted($IsDeleted);

    /**
     * @return boolean
     */
    public function getIsDeleted();

    /**
     * @param string $ProductTaxGroup
     * @return $this
     */
    public function setProductTaxGroup($ProductTaxGroup);

    /**
     * @return string
     */
    public function getProductTaxGroup();

    /**
     * @param float $TaxPercent
     * @return $this
     */
    public function setTaxPercent($TaxPercent);

    /**
     * @return float
     */
    public function getTaxPercent();

    /**
     * @param string $scope
     * @return $this
     */
    public function setScope($scope);

    /**
     * @return string
     */
    public function getScope();

    /**
     * @param int $scope_id
     * @return $this
     */
    public function setScopeId($scope_id);

    /**
     * @return int
     */
    public function getScopeId();

    /**
     * @param string $processed
     * @return $this
     */
    public function setProcessed($processed);

    /**
     * @return string
     */
    public function getProcessed();


}

