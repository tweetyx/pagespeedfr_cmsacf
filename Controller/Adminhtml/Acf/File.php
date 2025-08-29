<?php
namespace Pagespeedfr\CmsAcf\Controller\Adminhtml\Acf;

use Magento\Framework\App\Filesystem\DirectoryList;

class File extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Filesystem\Driver\File
     */
    protected $_file;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $_logger;

    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $_filesystem;

    /**
     * @var \Magento\MediaStorage\Model\File\UploaderFactory
     */
    protected $_fileUploaderFactory;


    /**
     * Construct
     *
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory
     */
    public function __construct(
         \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
    ) {
         $this->filesystem = $filesystem;
         $this->uploaderFactory = $uploaderFactory;       
         $this->jsonFactory = $jsonFactory;
           parent::__construct($context);
    }


    public function execute()
    {
        $resultJson = $this->jsonFactory->create();

        try {
            if (!isset($_FILES['content_file']) || $_FILES['content_file']['error'] !== UPLOAD_ERR_OK) {
                return $resultJson->setData([
                    'success' => false,
                    'message' => 'Aucun fichier uploadé ou erreur lors de l\'upload'
                ]);
            }

            $uploader = $this->uploaderFactory->create(['fileId' => 'content_file']);
            $uploader->setAllowedExtensions(['txt','png', 'csv', 'pdf', 'doc', 'docx']);
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(false);

            $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
            $destinationPath = $mediaDirectory->getAbsolutePath('acf_files/');

            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $result = $uploader->save($destinationPath);

            // Optionnel : traiter le fichier immédiatement
            $filePath = $destinationPath . $result['file'];
            $this->processFile($filePath);

            return $resultJson->setData([
                'success' => true,
                'filename' => $result['file'],
                'message' => 'Fichier uploadé avec succès'
            ]);

        } catch (\Exception $e) {
            return $resultJson->setData([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    private function processFile($filePath)
    {
        // Traiter votre fichier ici
        $content = file_get_contents($filePath);
        
        // Exemple : sauvegarder en session pour utilisation ultérieure
        $this->_session->setUploadedFileContent($content);
        $this->_session->setUploadedFileName(basename($filePath));
    }
 

}