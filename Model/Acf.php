<?php

declare(strict_types=1);

namespace Pagespeedfr\CmsAcf\Model;

use Magento\Framework\Model\AbstractModel;
use Pagespeedfr\CmsAcf\Api\Data\AcfInterface;

class Acf extends AbstractModel implements AcfInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Pagespeedfr\CmsAcf\Model\ResourceModel\Acf::class);
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * @inheritDoc
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * @inheritDoc
     */
    public function getContentSecondary()
    {
        return $this->getData(self::CONTENTSECONDARY);
    }

    /**
     * @inheritDoc
     */
    public function setContentSecondary($contentSecondary)
    {
        return $this->setData(self::CONTENTSECONDARY, $contentSecondary);
    } 

    /**
     * @inheritDoc
     */
    public function getAcftype()
    {
        return $this->getData(self::ACFTYPE);
    }

    /**
     * @inheritDoc
     */
    public function setAcftype($acftype)
    {
        return $this->setData(self::ACFTYPE, $acftype);
    }

    /**
     * @inheritDoc
     */
    public function getActive()
    {
        return $this->getData(self::ACTIVE);
    }

    /**
     * @inheritDoc
     */
    public function setActive($active)
    {
        return $this->setData(self::ACTIVE, $active);
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * @inheritDoc
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }	

    /**
     * @inheritDoc
     */
    public function getCategory()
    {
        return $this->getData(self::CATEGORY);
    }

    /**
     * @inheritDoc
     */
    public function setCategory($category)
    {
        return $this->setData(self::CATEGORY, $category);
    }	  
 	
}

