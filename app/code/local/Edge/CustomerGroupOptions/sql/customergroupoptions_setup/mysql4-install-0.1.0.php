<?php
$installer = $this;
$installer->startSetup();

/**
 * Create table 'customer_group_options'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('customergroupoptions/customergroupoptions'))
    ->addColumn('customer_group_options_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Customer Group Options Id')
    ->addColumn('customer_group_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        ), 'Customer Group ID')
    ->addColumn('payment_methods', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'unsigned'  => true,
        'nullable'  => true,
        'default'   => null
        ), 'Payment Method IDs')
    ->addForeignKey($installer->getFkName('customergroupoptions/customergroupoptions', 'customer_group_id', 'customer/customer_group', 'customer_group_id'),
        'customer_group_id', $installer->getTable('customer/customer_group'), 'customer_group_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addIndex($installer->getTable('customergroupoptions/customergroupoptions'), 'customer_group_id', array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE))
    ->setComment('Customer Group - Payment Method Relation Table');

$installer->getConnection()->createTable($table);
$installer->endSetup();