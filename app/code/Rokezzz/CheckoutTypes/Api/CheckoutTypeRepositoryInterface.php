<?php

namespace Rokezzz\CheckoutTypes\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Rokezzz\CheckoutTypes\Api\Data\CheckoutTypeInterface;
use Rokezzz\CheckoutTypes\Api\Data\CheckoutTypeSearchResultInterface;

interface CheckoutTypeRepositoryInterface
{
    /**
     * @param int $id
     * @return CheckoutTypeInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): CheckoutTypeInterface;

    /**
     * @param CheckoutTypeInterface $type
     */
    public function save(CheckoutTypeInterface $type): CheckoutTypeInterface;

    /**
     * @param CheckoutTypeInterface $type
     * @return void
     */
    public function delete(CheckoutTypeInterface $type): void;
}
