<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Pagespeedfr\CmsAcf\Api\Data;

interface AcfInterface
{

    const ID = 'id';
    const CONTENTSECONDARY = 'content_secondary';
    const ACFTYPE = 'acftype';
    const ACTIVE = 'active';
    const CONTENT = 'content';
    const CATEGORY = 'category';

    /**
     * Get id
     * @return string|null
     */
    public function getId();

    /**
     * Set id
     * @param string $id
     * @return \Pagespeedfr\CmsAcf\Acf\Api\Data\AcfInterface
     */
    public function setId($id);

    /**
     * Get content_secondary
     * @return string|null
     */
    public function getContentSecondary();

    /**
     * Set content_secondary
     * @param string $contentSecondary
     * @return \Pagespeedfr\CmsAcf\Acf\Api\Data\AcfInterface
     */
    public function setContentSecondary($contentSecondary);
	
    /**
     * Get acftype
     * @return string|null
     */
    public function getAcftype();

    /**
     * Set acftype
     * @param string $acftype
     * @return \Pagespeedfr\CmsAcf\Acf\Api\Data\AcfInterface
     */
    public function setAcftype($acftype);
	
    /**
     * Get active
     * @return boolean|null
     */
    public function getActive();

    /**
     * Set active
     * @param boolean $active
     * @return \Pagespeedfr\CmsAcf\Acf\Api\Data\AcfInterface
     */
    public function setActive($active);
	
    /**
     * Get content
     * @return string|null
     */
    public function getContent();

    /**
     * Set content
     * @param string $content
     * @return \Pagespeedfr\CmsAcf\Acf\Api\Data\AcfInterface
     */
    public function setContent($content);
	
    /**
     * Get category
     * @return string|null
     */
    public function getCategory();

    /**
     * Set category
     * @param string $category
     * @return \Pagespeedfr\CmsAcf\Acf\Api\Data\AcfInterface
     */
    public function setCategory($category);	
}

