<?php
/**
 * @category  Dotsquares
 * @package   Dotsquares_BannerSlider
 * @author    Dotsquares Team <info@dotsquares.com>
 * @copyright 2020 Dotsquares (https://www.dotsquares.com/)
 */

declare(strict_types=1);

namespace Dotsquares\BannerSlider\Model\Data;

use Dotsquares\BannerSlider\Api\Data\BannerSliderInterface;

/**
 * BannerSlider Model
 */
class BannerSlider extends \Magento\Framework\Api\AbstractExtensibleObject implements BannerSliderInterface
{

    /**
     * Get bannerslider_id
     * @return string|null
     */
    public function getBannersliderId()
    {
        return $this->_get(self::BANNERSLIDER_ID);
    }

    /**
     * Set bannerslider_id
     * @param string $bannersliderId
     * @return \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface
     */
    public function setBannersliderId($bannersliderId)
    {
        return $this->setData(self::BANNERSLIDER_ID, $bannersliderId);
    }

    /**
     * Get shorting
     * @return string|null
     */
    public function getShorting()
    {
        return $this->_get(self::SHORTING);
    }

    /**
     * Set shorting
     * @param string $shorting
     * @return \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface
     */
    public function setShorting($shorting)
    {
        return $this->setData(self::SHORTING, $shorting);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Dotsquares\BannerSlider\Api\Data\BannerSliderExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Dotsquares\BannerSlider\Api\Data\BannerSliderExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Dotsquares\BannerSlider\Api\Data\BannerSliderExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get titel
     * @return string|null
     */
    public function getTitel()
    {
        return $this->_get(self::TITEL);
    }

    /**
     * Set titel
     * @param string $titel
     * @return \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface
     */
    public function setTitel($titel)
    {
        return $this->setData(self::TITEL, $titel);
    }

    /**
     * Get discription
     * @return string|null
     */
    public function getDiscription()
    {
        return $this->_get(self::DISCRIPTION);
    }

    /**
     * Set discription
     * @param string $discription
     * @return \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface
     */
    public function setDiscription($discription)
    {
        return $this->setData(self::DISCRIPTION, $discription);
    }

    /**
     * Get buttontitel
     * @return string|null
     */
    public function getButtontitel()
    {
        return $this->_get(self::BUTTONTITEL);
    }

    /**
     * Set buttontitel
     * @param string $buttontitel
     * @return \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface
     */
    public function setButtontitel($buttontitel)
    {
        return $this->setData(self::BUTTONTITEL, $buttontitel);
    }

    /**
     * Get buttonurl
     * @return string|null
     */
    public function getButtonurl()
    {
        return $this->_get(self::BUTTONURL);
    }

    /**
     * Set buttonurl
     * @param string $buttonurl
     * @return \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface
     */
    public function setButtonurl($buttonurl)
    {
        return $this->setData(self::BUTTONURL, $buttonurl);
    }

    /**
     * Get status
     * @return string|null
     */
    public function getStatus()
    {
        return $this->_get(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     * @return \Dotsquares\BannerSlider\Api\Data\BannerSliderInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}

