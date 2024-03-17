<?php

/**
 * @category  Dotsquares
 * @package   Dotsquares_BannerSlider
 * @author    Dotsquares Team <info@dotsquares.com>
 * @copyright 2020 Dotsquares (https://www.dotsquares.com/)
 */

declare(strict_types=1);

namespace Dotsquares\BannerSlider\Block\Index;

/**
 * Index
 */
class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Dotsquares\BannerSlider\Model\BannerSlider
     */
    protected $bannerSlider;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Cms\Model\Template\FilterProvider
     */
    protected $_filterProvider;



    /**
     * @var \Dotsquares\BannerSlider\Helper\Data
     */
    protected $_helper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Dotsquares\BannerSlider\Model\BannerSlider $bannerSlider
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Cms\Model\Template\FilterProvider $filterProvider
     * @param \Dotsquares\BannerSlider\Helper\Data $helper
     * @param array $data
     */

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Dotsquares\BannerSlider\Model\ResourceModel\BannerSlider\CollectionFactory $bannerSliderresource,
        \Dotsquares\BannerSlider\Model\BannerSlider $bannerSlider,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
        \Dotsquares\BannerSlider\Helper\Data $helper,
        $data = []

    ) {
        $this->bannerSliderresource = $bannerSliderresource;
        $this->bannerSlider = $bannerSlider;
        $this->_storeManager = $storeManager;
        $this->_filterProvider = $filterProvider;
        $this->_helper = $helper;
        parent::__construct($context, $data);
    }
    /**
     * Get banner collection
     * @return object
     */
    public function getActiveBanners()
    {
        return $this->bannerSliderresource->create()->addFieldToFilter("status", ["eq" => 1])->addFieldToFilter("type", ["eq" => "bannerslider"])
            ->load();
    }
    /**
     * Get Image collection
     * @return object
     */
    public function getActiveImages()
    {
        $imageId=  $this->getImageId();
        return $this->bannerSliderresource->create()->addFieldToFilter("status", ["eq" => 1])->addFieldToFilter("type", ["eq" => "image"])
         ->addFieldToFilter("bannerslider_id", ["eq" => $imageId])
            ->load();
    }

    /**
     * Get media url
     * @return string
     */
    public function getMediaUrl()
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        return  $mediaUrl . 'dotsquaresbannerslider/feature/';
    }

    /**
     * Get banner image path
     * @return string
     */
    public function getBannnerImageSrc($imagepath = "")
    {
        if ($imagepath == "") {
            return "";
        }
        return $this->getMediaUrl() . $imagepath;
    }

    /**
     * @return string
     */
    public function getContent($content)
    {
        return $this->_filterProvider->getBlockFilter()->filter($content);
    }

    /**
     * @return object
     */
    public function getHelper()
    {
       // echo "==test";
        return $this->_helper;
    }
}
