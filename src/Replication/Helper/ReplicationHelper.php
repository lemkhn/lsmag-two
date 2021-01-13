<?php

namespace Ls\Replication\Helper;

use Exception;
use \Ls\Core\Model\LSR;
use \Ls\Omni\Client\Ecommerce\Entity;
use \Ls\Omni\Client\Ecommerce\Operation;
use \Ls\Omni\Client\ResponseInterface;
use \Ls\Replication\Api\ReplImageLinkRepositoryInterface;
use \Ls\Replication\Api\ReplItemRepositoryInterface as ReplItemRepository;
use \Ls\Replication\Logger\Logger;
use \Ls\Replication\Model\ReplImageLinkSearchResults;
use Magento\Eav\Model\Config;
use Magento\Eav\Model\Entity\Attribute\Set;
use Magento\Framework\Api\AbstractExtensibleObject;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Store\Model\Website\Interceptor;
use Symfony\Component\Filesystem\Filesystem as FileSystemDirectory;

/**
 * Useful helper functions for replication
 *
 */
class ReplicationHelper extends AbstractHelper
{
    /**
     * @var array
     */
    public $defaultMimeTypes = [
        'image/jpg',
        'image/jpeg',
        'image/gif',
        'image/png',
    ];

    /**
     * @var array
     */
    public $allowedUrlTypes = [
        'category',
        'product'
    ];
    /** @var StoreManagerInterface */
    public $storeManager;

    /** @var Filesystem */
    public $filesystem;

    /** @var SearchCriteriaBuilder */
    public $searchCriteriaBuilder;

    /** @var FilterBuilder */
    public $filterBuilder;

    /** @var FilterGroupBuilder */
    public $filterGroupBuilder;

    /** @var ReplImageLinkRepositoryInterface */
    public $replImageLinkRepositoryInterface;

    /** @var Config */
    public $eavConfig;

    /** @var WriterInterface */
    public $configWriter;

    /** @var Set */
    public $attributeSet;

    /** @var TypeListInterface */
    public $cacheTypeList;

    /** @var LSR */
    public $lsr;

    /** @var ResourceConnection */
    public $resource;

    /** @var SortOrder */
    public $sortOrder;

    /** @var DateTime */
    public $dateTime;

    /** @var TimezoneInterface */
    public $timezone;

    /** @var Logger */
    public $_logger;

    /**
     * @var ReplItemRepository
     */
    public $itemRepository;

    /**
     * @var FileSystemDirectory
     */
    public $fileSystemDirectory;

    /**
     * ReplicationHelper constructor.
     * @param Context $context
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterBuilder $filterBuilder
     * @param FilterGroupBuilder $filterGroupBuilder
     * @param ReplImageLinkRepositoryInterface $replImageLinkRepositoryInterface
     * @param StoreManagerInterface $storeManager
     * @param Filesystem $Filesystem
     * @param Config $eavConfig
     * @param WriterInterface $configWriter
     * @param Set $attributeSet
     * @param TypeListInterface $cacheTypeList
     * @param LSR $LSR
     * @param ResourceConnection $resource
     * @param SortOrder $sortOrder
     * @param DateTime $date
     * @param TimezoneInterface $timezone
     * @param Logger $_logger
     * @param ReplItemRepository $itemRepository
     * @param FileSystemDirectory $fileSystemDirectory
     */
    public function __construct(
        Context $context,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        FilterGroupBuilder $filterGroupBuilder,
        ReplImageLinkRepositoryInterface $replImageLinkRepositoryInterface,
        StoreManagerInterface $storeManager,
        Filesystem $Filesystem,
        Config $eavConfig,
        WriterInterface $configWriter,
        Set $attributeSet,
        TypeListInterface $cacheTypeList,
        LSR $LSR,
        ResourceConnection $resource,
        SortOrder $sortOrder,
        DateTime $date,
        TimezoneInterface $timezone,
        Logger $_logger,
        ReplItemRepository $itemRepository,
        FileSystemDirectory $fileSystemDirectory
    ) {
        $this->searchCriteriaBuilder            = $searchCriteriaBuilder;
        $this->filterBuilder                    = $filterBuilder;
        $this->filterGroupBuilder               = $filterGroupBuilder;
        $this->storeManager                     = $storeManager;
        $this->filesystem                       = $Filesystem;
        $this->replImageLinkRepositoryInterface = $replImageLinkRepositoryInterface;
        $this->eavConfig                        = $eavConfig;
        $this->configWriter                     = $configWriter;
        $this->attributeSet                     = $attributeSet;
        $this->cacheTypeList                    = $cacheTypeList;
        $this->lsr                              = $LSR;
        $this->resource                         = $resource;
        $this->sortOrder                        = $sortOrder;
        $this->dateTime                         = $date;
        $this->timezone                         = $timezone;
        $this->_logger                          = $_logger;
        $this->itemRepository                   = $itemRepository;
        $this->fileSystemDirectory              = $fileSystemDirectory;
        parent::__construct(
            $context
        );
    }

