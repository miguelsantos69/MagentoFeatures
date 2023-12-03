<?php
declare(strict_types=1);

namespace Rokezzz\CheckoutTypes\Ui\DataProvider;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Rokezzz\CheckoutTypes\Model\CheckoutType;
use Rokezzz\CheckoutTypes\Model\ResourceModel\CheckoutType\CollectionFactory;

class FormDataProvider extends AbstractDataProvider
{
    protected DataPersistorInterface $dataPersistor;
    protected array $loadedData;
    protected $collection;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $checkoutTypeCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $checkoutTypeCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->collection = $checkoutTypeCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $types = $this->collection->getItems();
        /** @var $type CheckoutType */
        foreach ($types as $type) {
            $this->loadedData[$type->getTypeId()]['checkout_type'] = $type->getData();
        }

        $data = $this->dataPersistor->get('checkout_type_model');
        $this->dataPersistor->clear('checkout_type_model');
        if (!empty($data)) {
            $type = $this->collection->getNewEmptyItem();
            $type->setData($data);
            $this->loadedData[$type->getTypeId()]['checkout_type'] = $type->getData();
            $this->dataPersistor->clear('checkout_type_model');
        }

        return $this->loadedData ?? [];
    }
}
