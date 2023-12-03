<?php

namespace Rokezzz\CheckoutTypes\Api\Data;

interface OrderCheckoutTypeInterface
{
    const ID = 'id';
    const ORDER_ID = 'order_id';
    const CHECKOUT_TYPE_ID = 'checkout_type_id';

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $value
     * @return void
     */
    public function setId(int $value): void;

    /**
     * @return string
     */
    public function getOrderId(): int;

    /**
     * @param int $value
     * @return void
     */
    public function setOrderId(int $value): void;

    /**
     * @return int
     */
    public function getCheckoutTypeId(): int;

    /**
     * @param int $value
     * @return void
     */
    public function setCheckoutTypeId(int $value): void;
}
