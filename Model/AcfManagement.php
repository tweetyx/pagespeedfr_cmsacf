<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Pagespeedfr\CmsAcf\Model;

class AcfManagement implements \Pagespeedfr\CmsAcf\Api\AcfManagementInterface
{

    /**
     * {@inheritdoc}
     */
    public function getAcf($param)
    {
        return 'hello api GET return the $param ' . $param;
    }
}

