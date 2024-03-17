<?php

/**
 * @category  Dotsquares
 * @package   Dotsquares_BannerSlider
 * @author    Dotsquares Team <info@dotsquares.com>
 * @copyright 2020 Dotsquares (https://www.dotsquares.com/)
 */

declare(strict_types=1);

namespace Dotsquares\BannerSlider\Controller\Adminhtml;

/**
 * BannerSlider
 */
abstract class BannerSlider extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Dotsquares_BannerSlider::top_level';
    protected $_coreRegistry;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Dotsquares'), __('Dotsquares'))
            ->addBreadcrumb(__('Bannerslider'), __('Bannerslider'));
        return $resultPage;
    }
}
