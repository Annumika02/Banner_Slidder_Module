<?php
/**
 * @category  Dotsquares
 * @package   Dotsquares_BannerSlider
 * @author    Dotsquares Team <info@dotsquares.com>
 * @copyright 2020 Dotsquares (https://www.dotsquares.com/)
 */

declare(strict_types=1);

namespace Dotsquares\BannerSlider\Model\BannerSlider;

use Dotsquares\BannerSlider\Model\ResourceModel\BannerSlider\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    protected $collection;

    protected $dataPersistor;

    protected $loadedData;

    protected $_storeManager;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->_storeManager = $storeManager;
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $data=$model->getData();
            if (isset($data['icon'])) {
                $name = $data['icon'];
                unset($data['icon']);
                $data['icon'][0] = [
                    'name' => $name,
                    'url' => $mediaUrl.'dotsquaresbannerslider/feature/'.$name
                ];
            }
            $this->loadedData[$model->getId()] = $data;
        }
        $data = $this->dataPersistor->get('dotsquares_bannerslider_bannerslider');

        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('dotsquares_bannerslider_bannerslider');
        }

        return $this->loadedData;
    }
}

