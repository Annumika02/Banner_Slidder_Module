<?php

/**
 * @category  Dotsquares
 * @package   Dotsquares_BannerSlider
 * @author    Dotsquares Team <info@dotsquares.com>
 * @copyright 2020 Dotsquares (https://www.dotsquares.com/)
 */

declare(strict_types=1);

namespace Dotsquares\BannerSlider\Api\Data;

/**
 * Banner Slider Interface
 */
interface BannerSliderSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get BannerSlider list.
     * @return \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface[]
     */
    public function getItems();

    /**
     * Set shorting list.
     * @param \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
