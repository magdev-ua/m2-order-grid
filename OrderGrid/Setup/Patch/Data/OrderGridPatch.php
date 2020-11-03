<?php
declare(strict_types=1);

namespace WiserBrand\OrderGrid\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class OrderGridPatch implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $connection = $this->moduleDataSetup->getConnection();
        $grid = $this->moduleDataSetup->getTable('sales_order_grid');
        $order = $this->moduleDataSetup->getTable('sales_order');

        $connection->query(
            $connection->updateFromSelect(
                $connection->select()
                    ->join(
                        $order,
                        sprintf('%s.entity_id = %s.entity_id', $grid, $order),
                        ['coupon_code', 'discount_amount']
                    ),
                $grid
            )
        );
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
