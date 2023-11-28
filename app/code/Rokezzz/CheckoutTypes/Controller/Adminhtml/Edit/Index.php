<?php
declare(strict_types=1);

namespace Rokezzz\CheckoutTypes\Controller\Adminhtml\Edit;

use Exception;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\View\Result\Page;
use Rokezzz\CheckoutTypes\Model\CheckoutType;
use Rokezzz\CheckoutTypes\Model\CheckoutTypeFactory;
use Rokezzz\CheckoutTypes\Model\CheckoutTypeRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param CheckoutTypeFactory $checkoutTypeFactory
     * @param DataPersistorInterface $dataPersistor
     * @param CheckoutTypeRepository $checkoutTypeRepository
     */
    public function __construct(
        Context $context,
        private readonly PageFactory $resultPageFactory,
        private readonly CheckoutTypeFactory $checkoutTypeFactory,
        private readonly DataPersistorInterface $dataPersistor,
        private readonly CheckoutTypeRepository $checkoutTypeRepository
    ) {
        parent::__construct($context);
    }

    /**
     * @return Page|Redirect
     */
    public function execute(): Page | Redirect
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->addHandle('rokezzz_checkouttypes_add_index');
        $resultPage->getConfig()->getTitle()->prepend((__('Edit checkout type')));
        $isEdited = $this->getRequest()->getParam('id');
        $postData = $this->getRequest()->getParam('checkout_type');

        try {
            if (is_array($postData)) {
                /** @var CheckoutType $model */
                $model = $this->checkoutTypeFactory->create();
                $model->setPostDataFromUiForm($postData);

                if ($this->checkoutTypeRepository->save($model)) {
                    $this->dataPersistor->clear('checkout_type_model');
                    $this->messageManager->addSuccessMessage(__('Type saved successfully.'));
                    $resultRedirect = $this->resultRedirectFactory->create();
                    return $resultRedirect->setPath('*/grid/index');

                } else {
                    $this->dataPersistor->set('checkout_type_model', $postData);
                    $this->messageManager->addErrorMessage(__('Error during save type.'));
                }
            }
            /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
            $resultPage = $this->resultPageFactory->create();
            $resultPage
                ->setActiveMenu('Rokezzz_CheckoutTypes::manage_checkouts')
                ->getConfig()->getTitle()->prepend(
                    $isEdited ? __('Edit checkout type') : __('New checkout type')
                );
            return $resultPage;
        } catch (Exception $e) {
            $this->dataPersistor->set('checkout_type_model', $postData);
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }

        return $resultPage;
    }

    /**
     * @return bool
     */
    public function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Rokezzz_CheckoutTypes::checkout_types_admin');
    }
}
