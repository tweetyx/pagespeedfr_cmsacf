<?php
declare(strict_types=1);

namespace Pagespeedfr\CmsAcf\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\Exception\LocalizedException;
use Pagespeedfr\CmsAcf\Model\Acf;
use Pagespeedfr\CmsAcf\Model\ResourceModel\Acf\CollectionFactory;

class AcfField implements ArgumentInterface
{
    /**
     * @var CollectionFactory
     */
    private CollectionFactory $acfCollectionFactory;

    /**
     * @var array
     */
    private array $acfDataCache = [];

    /**
     * AcfField constructor.
     * @param CollectionFactory $acfCollectionFactory
     */
    public function __construct(
        CollectionFactory $acfCollectionFactory
    ) {
        $this->acfCollectionFactory = $acfCollectionFactory;
    }

    /**
     * Get ACF field by ID
     *
     * @param int $id
     * @return array|null
     */
    public function getAcfField(int $id): ?array
    {
        if (isset($this->acfDataCache[$id])) {
            return $this->acfDataCache[$id];
        }

        try {
            $collection = $this->acfCollectionFactory->create();
            $acfItem = $collection->addFieldToFilter('id', $id)
                                 ->addFieldToFilter('active', 1)
                                 ->getFirstItem();

            if ($acfItem->getId()) {
                $this->acfDataCache[$id] = [
                    'id' => (int)$acfItem->getId(),
                    'acftype' => $acfItem->getData('acftype'),
                    'content' => $acfItem->getData('content'),
                    'content_secondary' => $acfItem->getData('content_secondary'),
                    'category' => $acfItem->getData('category'),
                    'active' => (bool)$acfItem->getData('active')
                ];
                return $this->acfDataCache[$id];
            }
        } catch (LocalizedException $e) {
            // Log error if needed
            return null;
        }

        return null;
    }

    /**
     * Get ACF fields by category
     *
     * @param string $category
     * @return array
     */
    public function getAcfFieldsByCategory(string $category): array
    {
        try {
            $collection = $this->acfCollectionFactory->create();
            $collection->addFieldToFilter('category', $category)
                      ->addFieldToFilter('active', 1);

            $fields = [];
            foreach ($collection as $item) {
                $fields[] = [
                    'id' => (int)$item->getId(),
                    'acftype' => $item->getData('acftype'),
                    'content' => $item->getData('content'),
                    'content_secondary' => $item->getData('content_secondary'),
                    'category' => $item->getData('category'),
                    'active' => (bool)$item->getData('active')
                ];
            }
            return $fields;
        } catch (LocalizedException $e) {
            return [];
        }
    }  
    
    /**
     * Get ACF field content
     *
     * @param int $id
     * @param string $field
     * @return string|null
     */
    public function getAcfFieldContent(int $id, string $field = 'content'): ?string
    {
        $acfData = $this->getAcfField($id);
        return $acfData[$field] ?? null;
    }

    /**
     * Check if ACF field exists and is active
     *
     * @param int $id
     * @return bool
     */
    public function isAcfFieldActive(int $id): bool
    {
        $acfData = $this->getAcfField($id);
        return $acfData && $acfData['active'];
    }

    /**
     * Escape HTML content
     *
     * @param string $content
     * @return string
     */
    private function escapeHtml(string $content): string
    {
        // Si le contenu contient déjà du HTML valide, on le retourne tel quel
        // Sinon on l'escape pour la sécurité
        if (strip_tags($content) !== $content) {
            return $content; // HTML content
        }
        return htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
    }
}