    /**
     * @param string $filtername
     * @param string $filtervalue
     * @param string $conditionType
     * @param int $pagesize
     * @param bool $excludeDeleted
     * @return SearchCriteria
     */
    public function buildCriteriaForNewItems(
        $filtername = '',
        $filtervalue = '',
        $conditionType = 'eq',
        $pagesize = 100,
        $excludeDeleted = true
    ) {
        // creating search criteria for two fields
        // processed = 0 which means not yet processed
        $attr_processed = $this->filterBuilder->setField('processed')
            ->setValue('0')
            ->setConditionType('eq')
            ->create();
        // is_updated = 1 which means may be processed already but is updated on omni end
        $attr_is_updated = $this->filterBuilder->setField('is_updated')
            ->setValue('1')
            ->setConditionType('eq')
            ->create();
        // building OR condition between the above two criteria
        $filterOr = $this->filterGroupBuilder
            ->addFilter($attr_processed)
            ->addFilter($attr_is_updated)
            ->create();
        // adding criteria into where clause.
        $criteria = $this->searchCriteriaBuilder->setFilterGroups([$filterOr]);
        if ($filtername != '' && $filtervalue != '') {
            $criteria->addFilter(
                $filtername,
                $filtervalue,
                $conditionType
            );
        }
        if ($excludeDeleted) {
            $criteria->addFilter('IsDeleted', 0, 'eq');
        }
        if ($pagesize != -1) {
            $criteria->setPageSize($pagesize);
        }
        return $criteria->create();
    }

    /**
     * @param string $item_id
     * @param int $pagesize
     * @param bool $excludeDeleted
     * @return SearchCriteria
     */
    public function buildCriteriaForProductAttributes(
        $item_id = '',
        $pagesize = 100,
        $excludeDeleted = true,
        $scope_id = false
    ) {
        $attr_processed = $this->filterBuilder->setField('processed')
            ->setValue('0')
            ->setConditionType('eq')
            ->create();
        // is_updated = 1 which means may be processed already but is updated on omni end
        $attr_is_updated = $this->filterBuilder->setField('is_updated')
            ->setValue('1')
            ->setConditionType('eq')
            ->create();
        // building OR condition between the above two criteria
        $filterOr = $this->filterGroupBuilder
            ->addFilter($attr_processed)
            ->addFilter($attr_is_updated)
            ->create();
        // adding criteria into where clause.
        $criteria = $this->searchCriteriaBuilder->setFilterGroups([$filterOr]);
        if ($scope_id) {
            $criteria->addFilter('scope_id', $scope_id, 'eq');
        }
        $criteria->addFilter('LinkType', 0, 'eq');
        $criteria->addFilter('LinkField1', $item_id, 'eq');

        if ($excludeDeleted) {
            $criteria->addFilter('IsDeleted', 0, 'eq');
        }
        if ($pagesize != -1) {
            $criteria->setPageSize($pagesize);
        }
        return $criteria->create();
    }

    /**
     * Create Build Criteria with Array of filters as a parameters
     * @param array $filters
     * @param int $pagesize
     * @param boolean $excludeDeleted
     * @return SearchCriteria
     */
    public function buildCriteriaForArray(
        array $filters,
        $pagesize = 100,
        $excludeDeleted = true,
        $parameter = null,
        $parameter2 = null
    ) {
        $filterOr       = null;
        $attr_processed = $this->filterBuilder->setField('processed')
            ->setValue('0')
            ->setConditionType('eq')
            ->create();
        // is_updated = 1 which means may be processed already but is updated on omni end
        $attr_is_updated = $this->filterBuilder->setField('is_updated')
            ->setValue('1')
            ->setConditionType('eq')
            ->create();

        if (!empty($parameter) && !empty($parameter2)) {
            $parameter1 = $this->filterBuilder->setField($parameter['field'])
                ->setValue($parameter['value'])
                ->setConditionType($parameter['condition_type'])
                ->create();

            $parameter2 = $this->filterBuilder->setField($parameter2['field'])
                ->setValue($parameter2['value'])
                ->setConditionType($parameter2['condition_type'])
                ->create();

            // building OR condition between the above  criteria
            $filterOr = $this->filterGroupBuilder
                ->addFilter($attr_processed)
                ->addFilter($attr_is_updated)
                ->addFilter($parameter1)
                ->addFilter($parameter2)
                ->create();
        } else {
            if (!empty($parameter)) {
                $ExtraFieldwithOrCondition = $this->filterBuilder->setField($parameter['field'])
                    ->setValue($parameter['value'])
                    ->setConditionType($parameter['condition_type'])
                    ->create();

                // building OR condition between the above  criteria
                $filterOr = $this->filterGroupBuilder
                    ->addFilter($attr_processed)
                    ->addFilter($attr_is_updated)
                    ->addFilter($ExtraFieldwithOrCondition)
                    ->create();
            } else {
                // building OR condition between the above two criteria
                $filterOr = $this->filterGroupBuilder
                    ->addFilter($attr_processed)
                    ->addFilter($attr_is_updated)
                    ->create();
            }
        }
        $criteria = $this->searchCriteriaBuilder->setFilterGroups([$filterOr]);
        if (!empty($filters)) {
            foreach ($filters as $filter) {
                $criteria->addFilter($filter['field'], $filter['value'], $filter['condition_type']);
            }
        }
        if ($excludeDeleted) {
            $criteria->addFilter('IsDeleted', 0, 'eq');
        }
        if ($pagesize != -1) {
            $criteria->setPageSize($pagesize);
        }
        return $criteria->create();
    }

