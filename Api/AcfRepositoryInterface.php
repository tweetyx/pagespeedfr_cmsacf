<?php
declare(strict_types=1);

namespace Pagespeedfr\CmsAcf\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface AcfRepositoryInterface
{

    /**
     * Save Acf
     * @param \Pagespeedfr\CmsAcf\Api\Data\AcfInterface $acf
     * @return \Pagespeedfr\CmsAcf\Api\Data\AcfInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Pagespeedfr\CmsAcf\Api\Data\AcfInterface $acf
    );

    /**
     * Retrieve Acf
     * @param string $id
     * @return \Pagespeedfr\CmsAcf\Api\Data\AcfInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($id);

    /**
     * Retrieve Acf matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Pagespeedfr\CmsAcf\Api\Data\AcfSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Acf
     * @param \Pagespeedfr\CmsAcf\Api\Data\AcfInterface $acf
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Pagespeedfr\CmsAcf\Api\Data\AcfInterface $acf
    );

    /**
     * Delete Acf by ID
     * @param string $id
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($id);
}

