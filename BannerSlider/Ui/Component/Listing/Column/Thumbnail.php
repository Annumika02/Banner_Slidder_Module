<?php

/**
 * @category  Dotsquares
 * @package   Dotsquares_BannerSlider
 * @author    Dotsquares Team <info@dotsquares.com>
 * @copyright 2020 Dotsquares (https://www.dotsquares.com/)
 */

namespace Dotsquares\BannerSlider\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Thumbnail
 */
class Thumbnail extends \Magento\Ui\Component\Listing\Columns\Column
{
    const NAME = 'image';
    const ALT_FIELD = 'name';
    protected $storeManager;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param \Magento\Catalog\Helper\Image $imageHelper
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManager,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->_storeManager = $storeManager;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

            foreach ($dataSource['data']['items'] as &$item) {
                if ($item['icon']) {
                    $item[$fieldName . '_src'] = $mediaUrl . 'dotsquaresbannerslider/feature/' . $item['icon'];
                    $item[$fieldName . '_alt'] = $item['title'];
                    $item[$fieldName . '_orig_src'] = $mediaUrl . 'dotsquaresbannerslider/feature/' . $item['icon'];
                } else {
                    // please place your placeholder image at pub/media/dotsquares/customslider/placeholder/placeholder.jpg
                    $item[$fieldName . '_src'] = $mediaUrl . 'dotsquares/dotsquaresbannerslider/placeholder/placeholder.jpg';
                    $item[$fieldName . '_alt'] = 'Place Holder';
                    $item[$fieldName . '_orig_src'] = $mediaUrl . 'dotsquares/dotsquaresbannerslider/placeholder/placeholder.jpg';
                }
            }
        }

        return $dataSource;
    }
}
