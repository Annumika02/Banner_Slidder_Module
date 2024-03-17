<?php

/**
 * @category  Dotsquares
 * @package   Dotsquares_BannerSlider
 * @author    Dotsquares Team <info@dotsquares.com>
 * @copyright 2020 Dotsquares (https://www.dotsquares.com/)
 */

declare(strict_types=1);

namespace Dotsquares\BannerSlider\Api;

/**
 * Banner Slider Interface
 */
interface BannerSliderRepositoryInterface
{

    /**
     * Save BannerSlider
     * @param \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface $bannerSlider
     * @return \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface $bannerSlider
    );

    /**
     * Retrieve BannerSlider
     * @param string $bannersliderId
     * @return \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($bannersliderId);

    /**
     * Retrieve BannerSlider matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Dotsquares\BannerSlider\Api\Data\BannerSliderSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete BannerSlider
     * @param \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface $bannerSlider
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface $bannerSlider
    );

    /**
     * Delete BannerSlider by ID
     * @param string $bannersliderId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($bannersliderId);
}
