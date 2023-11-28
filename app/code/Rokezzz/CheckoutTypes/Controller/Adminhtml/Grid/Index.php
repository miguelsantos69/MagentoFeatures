<?php
declare(strict_types=1);

namespace Rokezzz\CheckoutTypes\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        private readonly PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
    }

    public function execute(): ResultInterface|ResponseInterface|Page
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Rokezzz_CheckoutTypes::manage_checkouts');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Checkouts Types'));

        return $resultPage;
    }

    public function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Rokezzz_CheckoutTypes::checkout_types_admin');
    }
}
