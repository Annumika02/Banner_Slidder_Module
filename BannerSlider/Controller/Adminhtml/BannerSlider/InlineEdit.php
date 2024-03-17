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
 * Inline Edit
 */
class InlineEdit extends \Magento\Backend\App\Action
{

    protected $jsonFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param \Dotsquares\BannerSlider\Model\ResourceModel\BannerSlider $bannerSliderresource,

     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Dotsquares\BannerSlider\Model\ResourceModel\BannerSlider $bannerSliderresource,
        \Dotsquares\BannerSlider\Model\BannerSlider $bannerSlider,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->bannerSliderresource = $bannerSliderresource;
        $this->bannerSlider = $bannerSlider;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * Inline edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $modelid) {
                    $bannersliderModel = $this->bannerSlider->create();
                    $this->bannerSliderresource->load($bannersliderModel, $modelid);
                    try {
                        $bannersliderModel = $this->bannerSlider->create()->setData(array_merge($bannersliderModel->getData(), $postItems[$modelid]));
                        $this->resource->save($bannersliderModel);
                    } catch (\Exception $e) {
                        $messages[] = "[Bannerslider ID: {$modelid}]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
