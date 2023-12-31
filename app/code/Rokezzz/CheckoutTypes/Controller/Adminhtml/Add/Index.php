<?php
declare(strict_types=1);

namespace Rokezzz\CheckoutTypes\Controller\Adminhtml\Add;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\Redirect;

class Index extends Action
{
    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/edit/index');
    }
}
