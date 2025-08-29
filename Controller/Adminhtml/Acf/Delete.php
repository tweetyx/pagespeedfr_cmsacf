<?php

namespace Pagespeedfr\CmsAcf\Controller\Adminhtml\Acf;

use Magento\Backend\App\Action;
use Pagespeedfr\CmsAcf\Model\Acf;
use \Magento\Framework\Controller\ResultFactory;

class Delete extends \Magento\Backend\App\Action
{
    protected $Acf;

    public function __construct(
        Action\Context $context,
        Acf $Acf
    ) {
        parent::__construct($context);
        $this->Acf = $Acf;
    }

    public function execute()
    {

        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $acfload = $this->Acf->load($id);

            try {
                $acfload->delete();
                $this->messageManager->addSuccess(__('The data has been delete.'));
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while deleting the data.'));
            }
        } else {
            $this->messageManager->addError(__('Something went wrong while deleting the data.'));
        }


        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}