<?php

/**
 * @category  Dotsquares
 * @package   Dotsquares_BannerSlider
 * @author    Dotsquares Team <info@dotsquares.com>
 * @copyright 2020 Dotsquares (https://www.dotsquares.com/)
 */

declare(strict_types=1);

namespace Dotsquares\BannerSlider\Controller\Adminhtml\BannerSlider;

/**
 * Edit
 */
class Edit extends \Dotsquares\BannerSlider\Controller\Adminhtml\BannerSlider
{

    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('bannerslider_id');
        $model = $this->_objectManager->create(\Dotsquares\BannerSlider\Model\BannerSlider::class);

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Bannerslider no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Bannerslider') : __('New Bannerslider'),
            $id ? __('Edit Bannerslider') : __('New Bannerslider')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Bannersliders'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Bannerslider %1', $model->getId()) : __('New Bannerslider'));
        return $resultPage;
    }
}
