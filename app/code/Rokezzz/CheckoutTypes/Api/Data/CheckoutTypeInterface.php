<?php

namespace Rokezzz\CheckoutTypes\Api\Data;

interface CheckoutTypeInterface
{
    public const ID = 'type_id';
    public const NAME = 'name';

    /**
     * @return int
     */
    public function getTypeId(): int;

    /**
     * @param int $value
     * @return void
     */
    public function setTypeId(int $value): void;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $value
     * @return void
     */
    public function setName(string $value): void;
}
