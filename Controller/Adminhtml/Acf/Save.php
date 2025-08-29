<?php

namespace Pagespeedfr\CmsAcf\Controller\Adminhtml\Acf;

use Magento\Backend\App\Action;
use Pagespeedfr\CmsAcf\Model\Acf;
use \Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
class Save extends \Magento\Backend\App\Action
{
    protected $Acf; 
    protected $filesystem; 

    /**
     * Construct
     *
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory
     */
    public function __construct(
        Action\Context $context,
        Acf $Acf,
        \Magento\Framework\Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->Acf = $Acf;
        $this->filesystem = $filesystem;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $this->Acf->load($id);
            } else {
                unset($data['id']);
            }
            switch ($data['acftype']) {
                case 0:
                    $data['content'] = $data['content_text'];
                    $data['content_secondary'] = "";
                    break;
                case 1:
                    $data['content'] = $data['content_link_text'];
                    $data['content_secondary'] = $data['content_link_url'];
                    break;
                case 2:
                    $data['content'] = $data['content_image'];
                    $data['content_secondary'] = $data['content_image_alt'];
                    break;
                case 3:
                    // $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
                    // $path = $mediaDirectory->getAbsolutePath();
                    // $relativePath = str_replace($this->filesystem->getDirectoryRead(DirectoryList::ROOT)->getAbsolutePath(), '', $path);

                    $data['content'] = '/media/acf_files/' . $data['content_file'];
                    $data['content_secondary'] = $data['content_file_text'];
                    break;
            }
 
            $this->Acf->setData($data);
            try {
                $this->Acf->save();
                $this->messageManager->addSuccess(__('The data has been saved.'));
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }

}