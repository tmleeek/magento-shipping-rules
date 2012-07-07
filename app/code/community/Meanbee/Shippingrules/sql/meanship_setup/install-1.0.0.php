<?php
$installer = $this;
$installer->startSetup();

/**
 * Create table 'catalogrule/rule'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('meanship/rule'))
    ->addColumn('rule_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Rule Id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Shipping Method Name')
    ->addColumn('price', Varien_Db_Ddl_Table::TYPE_DECIMAL, array(12,2), array(
        'nullable'  => false,
        'default'   => 0.00,
    ), 'Shipping Method Price')
        ->addColumn('cost', Varien_Db_Ddl_Table::TYPE_DECIMAL, array(12,2), array(
        'nullable'  => false,
        'default'   => 0.00,
    ), 'Shipping Method Cost')
    ->addColumn('conditions_serialized', Varien_Db_Ddl_Table::TYPE_TEXT, '2M', array(), 'Conditions Serialized')
    ->addColumn('stop_rules_processing', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'nullable'  => false,
        'default'   => '1',
    ), 'Stop Rules Processing')
    ->addColumn('sort_order', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
    ), 'Sort Order')
    ->addColumn('customer_group_ids', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(), 'Customer Group Ids')
    ->addColumn('website_ids', Varien_Db_Ddl_Table::TYPE_TEXT, 4000, array(), 'Website Ids')
    ->addColumn('is_active', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'nullable'  => false,
        'default'   => '0',
    ), 'Is Active')
    ->setComment('Meanbee Shipping Rule');

$installer->getConnection()->createTable($table);

$installer->endSetup();