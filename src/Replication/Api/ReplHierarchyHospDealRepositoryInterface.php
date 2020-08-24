<?php

namespace Ls\Replication\Api;

use Ls\Replication\Api\Data\ReplHierarchyHospDealInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */
interface ReplHierarchyHospDealRepositoryInterface
{

    public function getList(SearchCriteriaInterface $criteria);

    public function save(ReplHierarchyHospDealInterface $page);

    public function delete(ReplHierarchyHospDealInterface $page);

    public function getById($id);

    public function deleteById($id);


}
