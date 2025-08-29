<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Pagespeedfr\CmsAcf\Model\ResourceModel\Acf;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Pagespeedfr\CmsAcf\Model\Acf::class,
            \Pagespeedfr\CmsAcf\Model\ResourceModel\Acf::class
        );
    }
}

