<?php

/**
 * @category  Dotsquares
 * @package   Dotsquares_BannerSlider
 * @author    Dotsquares Team <info@dotsquares.com>
 * @copyright 2020 Dotsquares (https://www.dotsquares.com/)
 */

declare(strict_types=1);

namespace Dotsquares\BannerSlider\Ui\Component\Listing\Column;

/**
 * BannerSlider Action
 */
class BannerSliderActions extends \Magento\Ui\Component\Listing\Columns\Column
{

    protected $urlBuilder;
    const URL_PATH_DETAILS = 'dotsquares_bannerslider/bannerslider/details';
    const URL_PATH_EDIT = 'dotsquares_bannerslider/bannerslider/edit';
    const URL_PATH_DELETE = 'dotsquares_bannerslider/bannerslider/delete';

    /**
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param  array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['bannerslider_id'])) {
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_EDIT,
                                [
                                    'bannerslider_id' => $item['bannerslider_id']
                                ]
                            ),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE,
                                [
                                    'bannerslider_id' => $item['bannerslider_id']
                                ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete "${ $.$data.title }"'),
                                'message' => __('Are you sure you wan\'t to delete a "${ $.$data.title }" record?')
                            ]
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }
}