    /**
     * @param array $filters
     * @param int $pageSize
     * @param bool $excludeDeleted
     * @param null $parameter
     * @return SearchCriteria
     */
    public function buildCriteriaForArrayFrontEnd(
        array $filters,
        $pageSize = 100,
        $excludeDeleted = true,
        $parameter = null
    ) {
        $filterOr      = null;
        $attrProcessed = $this->filterBuilder->setField('processed')
            ->setValue('1')
            ->setConditionType('eq')
            ->create();
        if (!empty($parameter)) {
            $extraFieldWithOrCondition = $this->filterBuilder->setField($parameter['field'])
                ->setValue($parameter['value'])
                ->setConditionType($parameter['condition_type'])
                ->create();
            // building OR condition between the above  criteria
            $filterOr = $this->filterGroupBuilder
                ->addFilter($attrProcessed)
                ->addFilter($extraFieldWithOrCondition)
                ->create();
        } else {
            $filterOr = $this->filterGroupBuilder
                ->addFilter($attrProcessed)
                ->create();
        }
        $criteria = $this->searchCriteriaBuilder->setFilterGroups([$filterOr]);
        if (!empty($filters)) {
            foreach ($filters as $filter) {
                $criteria->addFilter($filter['field'], $filter['value'], $filter['condition_type']);
            }
        }
        if ($excludeDeleted) {
            $criteria->addFilter('IsDeleted', 0, 'eq');
        }
        if ($pageSize != -1) {
            $criteria->setPageSize($pageSize);
        }
        return $criteria->create();
    }

    /**
     * Create Build Criteria with Array of filters as a parameters
     * @param array $filters
     * @param int $pagesize
     * @param boolean $excludeDeleted
     * @param null $parameter
     * @param null $parameter2
     * @return SearchCriteria
     */
    public function buildCriteriaForDirect(
        array $filters,
        $pagesize = 100,
        $excludeDeleted = true,
        $parameter = null,
        $parameter2 = null
    ) {
        $filterOr = null;
        if (!empty($parameter) && !empty($parameter2)) {
            $parameter1 = $this->filterBuilder->setField($parameter['field'])
                ->setValue($parameter['value'])
                ->setConditionType($parameter['condition_type'])
                ->create();

            $parameter2 = $this->filterBuilder->setField($parameter2['field'])
                ->setValue($parameter2['value'])
                ->setConditionType($parameter2['condition_type'])
                ->create();

            // building OR condition between the above  criteria
            $filterOr = $this->filterGroupBuilder
                ->addFilter($parameter1)
                ->addFilter($parameter2)
                ->create();
        } else {
            if (!empty($parameter)) {
                $ExtraFieldwithOrCondition = $this->filterBuilder->setField($parameter['field'])
                    ->setValue($parameter['value'])
                    ->setConditionType($parameter['condition_type'])
                    ->create();

                // building OR condition between the above  criteria
                $filterOr = $this->filterGroupBuilder
                    ->addFilter($ExtraFieldwithOrCondition)
                    ->create();
            }
        }

        if (!empty($filterOr)) {
            $criteria = $this->searchCriteriaBuilder->setFilterGroups([$filterOr]);
        } else {
            $criteria = $this->searchCriteriaBuilder->setFilterGroups([]);
        }
        if (!empty($filters)) {
            foreach ($filters as $filter) {
                $criteria->addFilter($filter['field'], $filter['value'], $filter['condition_type']);
            }
        }
        if ($excludeDeleted) {
            $criteria->addFilter('main_table.IsDeleted', 0, 'eq');
        }
        if ($pagesize != -1) {
            $criteria->setPageSize($pagesize);
        }
        return $criteria->create();
    }

    /**
     * Create Build Criteria with Array of filters as a parameters and return Updated Only
     * @param array $filters
     * @param int $pagesize
     * @return SearchCriteria
     */
    public function buildCriteriaGetUpdatedOnly(array $filters, $pagesize = 100, $excludeDeleted = true)
    {
        $criteria = $this->searchCriteriaBuilder;
        if (!empty($filters)) {
            foreach ($filters as $filter) {
                $criteria->addFilter($filter['field'], $filter['value'], $filter['condition_type']);
            }
        }
        if ($excludeDeleted) {
            $criteria->addFilter('main_table.IsDeleted', 0, 'eq');
        }
        $criteria->addFilter('main_table.is_updated', 1, 'eq');
        if ($pagesize != -1) {
            $criteria->setPageSize($pagesize);
        }
        return $criteria->create();
    }

    /**
     * Create Build Criteria with Array of filters as a parameters and return Updated Only
     * @param array $filters
     * @param int $pagesize
     * @return SearchCriteria
     */
    public function buildCriteriaGetDeletedOnly(array $filters, $pagesize = 100)
    {
        $criteria = $this->searchCriteriaBuilder;
        if (!empty($filters)) {
            foreach ($filters as $filter) {
                $criteria->addFilter($filter['field'], $filter['value'], $filter['condition_type']);
            }
        }
        $criteria->addFilter('IsDeleted', 1, 'eq');
        $criteria->addFilter('is_updated', 1, 'eq');
        if ($pagesize != -1) {
            $criteria->setPageSize($pagesize);
        }
        return $criteria->create();
    }

