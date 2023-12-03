<?php
declare(strict_types=1);

namespace Rokezzz\CheckoutTypes\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CheckoutType extends AbstractDb
{
    private const MAIN_TABLE = 'rokezzz_checkout_types';
    private const ID_FIELD_NAME = 'type_id';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init(static::MAIN_TABLE, static::ID_FIELD_NAME);
    }
}
