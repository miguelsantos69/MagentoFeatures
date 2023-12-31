<?php
declare(strict_types=1);

namespace Rokezzz\CheckoutTypes\ViewModel;

use Exception;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Rokezzz\CheckoutTypes\Api\OrderCheckoutTypeRepositoryInterface;

class OrderCheckoutType implements ArgumentInterface
{
    /**
     * @param OrderCheckoutTypeRepositoryInterface $orderCheckoutTypeRepository
     */
    public function __construct(
        private readonly OrderCheckoutTypeRepositoryInterface $orderCheckoutTypeRepository
    ) {
    }

    /**
     * @param int $orderId
     * @return string
     */
    public function getOrderCheckoutType(int $orderId): string
    {
        try {
            $orderCheckoutType = $this->orderCheckoutTypeRepository->getCheckoutTypeByOrderId($orderId);
            return $orderCheckoutType->getName();
        } catch (Exception $exception) {
            return '';
        }
    }
}