    /**
     * Create Build Criteria with Array of filters as a parameters and return Updated Only
     * @param array $filters
     * @param int $pagesize
     * @return SearchCriteria
     */
    public function buildCriteriaGetDeletedOnlyWithAlias(array $filters, $pagesize = 100)
    {
        $criteria = $this->searchCriteriaBuilder;
        if (!empty($filters)) {
            foreach ($filters as $filter) {
                $criteria->addFilter($filter['field'], $filter['value'], $filter['condition_type']);
            }
        }
        $criteria->addFilter('main_table.IsDeleted', 1, 'eq');
        $criteria->addFilter('main_table.is_updated', 1, 'eq');
        if ($pagesize != -1) {
            $criteria->setPageSize($pagesize);
        }
        return $criteria->create();
    }

    /**
     * Create Build Exit Criteria with Array of filters as a parameters
     * @param array $filters
     * @param int $pagesize
     * @return SearchCriteria
     */
    public function buildExitCriteriaForArray(array $filters, $pagesize = 1)
    {
        $searchCriteria = $this->searchCriteriaBuilder;
        if (!empty($filters)) {
            foreach ($filters as $filter) {
                $searchCriteria->addFilter($filter['field'], $filter['value'], $filter['condition_type']);
            }
        }

        if ($pagesize != -1) {
            $searchCriteria->setPageSize($pagesize);
        }
        return $searchCriteria->create();
    }

    /**
     * Create Build Criteria with Array of filters as a parameters
     * @param array $filters
     * @param int $pagesize
     * @param boolean $excludeDeleted
     * @return SearchCriteria
     */
    public function buildCriteriaForArrayWithAlias(array $filters, $pagesize = 100, $excludeDeleted = true)
    {
        $attr_processed = $this->filterBuilder->setField('main_table.processed')
            ->setValue('0')
            ->setConditionType('eq')
            ->create();
        // is_updated = 1 which means may be processed already but is updated on omni end
        $attr_is_updated = $this->filterBuilder->setField('main_table.is_updated')
            ->setValue('1')
            ->setConditionType('eq')
            ->create();
        // building OR condition between the above two criteria
        $filterOr = $this->filterGroupBuilder
            ->addFilter($attr_processed)
            ->addFilter($attr_is_updated)
            ->create();
        // adding criteria into where clause.
        $criteria = $this->searchCriteriaBuilder->setFilterGroups([$filterOr]);
        if (!empty($filters)) {
            foreach ($filters as $filter) {
                $criteria->addFilter($filter['field'], $filter['value'], $filter['condition_type']);
            }
        }
        if ($excludeDeleted) {
            $criteria->addFilter('main_table.IsDeleted', 0, 'eq');
        }

        if ($pagesize != -1) {
            $criteria->setPageSize($pagesize);
        }
        return $criteria->create();
    }

    /**
     * @param string $nav_id
     * @param string $type
     * @param int $includeDeleted
     * @param bool $store_id
     * @return bool|AbstractExtensibleObject[]
     * @throws InputException
     */
    public function getImageLinksByType($nav_id = '', $type = 'Item Category', $includeDeleted = 0, $store_id = false)
    {
        if (empty($nav_id)) {
            return false;
        }
        $criteria = $this->searchCriteriaBuilder->addFilter(
            'KeyValue',
            $nav_id,
            'eq'
        )->addFilter(
            'TableName',
            $type,
            'eq'
        )->addFilter(
            'IsDeleted',
            $includeDeleted,
            'eq'
        );

        if ($store_id) {
            $criteria->addFilter('scope_id', $store_id, 'eq');
        }
        $sortOrder = $this->sortOrder->setField('DisplayOrder')->setDirection(SortOrder::SORT_ASC);
        $criteria->setSortOrders([$sortOrder]);
        /** @var ReplImageLinkSearchResults $items */
        $items = $this->replImageLinkRepositoryInterface->getList($criteria->create());
        if ($items->getTotalCount() > 0) {
            return $items->getItems();
        }
        return false;
    }

    /**
     * @param string $image_id
     * @return Entity\ImageStreamGetByIdResponse|ResponseInterface|null|string
     */
    public function imageStreamById($image_id = '')
    {
        $response = null;
        if ($image_id == '' || $image_id == null) {
            return $response;
        }
        // @codingStandardsIgnoreStart
        $request = new Operation\ImageStreamGetById();
        $entity  = new Entity\ImageStreamGetById();
        // @codingStandardsIgnoreEnd
        $entity->setId($image_id);
        try {
            $response = $request->execute($entity);
        } catch (Exception $e) {
            $this->_logger->error($e->getMessage());
        }
        return $response ? $response->getResult() : $response;
    }

    /**
     * @return null|string
     * @throws LocalizedException
     */
    public function getDefaultAttributeSetId()
    {
        return $this->eavConfig->getEntityType('catalog_product')
            ->getDefaultAttributeSetId();
    }

