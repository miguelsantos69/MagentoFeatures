<?php
declare(strict_types=1);

namespace Rokezzz\CheckoutTypes\Model;

use Exception;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Rokezzz\CheckoutTypes\Api\CheckoutTypeRepositoryInterface;
use Rokezzz\CheckoutTypes\Api\Data\CheckoutTypeInterface;
use Rokezzz\CheckoutTypes\Api\Data\CheckoutTypeSearchResultInterface;
use Rokezzz\CheckoutTypes\Model\ResourceModel\CheckoutType as CheckoutTypeResourceModel;

class CheckoutTypeRepository implements CheckoutTypeRepositoryInterface
{
    public function __construct(
        private readonly CheckoutTypeFactory $checkoutTypeFactory,
        private readonly CheckoutTypeResourceModel $resourceModel
    ) {
    }

    public function getById(int $id): CheckoutTypeInterface
    {
        $checkoutType = $this->checkoutTypeFactory->create();
        $this->resourceModel->load($checkoutType, $id);

        if (!$checkoutType->getId()) {
            throw new NoSuchEntityException(__('Unable to find location with ID "%1"', $id));
        }
        return $checkoutType;
    }

    /**
     * @throws CouldNotSaveException
     */
    public function save(CheckoutTypeInterface $type): CheckoutTypeInterface
    {
        try {
            $this->resourceModel->save($type);
            return $type;
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
    }

    /**
     * @throws CouldNotSaveException
     */
    public function delete(CheckoutTypeInterface $type): void
    {
        try {
            $this->resourceModel->delete($type);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(
                throw new CouldNotSaveException(__($exception->getMessage()))
            );
        }
    }
}
