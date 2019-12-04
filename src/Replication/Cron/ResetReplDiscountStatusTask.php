<?php

namespace Ls\Replication\Cron;

use \Ls\Core\Model\LSR;
use \Ls\Replication\Helper\ReplicationHelper;
use \Ls\Replication\Logger\Logger;
use Magento\Framework\App\ResourceConnection;

/**
 * Class ResetReplPriceStatusTask
 * @package Ls\Replication\Cron
 */
class ResetReplDiscountStatusTask
{

    /** @var string */
    const CONFIG_PATH_LAST_EXECUTE = 'ls_mag/replication/last_execute_repl_discount_status_reset';

    /** @var string */
    const DISCOUNT_TABLE_NAME = 'ls_replication_repl_discount';

    /** @var array List of all the Discount tables */
    public $magento_discount_tables = [
        "catalogrule",
        "catalogrule_customer_group",
        "catalogrule_group_website",
        "catalogrule_group_website_replica",
        "catalogrule_product_price",
        "catalogrule_product_price_replica",
        "catalogrule_product",
        "catalogrule_product_replica",
        "catalogrule_website"
    ];

    /** @var ReplicationHelper */
    public $replicationHelper;

    /** @var LSR */
    public $lsr;

    /**
     * @var Logger
     */
    public $logger;

    /**
     * @var ResourceConnection
     */
    public $resource;

    /**
     * ResetReplDiscountStatusTask constructor.
     * @param ReplicationHelper $replicationHelper
     * @param LSR $LSR
     * @param Logger $logger
     * @param ResourceConnection $resource
     */
    public function __construct(
        ReplicationHelper $replicationHelper,
        LSR $LSR,
        Logger $logger,
        ResourceConnection $resource
    ) {
        $this->replicationHelper = $replicationHelper;
        $this->lsr               = $LSR;
        $this->logger            = $logger;
        $this->resource          = $resource;
    }

    /**
     * Reset the Inventory Status
     */
    public function execute()
    {
        if ($this->lsr->isLSR()) {
            $this->logger->debug('Running ResetReplDiscountStatusTask Task ');

            $this->replicationHelper->updateConfigValue(date('d M,Y h:i:s A'), self::CONFIG_PATH_LAST_EXECUTE);

            // Process for Flat tables.
            // truncating the discount table.
            $connection = $this->resource->getConnection(ResourceConnection::DEFAULT_CONNECTION);
            $connection->query('SET FOREIGN_KEY_CHECKS = 0;');
            $tableName = $connection->getTableName(self::DISCOUNT_TABLE_NAME);
            try {
                $connection->truncateTable($tableName);
            } catch (\Exception $e) {
                $this->logger->debug("Something wrong while truncating the discount table");
                $this->logger->debug($e->getMessage());
            }
            // resetting the flag back to false
            $this->replicationHelper->updateCronStatus(false, ReplEcommDiscountsTask::CONFIG_PATH_STATUS);
            $this->replicationHelper->updateCronStatus(false, ReplEcommDiscountsTask::CONFIG_PATH);

            // Process for Magento tables.
            // deleting the catalog rules data
            foreach ($this->magento_discount_tables as $discountTable) {
                $tableName = $connection->getTableName($discountTable);
                try {
                    $connection->truncateTable($tableName);
                } catch (\Exception $e) {
                    $this->logger->debug("Something wrong while deleting the catalog rule");
                    $this->logger->debug($e->getMessage());
                }
            }
            $connection->query('SET FOREIGN_KEY_CHECKS = 1;');
            // reset the status for cron status job
            $this->replicationHelper->updateCronStatus(false, LSR::SC_SUCCESS_CRON_DISCOUNT);
            $this->logger->debug('End ResetReplDiscountStatusTask task');
        }
    }

    /**
     * @return array
     */
    public function executeManually()
    {
        $this->execute();
        return [0];
    }
}
