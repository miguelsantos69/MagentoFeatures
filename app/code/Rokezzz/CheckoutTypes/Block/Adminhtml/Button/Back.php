<?php
declare(strict_types=1);

namespace Rokezzz\CheckoutTypes\Block\Adminhtml\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Backend\Block\Widget\Context;

class Back implements ButtonProviderInterface
{
    /**
     * @param Context $context
     */
    public function __construct(
        private readonly Context $context
    ) {
    }

    /**
     * @return array
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getUrl('checkout_types/grid/')),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
