<?php

/**
 * @category  Dotsquares
 * @package   Dotsquares_BannerSlider
 * @author    Dotsquares Team <info@dotsquares.com>
 * @copyright 2020 Dotsquares (https://www.dotsquares.com/)
 */

namespace Dotsquares\BannerSlider\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;

/**
 * Data helper
 */
class Data extends AbstractHelper
{
    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(\Magento\Framework\App\Helper\Context $context)
    {
        $this->scopeConfig = $context->getScopeConfig();
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->scopeConfig->getValue("dotsquares_bannerSlider/general/enable", \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * @param \Magento\Store\Model\Store|int|string $fieldId
     * @return string|null
     */
    public function getConfig($fieldId)
    {
        return $this->scopeConfig->getValue("dotsquares_bannerSlider/banconfig/" . $fieldId, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
