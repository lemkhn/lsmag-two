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

class ReplItemUnitOfMeasure
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $table_name = $setup->getTable( 'ls_replication_repl_item_unit_of_measure' ); 
        if(!$setup->tableExists($table_name)) {
        	$table = $setup->getConnection()->newTable( $table_name );
        	$table->addColumn('repl_item_unit_of_measure_id', Table::TYPE_INTEGER, 11, [ 'identity' => TRUE, 'primary' => TRUE, 'unsigned' => TRUE, 'nullable' => FALSE, 'auto_increment'=> TRUE ]);
        	$table->addColumn('scope', Table::TYPE_TEXT, 8);
        	$table->addColumn('scope_id', Table::TYPE_INTEGER, 11);
        	$table->addColumn('processed', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already copied into Magento. 0 means needs to be copied into Magento tables & 1 means already copied');
        	$table->addColumn('is_updated', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already updated from Omni into Magento. 0 means already updated & 1 means needs to be updated into Magento tables');
        	$table->addColumn('is_failed', Table::TYPE_BOOLEAN, 1, [ 'default' => 0 ], 'Flag to check if data is already added from Flat into Magento successfully or not. 0 means already added successfully & 1 means failed to add successfully into Magento tables');
        	$table->addColumn('Code' , Table::TYPE_TEXT, '');
        	$table->addColumn('CountAsOne' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('Description' , Table::TYPE_TEXT, '');
        	$table->addColumn('IsDeleted' , Table::TYPE_BOOLEAN, 1);
        	$table->addColumn('ItemId' , Table::TYPE_TEXT, '');
        	$table->addColumn('Order' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('QtyPrUOM' , Table::TYPE_DECIMAL, '20,4');
        	$table->addColumn('Selection' , Table::TYPE_INTEGER, 11);
        	$table->addColumn('ShortDescription' , Table::TYPE_TEXT, '');
        	$table->addColumn('processed_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => true ], 'Processed At');
        	$table->addColumn('created_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT ], 'Created At');
        	$table->addColumn('updated_at', Table::TYPE_TIMESTAMP, null, [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE ], 'Updated At');
        	$setup->getConnection()->createTable( $table );
        } else {
        	$connection = $setup->getConnection();
        	if ($connection->tableColumnExists($table_name, 'Code' ) === false) {
        		$connection->addColumn($table_name, 'Code', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Code']);
        	} else {
        		$connection->modifyColumn($table_name, 'Code', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Code']);
        	}
        	if ($connection->tableColumnExists($table_name, 'CountAsOne' ) === false) {
        		$connection->addColumn($table_name, 'CountAsOne', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'CountAsOne']);
        	} else {
        		$connection->modifyColumn($table_name, 'CountAsOne', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'CountAsOne']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Description' ) === false) {
        		$connection->addColumn($table_name, 'Description', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Description']);
        	} else {
        		$connection->modifyColumn($table_name, 'Description', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'Description']);
        	}
        	if ($connection->tableColumnExists($table_name, 'IsDeleted' ) === false) {
        		$connection->addColumn($table_name, 'IsDeleted', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'IsDeleted']);
        	} else {
        		$connection->modifyColumn($table_name, 'IsDeleted', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'IsDeleted']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ItemId' ) === false) {
        		$connection->addColumn($table_name, 'ItemId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'ItemId']);
        	} else {
        		$connection->modifyColumn($table_name, 'ItemId', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'ItemId']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Order' ) === false) {
        		$connection->addColumn($table_name, 'Order', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'Order']);
        	} else {
        		$connection->modifyColumn($table_name, 'Order', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'Order']);
        	}
        	if ($connection->tableColumnExists($table_name, 'QtyPrUOM' ) === false) {
        		$connection->addColumn($table_name, 'QtyPrUOM', ['length' => '20,4','default' => null,'type' => Table::TYPE_DECIMAL, 'comment' => 'QtyPrUOM']);
        	} else {
        		$connection->modifyColumn($table_name, 'QtyPrUOM', ['length' => '20,4','default' => null,'type' => Table::TYPE_DECIMAL, 'comment' => 'QtyPrUOM']);
        	}
        	if ($connection->tableColumnExists($table_name, 'Selection' ) === false) {
        		$connection->addColumn($table_name, 'Selection', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'Selection']);
        	} else {
        		$connection->modifyColumn($table_name, 'Selection', ['length' => 11,'default' => null,'type' => Table::TYPE_INTEGER, 'comment' => 'Selection']);
        	}
        	if ($connection->tableColumnExists($table_name, 'ShortDescription' ) === false) {
        		$connection->addColumn($table_name, 'ShortDescription', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'ShortDescription']);
        	} else {
        		$connection->modifyColumn($table_name, 'ShortDescription', ['length' => '','default' => null,'type' => Table::TYPE_TEXT, 'comment' => 'ShortDescription']);
        	}
        	if ($connection->tableColumnExists($table_name, 'is_failed' ) === false) {
        		$connection->addColumn($table_name, 'is_failed', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'Is_failed']);
        	} else {
        		$connection->modifyColumn($table_name, 'is_failed', ['length' => 1,'default' => 0,'type' => Table::TYPE_BOOLEAN, 'comment' => 'Is_failed']);
        	}
        	if ($connection->tableColumnExists($table_name, 'processed_at' ) === false) {
        		$connection->addColumn($table_name, 'processed_at', ['length' => '','default' => null,'type' => Table::TYPE_TIMESTAMP, 'comment' => 'Processed_at']);
        	} else {
        		$connection->modifyColumn($table_name, 'processed_at', ['length' => '','default' => null,'type' => Table::TYPE_TIMESTAMP, 'comment' => 'Processed_at']);
        	}
        }
    }


}

