<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Pagespeedfr\CmsAcf\Api;

interface AcfManagementInterface
{

    /**
     * GET for Acf api
     * @param string $param
     * @return string
     */
    public function getAcf($param);
}

