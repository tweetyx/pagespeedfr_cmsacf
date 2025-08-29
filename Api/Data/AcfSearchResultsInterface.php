<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Pagespeedfr\CmsAcf\Api\Data;

interface AcfSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Acf list.
     * @return \Pagespeedfr\CmsAcf\Api\Data\AcfInterface[]
     */
    public function getItems();

    /**
     * Set code list.
     * @param \Pagespeedfr\CmsAcf\Api\Data\AcfInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

