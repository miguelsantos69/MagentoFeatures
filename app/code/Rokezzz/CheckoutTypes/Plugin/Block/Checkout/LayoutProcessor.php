<?php
declare(strict_types=1);

namespace Rokezzz\CheckoutTypes\Plugin\Block\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessor as CoreLayoutProcessor;
use Rokezzz\CheckoutTypes\Model\CheckoutTypeFactory;

class LayoutProcessor
{

    public function __construct(
        private readonly CheckoutTypeFactory $checkoutTypeFactory,
    ) {
    }

    public function afterProcess(CoreLayoutProcessor $processor, array $jsLayout): array
    {
        $this->setCheckoutTypes($jsLayout);
        return $jsLayout;
    }

    private function setCheckoutTypes(array &$jsLayout): void
    {
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['before-form']['children']['checkout-types-area'] =
            [
                'component' => 'Magento_Ui/js/form/element/checkbox-set',
                'config' => [
                    'customScope' => 'shippingAddress.custom_attributes',
                    'template' => 'ui/form/field',
                    'elementTmpl' => 'ui/form/element/checkbox-set',
                    'options' => $this->getOptions(),
                    'id' => 'checkout_type'
                ],
                'dataScope' => 'shippingAddress.custom_attributes.' . '$attributeCode',
                'provider' => 'checkoutProvider',
                'label' => 'Checkout Type',
                'id' => 'checkout_type',
                'validation' => [
                    'required-entry' => true
                ]
            ];
    }

    private function getOptions(): array
    {
        $options = [];
        $checkoutTypes = $this->checkoutTypeFactory->create()->getCollection();
        foreach ($checkoutTypes as $type) {
            $options[] = [
                'value' => $type->getTypeId(),
                'label' => $type->getName()
            ];
        }

        return $options;
    }
}
