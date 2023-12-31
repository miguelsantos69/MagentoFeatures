<?php
declare(strict_types=1);

namespace Rokezzz\CheckoutTypes\Ui\Component\Listing\Grid\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Actions extends Column
{
    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        private readonly UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['type_id'])) {
                    $urlEntityParamName = $this->getData('config/urlEntityParamName');
                    $item[$this->getData('name')]= [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                'checkout_types/edit',
                                [
                                    $urlEntityParamName => $item['type_id'],
                                ]
                            ),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                'checkout_types/delete',
                                [
                                    $urlEntityParamName => $item['type_id'],
                                ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Confirmation'),
                                'message' => __('Are you sure?')
                            ]
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }
}
