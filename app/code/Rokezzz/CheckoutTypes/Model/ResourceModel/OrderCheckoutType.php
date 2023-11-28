<?php
declare(strict_types=1);

namespace Rokezzz\CheckoutTypes\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class OrderCheckoutType extends AbstractDb
{
    private const MAIN_TABLE = 'rokezzz_checkout_types_sales_order';
    private const ID_FIELD_NAME = 'id';

    protected function _construct()
    {
        $this->_init(static::MAIN_TABLE, static::ID_FIELD_NAME);
    }
}