    /**
     * @param string $attributeSet
     * @return int|null
     */
    public function getDefaultGroupIdOfAttributeSet($attributeSet = '')
    {
        if ($attributeSet == '') {
            $attributeSet = 4;
        }
        return $this->attributeSet->getDefaultGroupId($attributeSet);
    }

    /**
     * Format the Nav attribute code according to Magento without space and lowercase
     * @param $code
     * @return mixed|string
     */
    public function formatAttributeCode($code)
    {
        $code = strtolower(trim($code));
        $code = str_replace(' ', '_', $code);
        // convert all special characters and replace it with _
        $code = preg_replace('/[^a-zA-Z0-9_.]/', '_', $code);
        return 'ls_' . $code;
    }

    /**
     * Format the Item Modifier and Recipe
     * @param $code
     * @return mixed|string
     */
    public function formatMidifier($code)
    {
        $code = strtolower(trim($code));
        $code = str_replace(' ', '_', $code);
        // convert all special characters and replace it with _
        $code = preg_replace('/[^a-zA-Z0-9_.]/', '_', $code);
        return $code;
    }

    /**
     * @return array
     */
    public function getAllWebsitesIds()
    {
        $websiteIds = [];
        $websites   = $this->storeManager->getWebsites();
        /** @var Interceptor $website */
        foreach ($websites as $website) {
            $websiteIds[] = $website->getId();
        }
        return $websiteIds;
    }

    /**
     * Clear the cache by type code
     * @param $typeCode
     */
    public function flushByTypeCode($typeCode)
    {
        $this->cacheTypeList->cleanType($typeCode);
        $this->_logger->debug($typeCode . ' cache type flushed.');
    }

    /**
     * Update the config status and clean cache for config
     * @param $data
     * @param $path
     * @param bool $storeId
     */
    public function updateCronStatus($data, $path, $storeId = false)
    {
        /**
         * Added the condition to update config value based on specific store id.
         */
        if ($storeId) {
            $this->configWriter->save(
                $path,
                ($data) ? 1 : 0,
                ScopeInterface::SCOPE_STORES,
                $storeId
            );
        } else {
            $this->configWriter->save(
                $path,
                ($data) ? 1 : 0,
                ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
                0
            );
        }
        $this->flushByTypeCode('config');
    }

    /**
     * USE THIS WHEN YOU WANT TO RESET STATUS FOR ALL THE STORES WITHOUT PASSING ANY STORE ID
     * @param $data
     * @param $path
     */
    public function updateCronStatusForAllStores($data, $path)
    {
        $stores = $this->lsr->getAllStores();
        if (!empty($stores)) {
            foreach ($stores as $store) {
                $this->configWriter->save(
                    $path,
                    ($data) ? 1 : 0,
                    ScopeInterface::SCOPE_STORES,
                    $store->getId()
                );
            }
            $this->flushByTypeCode('config');
        }
    }

    /**
     * Update the config value
     * @param $value
     * @param $path
     * @param bool $storeId
     */
    public function updateConfigValue($value, $path, $storeId = false)
    {

        /**
         * Added the condition to update config value based on specific store id.
         */
        if ($storeId) {
            $this->configWriter->save(
                $path,
                $value,
                ScopeInterface::SCOPE_STORES,
                $storeId
            );
        } else {
            $this->configWriter->save(
                $path,
                $value,
                ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
                0
            );
        }
    }

    /**
     * @return Logger
     */
    public function getLogger()
    {
        return $this->_logger;
    }

    /**
     * This websiteId is the id of scope website in the Magento system.
     * and webStore is the LS Central store id stored in the core_config_data
     * Trigger the disposable Hierarchy replication job to get Hierarchy based on stores.
     * @param string $websiteId
     * @return array|Entity\ReplEcommHierarchyResponse|Entity\ReplHierarchyResponse|ResponseInterface
     */
    public function getHierarchyByStore($websiteId = '')
    {
        $response = [];

        $webStore = $this->lsr->getWebsiteConfig(LSR::SC_SERVICE_STORE, $websiteId);
        $base_url = $this->lsr->getWebsiteConfig(LSR::SC_SERVICE_BASE_URL, $websiteId);
        // @codingStandardsIgnoreStart
        $hierarchy = new Entity\ReplEcommHierarchy();

        $request   = new Entity\ReplRequest();
        $operation = new Operation\ReplEcommHierarchy($base_url);
        // @codingStandardsIgnoreEnd

        $request->setStoreId($webStore)
            ->setBatchSize(100)
            ->setFullReplication(true)
            ->setLastKey(0)
            ->setMaxKey(0)
            ->setTerminalId('');

        $this->_logger->debug(var_export($operation->getResponse(), true));

        try {
            $response = $operation->execute($hierarchy->setReplRequest($request));
        } catch (Exception $e) {
            $this->_logger->error($e->getMessage());
        }
        return $response ? $response->getResult() : $response;
    }

