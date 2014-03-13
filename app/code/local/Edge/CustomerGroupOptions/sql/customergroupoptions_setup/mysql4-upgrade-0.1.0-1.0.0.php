<?php

$installer = $this;
$installer->startSetup();

$installer->getConnection()
    ->addColumn($installer->getTable('customergroupoptions/customergroupoptions'),
    'shipping_methods',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'unsigned'  => true,
        'nullable'  => true,
        'default'   => null,
        'comment' => 'Shipping Method IDs'
    ));

$installer->endSetup();