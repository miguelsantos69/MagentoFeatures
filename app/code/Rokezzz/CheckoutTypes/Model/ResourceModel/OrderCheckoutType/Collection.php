<?php
declare(strict_types=1);

namespace Rokezzz\CheckoutTypes\Model\ResourceModel\OrderCheckoutType;

use Rokezzz\CheckoutTypes\Model\OrderCheckoutType as Model;
use Rokezzz\CheckoutTypes\Model\ResourceModel\OrderCheckoutType as ResourceModel;

class Collection
{
    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
