<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Pagespeedfr\CmsAcf\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Pagespeedfr\CmsAcf\Api\AcfRepositoryInterface;
use Pagespeedfr\CmsAcf\Api\Data\AcfInterface;
use Pagespeedfr\CmsAcf\Api\Data\AcfInterfaceFactory;
use Pagespeedfr\CmsAcf\Api\Data\AcfSearchResultsInterfaceFactory;
use Pagespeedfr\CmsAcf\Model\ResourceModel\Acf as ResourceAcf;
use Pagespeedfr\CmsAcf\Model\ResourceModel\Acf\CollectionFactory as AcfCollectionFactory;

class AcfRepository implements AcfRepositoryInterface
{

    /**
     * @var ResourceAcf
     */
    protected $resource;

    /**
     * @var AcfInterfaceFactory
     */
    protected $acfFactory;

    /**
     * @var AcfCollectionFactory
     */
    protected $acfCollectionFactory;

    /**
     * @var Acf
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;


    /**
     * @param ResourceAcf $resource
     * @param AcfInterfaceFactory $acfFactory
     * @param AcfCollectionFactory $acfCollectionFactory
     * @param AcfSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceAcf $resource,
        AcfInterfaceFactory $acfFactory,
        AcfCollectionFactory $acfCollectionFactory,
        AcfSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->acfFactory = $acfFactory;
        $this->acfCollectionFactory = $acfCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(AcfInterface $acf)
    {
        try {
            $this->resource->save($acf);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the acf: %1',
                $exception->getMessage()
            ));
        }
        return $acf;
    }

    /**
     * @inheritDoc
     */
    public function get($acfId)
    {
        $acf = $this->acfFactory->create();
        $this->resource->load($acf, $acfId);
        if (!$acf->getId()) {
            throw new NoSuchEntityException(__('Acf with id "%1" does not exist.', $acfId));
        }
        return $acf;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->acfCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(AcfInterface $acf)
    {
        try {
            $acfModel = $this->acfFactory->create();
            $this->resource->load($acfModel, $acf->getAcfId());
            $this->resource->delete($acfModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Acf: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($acfId)
    {
        return $this->delete($this->get($acfId));
    }
}

