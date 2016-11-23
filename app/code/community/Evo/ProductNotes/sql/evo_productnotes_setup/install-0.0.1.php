<?php
$installer = $this;
$installer->startSetup();
$table = $installer->getConnection()->newTable($installer->getTable('evo_productnotes/notes'))
    ->addColumn('note_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' => true,
    ), 'Note ID')
    ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'unsigned' => true,
        'nullable' => false
    ), 'Product ID')
    ->addColumn('note', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => false,
        'default' => '',
    ), 'Note')
    ->addColumn('note_date', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable' => true,
        'default' => null,
    ), 'Date')
    ->setComment('Product notes table');
$installer->getConnection()->createTable($table);
$installer->endSetup();