<?php

/**
 * @category  Dotsquares
 * @package   Dotsquares_BannerSlider
 * @author    Dotsquares Team <info@Dotsquares.com>
 * @copyright 2020 Dotsquares (https://www.Dotsquares.com/)
 */

declare(strict_types=1);

namespace Dotsquares\BannerSlider\Model;

use Dotsquares\BannerSlider\Api\Data\BannerSliderInterface;
use Dotsquares\BannerSlider\Api\Data\BannerSliderInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

/**
 * BannerSlider FactoryClass
 */
class BannerSlider extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $bannersliderDataFactory;

    protected $_eventPrefix = 'dotsquares_bannerslider_bannerslider';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param BannerSliderInterfaceFactory $bannersliderDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Dotsquares\BannerSlider\Model\ResourceModel\BannerSlider $resource
     * @param \Dotsquares\BannerSlider\Model\ResourceModel\BannerSlider\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        BannerSliderInterfaceFactory $bannersliderDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Dotsquares\BannerSlider\Model\ResourceModel\BannerSlider $resource,
        \Dotsquares\BannerSlider\Model\ResourceModel\BannerSlider\Collection $resourceCollection,
        array $data = []
    ) {
        $this->bannersliderDataFactory = $bannersliderDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve bannerslider model with bannerslider data
     * @return BannerSliderInterface
     */
    public function getDataModel()
    {
        $bannersliderData = $this->getData();

        $bannersliderDataObject = $this->bannersliderDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $bannersliderDataObject,
            $bannersliderData,
            BannerSliderInterface::class
        );

        return $bannersliderDataObject;
    }
}
