<?php

namespace Pagespeedfr\CmsAcf\Controller\Adminhtml\Acf;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;
use Pagespeedfr\CmsAcf\Model\Acf;
use Pagespeedfr\CmsAcf\Model\AcfFactory;

class Load extends Action
{
    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var AcfFactory
     */
    protected $acfFactory;

    /**
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param PageFactory $resultPageFactory
     * @param AcfFactory $acfFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        PageFactory $resultPageFactory,
        AcfFactory $acfFactory
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->acfFactory = $acfFactory;
    }

    /**
     * Execute action
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();
        
        try {
            $acfId = $this->getRequest()->getParam('acf_id');
            
            if (!$acfId) {
                return $resultJson->setData([
                    'success' => false,
                    'message' => 'ID ACF requis'
                ]);
            }

            // Charger le modèle ACF
            $acfModel = $this->acfFactory->create();
            $acfModel->load($acfId);

            if (!$acfModel->getId()) {
                return $resultJson->setData([
                    'success' => false,
                    'message' => 'ACF non trouvé avec l\'ID: ' . $acfId
                ]);
            } 
 
            return $resultJson->setData([
                'success' => true,
                'message' => 'Données ACF chargées avec succès',
                'acf_data' => $acfModel->getData()
            ]);

        } catch (\Exception $e) {
            return $resultJson->setData([
                'success' => false,
                'message' => 'Erreur lors du chargement: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Check if user has enough privileges
     *
     * @return bool
     */
    // protected function _isAllowed()
    // {
    //     return $this->_authorization->isAllowed('Pagespeedfr_CmsAcf::acf');
    // }
}