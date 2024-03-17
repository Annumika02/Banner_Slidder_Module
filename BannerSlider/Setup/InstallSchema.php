<?php 
namespace Dotsquares\BannerSlider\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()
            ->newTable($installer->getTable('order_export_data'))
            ->addColumn(
                'entity_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'ID'
            )
              ->addColumn(
                'order_id',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false, 'default' => ''],
                'User Name'
            )
              ->addColumn(
                'increement_id',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false, 'default' => ''],
                'User Email'
            )
            ->addColumn(
                'date',
                Table::TYPE_DECIMAL,
                '12,4',
                [],
                'Value'
            )
            ->setComment('order expot');
        $installer->getConnection()->createTable($table);
        
        $installer->endSetup();
    }

}