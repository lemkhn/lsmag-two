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

class ReplExtendedVariantValue
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $table_name = $setup->getTable( 'ls_replication_repl_extended_variant_value' ); 
        if(!$setup->tableExists($table_name)) {
        	$table = $setup->getConnection()->newTable( $table_name );
        	$table->addColumn('repl_extended_variant_value_id', Table::TYPE_INTEGER, NULL, 
        	                    [ 'identity' => TRUE, 'primary' => TRUE,
        	                      'unsigned' => TRUE, 'nullable' => FALSE, 'auto_increment'=> TRUE ]);
        	$table->addColumn('scope', Table::TYPE_TEXT, 8);
        	$table->addColumn('scope_id', Table::TYPE_INTEGER, 11);
        	$table->addColumn('processed', Table::TYPE_BOOLEAN, null, [ 'default' => 0 ], 'Flag to check if data is already copied into Magento. 0 means needs to be copied into Magento tables & 1 means already copied');
        	$table->addColumn('is_updated', Table::TYPE_BOOLEAN, null, [ 'default' => 0 ], 'Flag to check if data is already updated from Omni into Magento. 0 means already updated & 1 means needs to be updated into Magento tables');
        	$table->addColumn('is_failed', Table::TYPE_BOOLEAN, null, [ 'default' => 0 ], 'Flag to check if data is already added from Flat into Magento successfully or not. 0 means already added successfully & 1 means failed to add successfully into Magento tables');
        	$table->addColumn('Code' , Table::TYPE_TEXT, '');
        	$table->addColumn('DimensionLogicalOrder' , Table::TYPE_INTEGER, '');
        	$table->addColumn('Dimensions' , Table::TYPE_TEXT, '');
        	$table->addColumn('FrameworkCode' , Table::TYPE_TEXT, '');
        	$table->addColumn('IsDeleted' , Table::TYPE_BOOLEAN, '');
        	$table->addColumn('ItemId' , Table::TYPE_TEXT, '');
        	$table->addColumn('LogicalOrder' , Table::TYPE_INTEGER, '');
        	$table->addColumn('Timestamp' , Table::TYPE_TEXT, '');
        	$table->addColumn('Value' , Table::TYPE_TEXT, '');
        	$table->addColumn('created_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT ], 'Created At');
        	$table->addColumn('updated_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE ], 'Updated At');
        	$setup->getConnection()->createTable( $table );
        } else {
        	$connection = $setup->getConnection();
        	if ($connection->tableColumnExists($table_name, 'Code' ) === false) {
        		$connection->addColumn($table_name, 'Code', ['type' => Table::TYPE_TEXT, 'comment' => 'Code']);
        	}
        	if ($connection->tableColumnExists($table_name, 'DimensionLogicalOrder' ) === false) {
        		$connection->addColumn($table_name, 'DimensionLogicalOrder', ['type' => Table::TYPE_INTEGER, 'comment' => 'DimensionLogicalOrder']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Dimensions' ) === false) {
        		$connection->addColumn($table_name, 'Dimensions', ['type' => Table::TYPE_TEXT, 'comment' => 'Dimensions']);
        	}
        	if ($connection->tableColumnExists($table_name, 'FrameworkCode' ) === false) {
        		$connection->addColumn($table_name, 'FrameworkCode', ['type' => Table::TYPE_TEXT, 'comment' => 'FrameworkCode']);
        	}
        	if ($connection->tableColumnExists($table_name, 'IsDeleted' ) === false) {
        		$connection->addColumn($table_name, 'IsDeleted', ['type' => Table::TYPE_BOOLEAN, 'comment' => 'IsDeleted']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ItemId' ) === false) {
        		$connection->addColumn($table_name, 'ItemId', ['type' => Table::TYPE_TEXT, 'comment' => 'ItemId']);
        	}
        	if ($connection->tableColumnExists($table_name, 'LogicalOrder' ) === false) {
        		$connection->addColumn($table_name, 'LogicalOrder', ['type' => Table::TYPE_INTEGER, 'comment' => 'LogicalOrder']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Timestamp' ) === false) {
        		$connection->addColumn($table_name, 'Timestamp', ['type' => Table::TYPE_TEXT, 'comment' => 'Timestamp']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Value' ) === false) {
        		$connection->addColumn($table_name, 'Value', ['type' => Table::TYPE_TEXT, 'comment' => 'Value']);
        	}
        }
    }


}

