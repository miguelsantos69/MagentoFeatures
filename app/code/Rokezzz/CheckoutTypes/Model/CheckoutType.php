<?php
declare(strict_types=1);

namespace Rokezzz\CheckoutTypes\Model;

use Magento\Framework\Model\AbstractModel;
use Rokezzz\CheckoutTypes\Api\Data\CheckoutTypeInterface;
use Rokezzz\CheckoutTypes\Model\ResourceModel\CheckoutType as ResourceModel;
use Rokezzz\CheckoutTypes\Service\PrepareDataForm;

class CheckoutType extends AbstractModel implements CheckoutTypeInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @return int
     */
    public function getTypeId(): int
    {
        return (int)$this->getData(static::ID);
    }

    /**
     * @param int $value
     */
    public function setTypeId(int $value): void
    {
        $this->setData(static::ID, $value);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string)$this->getData(static::NAME);
    }

    /**
     * @param string $value
     */
    public function setName(string $value): void
    {
        $this->setData(static::NAME, $value);
    }

    public function setPostDataFromUiForm(array $arrData): CheckoutTypeInterface
    {
        return $this->setData(PrepareDataForm::arrayFlatten($arrData));
    }
}
