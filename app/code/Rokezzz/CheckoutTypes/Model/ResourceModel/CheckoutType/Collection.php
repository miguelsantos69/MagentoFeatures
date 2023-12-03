<?php
declare(strict_types=1);

namespace Rokezzz\CheckoutTypes\Model\ResourceModel\CheckoutType;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Rokezzz\CheckoutTypes\Model\CheckoutType as Model;
use Rokezzz\CheckoutTypes\Model\ResourceModel\CheckoutType as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
