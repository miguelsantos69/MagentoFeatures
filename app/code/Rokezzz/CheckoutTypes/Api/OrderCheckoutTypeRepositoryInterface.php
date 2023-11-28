<?php

namespace Rokezzz\CheckoutTypes\Api;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Rokezzz\CheckoutTypes\Api\Data\CheckoutTypeInterface;
use Rokezzz\CheckoutTypes\Api\Data\OrderCheckoutTypeInterface;
use Rokezzz\CheckoutTypes\Model\ResourceModel\OrderCheckoutType\Collection as OrderCheckoutTypeCollection;

interface OrderCheckoutTypeRepositoryInterface
{
    /**
     * @param OrderCheckoutTypeInterface $orderCheckoutType
     * @return OrderCheckoutTypeInterface
     * @throws CouldNotSaveException
     */
    public function save(OrderCheckoutTypeInterface $orderCheckoutType): OrderCheckoutTypeInterface;

    /**
     * @param int $orderId
     * @return OrderCheckoutTypeInterface|null
     */
    public function getByOrderId(int $orderId): ?OrderCheckoutTypeInterface;

    /**
     * @param int $orderId
     * @return CheckoutTypeInterface|null
     */
    public function getCheckoutTypeByOrderId(int $orderId): ?CheckoutTypeInterface;
}
