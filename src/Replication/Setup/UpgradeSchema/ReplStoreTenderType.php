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
        }
    }


}

