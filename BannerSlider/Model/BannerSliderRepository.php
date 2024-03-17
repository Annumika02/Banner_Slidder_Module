<?php

/**
 * @category  Dotsquares
 * @package   Dotsquares_BannerSlider
 * @author    Dotsquares Team <info@dotsquares.com>
 * @copyright 2020 Dotsquares (https://www.dotsquares.com/)
 */

declare(strict_types=1);

namespace Dotsquares\BannerSlider\Model;

use Dotsquares\BannerSlider\Api\BannerSliderRepositoryInterface;
use Dotsquares\BannerSlider\Api\Data\BannerSliderInterfaceFactory;
use Dotsquares\BannerSlider\Api\Data\BannerSliderSearchResultsInterfaceFactory;
use Dotsquares\BannerSlider\Model\ResourceModel\BannerSlider as ResourceBannerSlider;
use Dotsquares\BannerSlider\Model\ResourceModel\BannerSlider\CollectionFactory as BannerSliderCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

/**
 * BannerSliderRepository
 */
class BannerSliderRepository implements BannerSliderRepositoryInterface
{

    private $collectionProcessor;

    protected $bannerSliderCollectionFactory;

    protected $dataObjectProcessor;

    protected $resource;

    protected $dataBannerSliderFactory;

    protected $extensionAttributesJoinProcessor;

    protected $extensibleDataObjectConverter;
    private $storeManager;

    protected $dataObjectHelper;

    protected $bannerSliderFactory;

    protected $searchResultsFactory;


    /**
     * @param ResourceBannerSlider $resource
     * @param BannerSliderFactory $bannerSliderFactory
     * @param BannerSliderInterfaceFactory $dataBannerSliderFactory
     * @param BannerSliderCollectionFactory $bannerSliderCollectionFactory
     * @param BannerSliderSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceBannerSlider $resource,
        BannerSliderFactory $bannerSliderFactory,
        BannerSliderInterfaceFactory $dataBannerSliderFactory,
        BannerSliderCollectionFactory $bannerSliderCollectionFactory,
        BannerSliderSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->bannerSliderFactory = $bannerSliderFactory;
        $this->bannerSliderCollectionFactory = $bannerSliderCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataBannerSliderFactory = $dataBannerSliderFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface $bannerSlider
    ) {
        $bannerSliderData = $this->extensibleDataObjectConverter->toNestedArray(
            $bannerSlider,
            [],
            \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface::class
        );

        $bannerSliderModel = $this->bannerSliderFactory->create()->setData($bannerSliderData);

        try {
            $this->resource->save($bannerSliderModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the bannerSlider: %1',
                $exception->getMessage()
            ));
        }
        return $bannerSliderModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($bannerSliderId)
    {
        $bannerSlider = $this->bannerSliderFactory->create();
        $this->resource->load($bannerSlider, $bannerSliderId);
        if (!$bannerSlider->getId()) {
            throw new NoSuchEntityException(__('BannerSlider with id "%1" does not exist.', $bannerSliderId));
        }
        return $bannerSlider->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->bannerSliderCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface::class
        );

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface $bannerSlider
    ) {
        try {
            $bannerSliderModel = $this->bannerSliderFactory->create();
            $this->resource->load($bannerSliderModel, $bannerSlider->getBannersliderId());
            $this->resource->delete($bannerSliderModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the BannerSlider: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($bannerSliderId)
    {
        return $this->delete($this->get($bannerSliderId));
    }
}
