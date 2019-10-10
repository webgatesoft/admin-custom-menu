<?php

namespace WebGate\CustomMenu\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Function install
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        //START table setup
        $table = $installer->getConnection()->newTable(
            $installer->getTable('webgate_custommenu_custommenu')
        )->addColumn(
            'entity_id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true],
            'Entity ID'
        )->addColumn(
            'title',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false]
        )->addColumn(
            'link',
            Table::TYPE_TEXT,
            191,
            ['nullable' => false]
        )->addColumn(
            'icon',
            Table::TYPE_TEXT,
            191,
            ['nullable' => true, 'default' => 'chevron-left']
        )->addColumn(
            'sortOrder',
            Table::TYPE_NUMERIC,
            191,
            ['nullable' => true]
        )->addColumn(
            'admin_id',
            Table::TYPE_NUMERIC,
            191,
            ['nullable' => true]
        )->addColumn(
            'target',
            Table::TYPE_TEXT,
            191,
            ['nullable' => true]
        );
        $installer->getConnection()->createTable($table);
        //END   table setup
    }
}
