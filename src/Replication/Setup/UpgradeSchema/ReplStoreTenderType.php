<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Replication\Setup\UpgradeSchema;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class ReplStoreTenderType
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $table_name = $setup->getTable( 'ls_replication_repl_store_tender_type' ); 
        if(!$setup->tableExists($table_name)) {
        	$table = $setup->getConnection()->newTable( $table_name );
        	$table->addColumn('repl_store_tender_type_id', Table::TYPE_INTEGER, NULL, 
        	                    [ 'identity' => TRUE, 'primary' => TRUE,
        	                      'unsigned' => TRUE, 'nullable' => FALSE, 'auto_increment'=> TRUE ]);
        	$table->addColumn('scope', Table::TYPE_TEXT, 8);
        	$table->addColumn('scope_id', Table::TYPE_INTEGER, 11);
        	$table->addColumn('processed', Table::TYPE_BOOLEAN, null, [ 'default' => 0 ], 'Flag to check if data is already copied into Magento. 0 means needs to be copied into Magento tables & 1 means already copied');
        	$table->addColumn('is_updated', Table::TYPE_BOOLEAN, null, [ 'default' => 0 ], 'Flag to check if data is already updated from Omni into Magento. 0 means already updated & 1 means needs to be updated into Magento tables');
        	$table->addColumn('is_failed', Table::TYPE_BOOLEAN, null, [ 'default' => 0 ], 'Flag to check if data is already added from Flat into Magento successfully or not. 0 means already added successfully & 1 means failed to add successfully into Magento tables');
        	$table->addColumn('AboveMinimumTenderId' , Table::TYPE_TEXT, '');
        	$table->addColumn('AllowOverTender' , Table::TYPE_INTEGER, '');
        	$table->addColumn('AllowUnderTender' , Table::TYPE_INTEGER, '');
        	$table->addColumn('AllowVoiding' , Table::TYPE_INTEGER, '');
        	$table->addColumn('ChangeTenderId' , Table::TYPE_TEXT, '');
        	$table->addColumn('CountingRequired' , Table::TYPE_INTEGER, '');
        	$table->addColumn('ForeignCurrency' , Table::TYPE_INTEGER, '');
        	$table->addColumn('IsDeleted' , Table::TYPE_BOOLEAN, '');
        	$table->addColumn('MaximumOverTenderAmount' , Table::TYPE_FLOAT, '');
        	$table->addColumn('MinimumChangeAmount' , Table::TYPE_FLOAT, '');
        	$table->addColumn('Name' , Table::TYPE_TEXT, '');
        	$table->addColumn('OpenDrawer' , Table::TYPE_INTEGER, '');
        	$table->addColumn('ReturnAllowed' , Table::TYPE_INTEGER, '');
        	$table->addColumn('Rounding' , Table::TYPE_FLOAT, '');
        	$table->addColumn('RoundingMethode' , Table::TYPE_INTEGER, '');
        	$table->addColumn('StoreID' , Table::TYPE_TEXT, '');
        	$table->addColumn('TenderFunction' , Table::TYPE_INTEGER, '');
        	$table->addColumn('TenderTypeId' , Table::TYPE_TEXT, '');
        	$table->addColumn('ValidOnMobilePOS' , Table::TYPE_INTEGER, '');
        	$table->addColumn('created_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT ], 'Created At');
        	$table->addColumn('updated_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE ], 'Updated At');
        	$setup->getConnection()->createTable( $table );
        } else {
        	$connection = $setup->getConnection();
        	if ($connection->tableColumnExists($table_name, 'AboveMinimumTenderId' ) === false) {
        		$connection->addColumn($table_name, 'AboveMinimumTenderId', ['type' => Table::TYPE_TEXT, 'comment' => 'AboveMinimumTenderId']);
        	}
        	if ($connection->tableColumnExists($table_name, 'AllowOverTender' ) === false) {
        		$connection->addColumn($table_name, 'AllowOverTender', ['type' => Table::TYPE_INTEGER, 'comment' => 'AllowOverTender']);
        	}
        	if ($connection->tableColumnExists($table_name, 'AllowUnderTender' ) === false) {
        		$connection->addColumn($table_name, 'AllowUnderTender', ['type' => Table::TYPE_INTEGER, 'comment' => 'AllowUnderTender']);
        	}
        	if ($connection->tableColumnExists($table_name, 'AllowVoiding' ) === false) {
        		$connection->addColumn($table_name, 'AllowVoiding', ['type' => Table::TYPE_INTEGER, 'comment' => 'AllowVoiding']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ChangeTenderId' ) === false) {
        		$connection->addColumn($table_name, 'ChangeTenderId', ['type' => Table::TYPE_TEXT, 'comment' => 'ChangeTenderId']);
        	}
        	if ($connection->tableColumnExists($table_name, 'CountingRequired' ) === false) {
        		$connection->addColumn($table_name, 'CountingRequired', ['type' => Table::TYPE_INTEGER, 'comment' => 'CountingRequired']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ForeignCurrency' ) === false) {
        		$connection->addColumn($table_name, 'ForeignCurrency', ['type' => Table::TYPE_INTEGER, 'comment' => 'ForeignCurrency']);
        	}
        	if ($connection->tableColumnExists($table_name, 'IsDeleted' ) === false) {
        		$connection->addColumn($table_name, 'IsDeleted', ['type' => Table::TYPE_BOOLEAN, 'comment' => 'IsDeleted']);
        	}
        	if ($connection->tableColumnExists($table_name, 'MaximumOverTenderAmount' ) === false) {
        		$connection->addColumn($table_name, 'MaximumOverTenderAmount', ['type' => Table::TYPE_FLOAT, 'comment' => 'MaximumOverTenderAmount']);
        	}
        	if ($connection->tableColumnExists($table_name, 'MinimumChangeAmount' ) === false) {
        		$connection->addColumn($table_name, 'MinimumChangeAmount', ['type' => Table::TYPE_FLOAT, 'comment' => 'MinimumChangeAmount']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Name' ) === false) {
        		$connection->addColumn($table_name, 'Name', ['type' => Table::TYPE_TEXT, 'comment' => 'Name']);
        	}
        	if ($connection->tableColumnExists($table_name, 'OpenDrawer' ) === false) {
        		$connection->addColumn($table_name, 'OpenDrawer', ['type' => Table::TYPE_INTEGER, 'comment' => 'OpenDrawer']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ReturnAllowed' ) === false) {
        		$connection->addColumn($table_name, 'ReturnAllowed', ['type' => Table::TYPE_INTEGER, 'comment' => 'ReturnAllowed']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Rounding' ) === false) {
        		$connection->addColumn($table_name, 'Rounding', ['type' => Table::TYPE_FLOAT, 'comment' => 'Rounding']);
        	}
        	if ($connection->tableColumnExists($table_name, 'RoundingMethode' ) === false) {
        		$connection->addColumn($table_name, 'RoundingMethode', ['type' => Table::TYPE_INTEGER, 'comment' => 'RoundingMethode']);
        	}
        	if ($connection->tableColumnExists($table_name, 'StoreID' ) === false) {
        		$connection->addColumn($table_name, 'StoreID', ['type' => Table::TYPE_TEXT, 'comment' => 'StoreID']);
        	}
        	if ($connection->tableColumnExists($table_name, 'TenderFunction' ) === false) {
        		$connection->addColumn($table_name, 'TenderFunction', ['type' => Table::TYPE_INTEGER, 'comment' => 'TenderFunction']);
        	}
        	if ($connection->tableColumnExists($table_name, 'TenderTypeId' ) === false) {
        		$connection->addColumn($table_name, 'TenderTypeId', ['type' => Table::TYPE_TEXT, 'comment' => 'TenderTypeId']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ValidOnMobilePOS' ) === false) {
        		$connection->addColumn($table_name, 'ValidOnMobilePOS', ['type' => Table::TYPE_INTEGER, 'comment' => 'ValidOnMobilePOS']);
        	}
        }
    }


}

