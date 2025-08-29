<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Pagespeedfr\CmsAcf\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Acf extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('hyva_acf', 'id');
    }
}