    /**
     * @param $collection
     * @param SearchCriteriaInterface $criteria
     * @param $primaryTableColumnName
     * @param $secondaryTableName
     * @param $secondaryTableColumnName
     * @param bool $group
     * @param bool $isReplaceJoin
     * @param bool $isCatJoin
     * @param null $websiteId
     */
    public function setCollectionPropertiesPlusJoin(
        &$collection,
        SearchCriteriaInterface $criteria,
        $primaryTableColumnName,
        $secondaryTableName,
        $secondaryTableColumnName,
        $group = false,
        $isReplaceJoin = false,
        $isCatJoin = false,
        $websiteId = null
    ) {
        $this->setFiltersOnTheBasisOfCriteria($collection, $criteria);
        $this->setSortOrdersOnTheBasisOfCriteria($collection, $criteria);
        $second_table_name = $this->resource->getTableName($secondaryTableName);
        // @codingStandardsIgnoreStart
        // In order to only select those records whose items are available
        if ($isReplaceJoin) {
            $collection->getSelect()->joinInner(
                ['second' => $second_table_name],
                'main_table.' . $primaryTableColumnName . ' = REPLACE(second.' . $secondaryTableColumnName . ',"-",",")',
                []
            );
        } elseif ($isCatJoin) {
            $hierarchyCode = $this->lsr->getStoreConfig(LSR::SC_REPLICATION_HIERARCHY_CODE, $websiteId);
            $hierarchyCode = $hierarchyCode . ';';
            $collection->getSelect()->joinInner(
                ['second' => $second_table_name],
                'REPLACE(main_table.' . $primaryTableColumnName . ',"' . $hierarchyCode . '","")= second.' . $secondaryTableColumnName,
                []
            );
            $collection->getSelect()->columns('second.' . $secondaryTableColumnName);
        } else {
            $collection->getSelect()->joinInner(
                ['second' => $second_table_name],
                'main_table.' . $primaryTableColumnName . ' = second.' . $secondaryTableColumnName,
                []
            );
        }
        if ($group) {
            $collection->getSelect()->group('main_table.' . $primaryTableColumnName);
        }
        /** @var For Xdebug only to check the query $query */
        $query = $collection->getSelect()->__toString();
        // @codingStandardsIgnoreEnd
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
    }

    /**
     * @param $collection
     * @param SearchCriteriaInterface $criteria
     * @param $primaryTableColumnName
     * @param $primaryTableColumnName2
     * @param $secondaryTableName
     * @param $secondaryTableColumnName
     * @param bool $isReplaceJoin
     */
    public function setCollectionPropertiesPlusJoinSku(
        &$collection,
        SearchCriteriaInterface $criteria,
        $primaryTableColumnName,
        $primaryTableColumnName2,
        $secondaryTableName,
        $secondaryTableColumnName,
        $isReplaceJoin = false
    ) {
        $this->setFiltersOnTheBasisOfCriteria($collection, $criteria);
        $this->setSortOrdersOnTheBasisOfCriteria($collection, $criteria);
        $second_table_name = $this->resource->getTableName($secondaryTableName);
        // @codingStandardsIgnoreStart
        // In order to only select those records whose items are available
        if ($isReplaceJoin) {
            $collection->getSelect()->joinInner(
                ['second' => $second_table_name],
                'CONCAT_WS("-",main_table.' . $primaryTableColumnName . ',main_table.' . $primaryTableColumnName2 . ') = second.' . $secondaryTableColumnName,
                []
            );
        } else {
            $collection->getSelect()->joinInner(
                ['second' => $second_table_name],
                'main_table.' . $primaryTableColumnName . ' = second.' . $secondaryTableColumnName,
                []
            );
        }
        /** @var For Xdebug only to check the query $query */
        //$query = $collection->getSelect()->__toString();
        // @codingStandardsIgnoreEnd
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
    }

    /**
     * @param $collection
     * @param SearchCriteriaInterface $criteria
     */
    public function setCollectionPropertiesPlusJoinsForInventory(&$collection, SearchCriteriaInterface $criteria)
    {
        $secondTableName = $this->resource->getTableName('catalog_product_entity');
        $thirdTableName  = $this->resource->getTableName('ls_replication_repl_item');
        $this->setFiltersOnTheBasisOfCriteria($collection, $criteria);
        $this->setSortOrdersOnTheBasisOfCriteria($collection, $criteria);
        $collection->getSelect()->joinInner(
            ['second' => $secondTableName],
            'CONCAT_WS("-",main_table.ItemId' . ',main_table.VariantId' . ') = second.sku',
            []
        )->joinInner(
            ['third' => $thirdTableName],
            'main_table.ItemId' . ' = third.nav_id' . ' AND main_table.scope_id' . ' = third.scope_id',
            []
        );
        /** @var For Xdebug only to check the query $query */
        $query = $collection->getSelect()->__toString();
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
    }

    /**
     * @param $collection
     * @param SearchCriteriaInterface $criteria
     */
    public function setCollectionPropertiesPlusJoinsForVendor(&$collection, SearchCriteriaInterface $criteria)
    {
        $secondTableName = $this->resource->getTableName('catalog_product_entity');
        $thirdTableName  = $this->resource->getTableName('ls_replication_repl_vendor');
        $this->setFiltersOnTheBasisOfCriteria($collection, $criteria);
        $this->setSortOrdersOnTheBasisOfCriteria($collection, $criteria);
        $collection->getSelect()->joinInner(
            ['second' => $secondTableName],
            'main_table.NavProductId' . '= second.sku',
            []
        )->joinInner(
            ['third' => $thirdTableName],
            'main_table.NavManufacturerId' . ' = third.nav_id' . ' AND main_table.scope_id' . ' = third.scope_id' .
            ' AND third.processed' . ' = 1',
            []
        );
        $collection->getSelect()->columns('third.name');
        /** @var For Xdebug only to check the query $query */
        $query = $collection->getSelect()->__toString();
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
    }

