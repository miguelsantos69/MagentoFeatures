<?php
declare(strict_types=1);

namespace Rokezzz\CheckoutTypes\Model;

use Magento\Framework\Model\AbstractModel;
use Rokezzz\CheckoutTypes\Api\Data\OrderCheckoutTypeInterface;

class OrderCheckoutType extends AbstractModel implements OrderCheckoutTypeInterface
{
    public function getId(): int
    {
        return (int)$this->getData(static::ID);
    }

    public function setId($value): void
    {
        $this->setData(static::ID, $value);
    }

    public function getOrderId(): int
    {
        return (int)$this->getData(static::ORDER_ID);
    }

    public function setOrderId(int $value): void
    {
        $this->setData(static::ORDER_ID, $value);
    }

    public function getCheckoutTypeId(): int
    {
        return (int)$this->getData(static::CHECKOUT_TYPE_ID);
    }

    public function setCheckoutTypeId(int $value): void
    {
        $this->setData(static::CHECKOUT_TYPE_ID, $value);
    }
}
