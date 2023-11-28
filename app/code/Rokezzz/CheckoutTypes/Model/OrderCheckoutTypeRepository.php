<?php
declare(strict_types=1);

namespace Rokezzz\CheckoutTypes\Model;

use Exception;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Rokezzz\CheckoutTypes\Api\Data\CheckoutTypeInterface;
use Rokezzz\CheckoutTypes\Api\Data\OrderCheckoutTypeInterface;
use Rokezzz\CheckoutTypes\Api\Data\OrderCheckoutTypeInterfaceFactory;
use Rokezzz\CheckoutTypes\Api\OrderCheckoutTypeRepositoryInterface;
use Rokezzz\CheckoutTypes\Model\ResourceModel\CheckoutType\CollectionFactory;
use Rokezzz\CheckoutTypes\Model\ResourceModel\OrderCheckoutType;
use Rokezzz\CheckoutTypes\Api\CheckoutTypeRepositoryInterface;

class OrderCheckoutTypeRepository implements OrderCheckoutTypeRepositoryInterface
{
    private const CONDITION_EQ = 'eq';

    public function __construct(
        private readonly OrderCheckoutType $resource,
        private readonly OrderCheckoutTypeInterfaceFactory $factory,
        private readonly CheckoutTypeRepositoryInterface $checkoutTypeRepository
    ) {
    }

    public function save(OrderCheckoutTypeInterface $orderCheckoutType): OrderCheckoutTypeInterface
    {
        try {
            $this->resource->save($orderCheckoutType);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $orderCheckoutType;
    }

    /**
     * @throws NoSuchEntityException
     */
    public function getByOrderId(int $orderId): ?OrderCheckoutTypeInterface
    {
        $orderCheckoutType = $this->factory->create();
        $this->resource->load($orderCheckoutType, $orderId, 'order_id');

        if (!$orderCheckoutType->getId()) {
            throw new NoSuchEntityException(__('Unable to find checkout type for order with ID "%1"', $orderId));
        }

        return $orderCheckoutType;
    }


    /**
     * @throws NoSuchEntityException
     * @throws Exception
     */
    public function getCheckoutTypeByOrderId(int $orderId): ?CheckoutTypeInterface
    {
        $orderCheckoutType = $this->getByOrderId($orderId);
        if (!$orderCheckoutType) {
            throw new Exception('There is no checkout types related to this order.');
        }

        return $this->checkoutTypeRepository->getById($orderCheckoutType->getCheckoutTypeId());
    }
}