    /**
     * @param $collection
     * @param SearchCriteriaInterface $criteria
     */
    public function setCollectionPropertiesPlusJoinsForImages(&$collection, SearchCriteriaInterface $criteria)
    {
        $secondTableName = $this->resource->getTableName('catalog_product_entity');
        $thirdTableName  = $this->resource->getTableName('ls_replication_repl_item');
        $this->setFiltersOnTheBasisOfCriteria($collection, $criteria);
        $this->setSortOrdersOnTheBasisOfCriteria($collection, $criteria);
        $collection->getSelect()->joinInner(
            ['second' => $secondTableName],
            'main_table.KeyValue = REPLACE(second.sku,"-",",")',
            []
        )->joinInner(
            ['third' => $thirdTableName],
            'third.nav_id' . ' = SUBSTRING_INDEX(main_table.KeyValue,",",1)' . '
            AND main_table.scope_id' . ' = third.scope_id',
            []
        );
        /** @var For Xdebug only to check the query $query */
        $query = $collection->getSelect()->__toString();
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
    }

    /**
     * @param $collection
     * @param SearchCriteriaInterface $criteria
     */
    public function setFiltersOnTheBasisOfCriteria(&$collection, SearchCriteriaInterface $criteria)
    {
        foreach ($criteria->getFilterGroups() as $filter_group) {
            $fields = $conditions = [];
            foreach ($filter_group->getFilters() as $filter) {
                $condition    = $filter->getConditionType() ?: 'eq';
                $fields[]     = $filter->getField();
                $conditions[] = [$condition => $filter->getValue()];
            }
            if ($fields) {
                $collection->addFieldToFilter($fields, $conditions);
            }
        }
    }

