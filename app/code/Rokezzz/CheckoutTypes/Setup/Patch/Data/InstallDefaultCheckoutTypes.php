<?php
declare(strict_types=1);

namespace Rokezzz\CheckoutTypes\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Rokezzz\CheckoutTypes\Api\CheckoutTypeRepositoryInterface;
use Rokezzz\CheckoutTypes\Api\Data\CheckoutTypeInterface;
use Rokezzz\CheckoutTypes\Api\Data\CheckoutTypeInterfaceFactory;

class InstallDefaultCheckoutTypes implements DataPatchInterface
{
    private const DEFAULT_TYPES = [
        ['name' => 'Standard'],
        ['name' => 'Outlet'],
        ['name' => 'Test']
    ];

    /**
     * @param CheckoutTypeRepositoryInterface $checkoutTypeRepository
     * @param CheckoutTypeInterfaceFactory $checkoutTypeInterfaceFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        private readonly CheckoutTypeRepositoryInterface $checkoutTypeRepository,
        private readonly CheckoutTypeInterfaceFactory $checkoutTypeInterfaceFactory,
        private readonly DataObjectHelper $dataObjectHelper,
        private readonly ModuleDataSetupInterface $moduleDataSetup
    ) {
    }

    /**
     * @return array|string[]
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @return array|string[]
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * @return void
     */
    public function apply(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $this->installDefaultCheckoutTypes();
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @return void
     */
    private function installDefaultCheckoutTypes(): void
    {
        foreach (static::DEFAULT_TYPES as $type) {
            $typeObject = $this->checkoutTypeInterfaceFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $typeObject,
                $type,
                CheckoutTypeInterface::class
            );

            $this->checkoutTypeRepository->save($typeObject);
        }
    }
}
