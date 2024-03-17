<?php

/**
 * @category  Dotsquares
 * @package   Dotsquares_BannerSlider
 * @author    Dotsquares Team <info@dotsquares.com>
 * @copyright 2020 Dotsquares (https://www.dotsquares.com/)
 */

declare(strict_types=1);

namespace Dotsquares\BannerSlider\Model\ResourceModel;

/**
 * BannerSlider ResourceModel
 */
class BannerSlider extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('dotsquares_bannerslider_bannerslider', 'bannerslider_id');
    }
}