    /**
     * @param $collection
     * @param SearchCriteriaInterface $criteria
     */
    public function setSortOrdersOnTheBasisOfCriteria(&$collection, SearchCriteriaInterface $criteria)
    {
        $sort_orders = $criteria->getSortOrders();
        if ($sort_orders) {
            /** @var SortOrder $sort_order */
            foreach ($sort_orders as $sort_order) {
                $collection->addOrder(
                    $sort_order->getField(),
                    ($sort_order->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
    }

    /**
     * @param $collection
     * @param SearchCriteriaInterface $criteria
     * @param $resultFactory
     * @param null $fieldToSelect
     * @return mixed
     */
    public function setCollection(
        $collection,
        SearchCriteriaInterface $criteria,
        $resultFactory,
        $fieldToSort = null
    ) {
        foreach ($criteria->getFilterGroups() as $filter_group) {
            $fields = $conditions = [];
            foreach ($filter_group->getFilters() as $filter) {
                $condition    = $filter->getConditionType() ?: 'eq';
                $fields[]     = $filter->getField();
                $conditions[] = [$condition => $filter->getValue()];
            }
            if ($fields) {
                $collection->addFieldToFilter($fields, $conditions);
            }
        }
        if ($fieldToSort) {
            $collection->getSelect()->order('main_table.' . $fieldToSort);
            $collection->getSelect()->order('main_table.QtyPrUom');
        }

        // @codingStandardsIgnoreEnd
        $collection->getSelect()->limit($criteria->getPageSize());

        /** @var For Xdebug only to check the query $query */
        //$query = $collection->getSelect()->__toString();

        $objects = [];
        foreach ($collection as $object_model) {
            $objects[] = $object_model;
        }
        $resultFactory->setItems($objects);
        $resultFactory->setItems($objects);

        return $resultFactory->getItems();
    }

    /**
     * To be used only for Processing attributes and variants in the AttributeCreate Task
     * @return string
     */
    public function getProductAttributeBatchSize()
    {
        return $this->lsr->getStoreConfig(LSR::SC_REPLICATION_PRODUCT_ATTRIBUTE_BATCH_SIZE);
    }

    /**
     * @return string
     */
    public function getDiscountsBatchSize()
    {
        return $this->lsr->getStoreConfig(LSR::SC_REPLICATION_DISCOUNT_BATCH_SIZE);
    }

    /**
     * @return string
     */
    public function getProductInventoryBatchSize()
    {
        return $this->lsr->getStoreConfig(LSR::SC_REPLICATION_PRODUCT_INVENTORY_BATCH_SIZE);
    }

    /**
     * @return string
     */
    public function getProductPricesBatchSize()
    {
        return $this->lsr->getStoreConfig(LSR::SC_REPLICATION_PRODUCT_PRICES_BATCH_SIZE);
    }

    /**
     * @return string
     */
    public function getProductImagesBatchSize()
    {
        return $this->lsr->getStoreConfig(LSR::SC_REPLICATION_PRODUCT_IMAGES_BATCH_SIZE);
    }

    /**
     * @return string
     */
    public function getItemModifiersBatchSize()
    {
        return $this->lsr->getStoreConfig(LSR::SC_REPLICATION_ITEM_MODIFIER_BATCH_SIZE);
    }

    /**
     * @return string
     */
    public function getItemRecipeBatchSize()
    {
        return $this->lsr->getStoreConfig(LSR::SC_REPLICATION_ITEM_RECIPE_BATCH_SIZE);
    }

    /**
     * @return string
     */
    public function getProductBarcodeBatchSize()
    {
        return $this->lsr->getStoreConfig(LSR::SC_REPLICATION_PRODUCT_BARCODE_BATCH_SIZE);
    }

    /**
     * To be used only for creating variants based products.
     * @return string
     */
    public function getVariantBatchSize()
    {
        return $this->lsr->getStoreConfig(LSR::SC_REPLICATION_VARIANT_BATCH_SIZE);
    }

    /**
     * @return string
     */
    public function getProductCategoryAssignmentBatchSize()
    {
        return $this->lsr->getStoreConfig(LSR::SC_REPLICATION_PRODUCT_ASSIGNMENT_TO_CATEGORY_BATCH_SIZE);
    }

    /**
     * @return string
     */
    public function getMediaPathtoStore()
    {
        return $this->filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath();
    }

    /**
     * @param $mediaDirectory
     */
    public function removeDirectory($mediaDirectory)
    {
        if ($this->fileSystemDirectory->exists($mediaDirectory)) {
            $this->fileSystemDirectory->remove($mediaDirectory);
        }
    }

    /**
     * Check if given mime type is valid
     *
     * @param string $mimeType
     * @return bool
     */
    public function isMimeTypeValid($mimeType)
    {
        return in_array($mimeType, $this->defaultMimeTypes);
    }

    /** return SortOrder object based on the parameters provided
     * @param $field
     * @param string $direction
     * @return SortOrder
     * @throws InputException
     */
    public function getSortOrderObject($field = 'DisplayOrder', $direction = SortOrder::SORT_ASC)
    {
        return $this->sortOrder->setField($field)->setDirection($direction);
    }

    /**
     * @param string $imageName
     * @return mixed
     */
    public function parseImageIdfromFile($imageName = '')
    {
        $imageName = pathinfo($imageName);
        return $imageName['filename'];
    }

    /**
     * @return string
     */
    public function getDatetime()
    {
        return $this->dateTime->gmtDate();
    }

    /**
     * @param $dataTime
     * @param null $format
     * @return string
     * @throws Exception
     */
    public function convertDateTimeIntoCurrentTimeZone($dataTime, $format = null)
    {
        $formattedDate = "";
        if (isset($dataTime)
            && $dataTime !== "0000-00-00 00:00:00"
        ) {
            $date = $this->timezone->date(new \DateTime($dataTime));
            if ($format === null) {
                $format = 'Y-m-d H:i:s';
            }
            $formattedDate = $date->format($format);
        }
        return $formattedDate;
    }

    /**
     * To set the environment variables for cron jobs
     */
    public function setEnvVariables()
    {
        $val1 = ini_get('max_execution_time');
        $val2 = ini_get('memory_limit');
        $this->_logger->debug('ENV Variables Values before:' . $val1 . ' ' . $val2);
        // @codingStandardsIgnoreStart
        @ini_set('max_execution_time', 3600);
        @ini_set('memory_limit', -1);
        // @codingStandardsIgnoreEnd
        $val1 = ini_get('max_execution_time');
        $val2 = ini_get('memory_limit');
        $this->_logger->debug('ENV Variables Values after:' . $val1 . ' ' . $val2);
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getCurrentDate()
    {
        $format      = LSR::DATE_FORMAT;
        $currentDate = $this->convertDateTimeIntoCurrentTimeZone(
            $this->getDatetime(),
            $format
        );
        return $currentDate;
    }

    /**
     * @param string $type
     */
    public function resetUrlRewriteByType($type = '')
    {
        if ($type && in_array($type, $this->allowedUrlTypes)) {
            // only process if type is either category|product
            $connection = $this->resource->getConnection(ResourceConnection::DEFAULT_CONNECTION);
            $lsQuery    = "DELETE FROM " . $this->resource->getTableName("url_rewrite") . " WHERE entity_type = '" . $type . "' ";
            try {
                $connection->query($lsQuery);
            } catch (Exception $e) {
                $this->_logger->debug($e->getMessage());
            }
        }
        return;
    }

    /**
     * @return string
     */
    public function getAttributeSetsMechanism()
    {
        return $this->lsr->getStoreConfig(LSR::SC_REPLICATION_ATTRIBUTE_SETS_MECHANISM);
    }

    /**
     * @param $itemId
     * @return mixed
     */
    public function getBaseUnitOfMeasure($itemId)
    {
        $baseUnitOfMeasure = null;
        $filters           = [
            ['field' => 'nav_id', 'value' => $itemId, 'condition_type' => 'eq']
        ];
        $criteria          = $this->buildCriteriaForDirect($filters, 1);
        $items             = $this->itemRepository->getList($criteria)->getItems();
        foreach ($items as $item) {
            return $item->getBaseUnitOfMeasure();
        }

        return $baseUnitOfMeasure;
    }
}
