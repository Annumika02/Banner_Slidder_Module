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
interface BannerSliderInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const BUTTONTITEL = 'buttontitel';
    const SHORTING = 'shorting';
    const BANNERSLIDER_ID = 'bannerslider_id';
    const STATUS = 'status';
    const BUTTONURL = 'buttonurl';
    const TITEL = 'titel';
    const DISCRIPTION = 'discription';

    /**
     * Get bannerslider_id
     * @return string|null
     */
    public function getBannersliderId();

    /**
     * Set bannerslider_id
     * @param string $bannersliderId
     * @return \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface
     */
    public function setBannersliderId($bannersliderId);

    /**
     * Get shorting
     * @return string|null
     */
    public function getShorting();

    /**
     * Set shorting
     * @param string $shorting
     * @return \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface
     */
    public function setShorting($shorting);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Dotsquares\BannerSlider\Api\Data\BannerSliderExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Dotsquares\BannerSlider\Api\Data\BannerSliderExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Dotsquares\BannerSlider\Api\Data\BannerSliderExtensionInterface $extensionAttributes
    );

    /**
     * Get titel
     * @return string|null
     */
    public function getTitel();

    /**
     * Set titel
     * @param string $titel
     * @return \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface
     */
    public function setTitel($titel);

    /**
     * Get discription
     * @return string|null
     */
    public function getDiscription();

    /**
     * Set discription
     * @param string $discription
     * @return \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface
     */
    public function setDiscription($discription);

    /**
     * Get buttontitel
     * @return string|null
     */
    public function getButtontitel();

    /**
     * Set buttontitel
     * @param string $buttontitel
     * @return \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface
     */
    public function setButtontitel($buttontitel);

    /**
     * Get buttonurl
     * @return string|null
     */
    public function getButtonurl();

    /**
     * Set buttonurl
     * @param string $buttonurl
     * @return \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface
     */
    public function setButtonurl($buttonurl);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface
     */
    public function setStatus($status);
}
