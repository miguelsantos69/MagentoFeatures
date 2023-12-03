<?php

namespace Rokezzz\CheckoutTypes\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface CheckoutTypeSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return CheckoutTypeInterface[]
     */
    public function getItems(): array;

    /**
     * @param CheckoutTypeInterface[] $items
     * @return void
     */
    public function setItems(array $items): void;
}
