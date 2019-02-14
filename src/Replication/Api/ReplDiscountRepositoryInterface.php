<?php

namespace Ls\Replication\Api;

use Ls\Replication\Api\Data\ReplDiscountInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */
interface ReplDiscountRepositoryInterface
{

    public function getList(SearchCriteriaInterface $criteria);

    public function save(ReplDiscountInterface $page);

    public function delete(ReplDiscountInterface $page);

    public function getById($id);

    public function deleteById($id);


}

