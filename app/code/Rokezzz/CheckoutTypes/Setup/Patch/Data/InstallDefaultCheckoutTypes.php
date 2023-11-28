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

    public function __construct(
        private readonly CheckoutTypeRepositoryInterface $checkoutTypeRepository,
        private readonly CheckoutTypeInterfaceFactory $checkoutTypeInterfaceFactory,
        private readonly DataObjectHelper $dataObjectHelper,
        private readonly ModuleDataSetupInterface $moduleDataSetup
    ) {
    }

    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }

    public function apply(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $this->installDefaultCheckoutTypes();
        $this->moduleDataSetup->getConnection()->endSetup();
    }

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
