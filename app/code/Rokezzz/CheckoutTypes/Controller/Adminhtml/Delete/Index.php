<?php
declare(strict_types=1);

namespace Rokezzz\CheckoutTypes\Controller\Adminhtml\Delete;

use Exception;
use Magento\Framework\Controller\Result\Redirect;
use Rokezzz\CheckoutTypes\Api\CheckoutTypeRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Index extends Action
{
    /**
     * @param Context $context
     * @param CheckoutTypeRepositoryInterface $checkoutTypeRepository
     */
    public function __construct(
        Context $context,
        private readonly CheckoutTypeRepositoryInterface $checkoutTypeRepository
    ) {
        parent::__construct($context);
    }

    /**
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        try {
            $type = $this->checkoutTypeRepository->getById((int)$id);
            $this->checkoutTypeRepository->delete($type);
            $this->messageManager->addSuccessMessage(__('Type deleted.'));
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        return $resultRedirect->setPath('checkout_types/index/');
    }

    /**
     * @return bool
     */
    public function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Rokezzz_CheckoutTypes::checkout_types_admin');
    }
}
