<?php

/**
 * @category  Dotsquares
 * @package   Dotsquares_BannerSlider
 * @author    Dotsquares Team <info@dotsquares.com>
 * @copyright 2020 Dotsquares (https://www.dotsquares.com/)
 */

declare(strict_types=1);

namespace Dotsquares\BannerSlider\Controller\Adminhtml\BannerSlider;

use Magento\Framework\Exception\LocalizedException;
use Dotsquares\BannerSlider\Model\ImageUploader;

/**
 * Save
 */
class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;
    /**
     * Image uploader
     *
     * @var ImageUploader
     */
    protected $imageUploader;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        ImageUploader $imageUploader,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->imageUploader = $imageUploader;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {

            $id = $this->getRequest()->getParam('bannerslider_id');

            $model = $this->_objectManager->create(\Dotsquares\BannerSlider\Model\BannerSlider::class);
            if ($id > 0) {
                $model->load($id);
            }
            if (isset($data['icon'][0]['name']) && isset($data['icon'][0]['tmp_name'])) {
                $data['icon'] = $data['icon'][0]['name'];
                $this->imageUploader->moveFileFromTmp($data['icon']);
            } elseif (isset($data['icon'][0]['name']) && !isset($data['icon'][0]['tmp_name'])) {
                $data['icon'] = $data['icon'][0]['name'];
            } else {
                $data['icon'] = '';
            }
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Bannerslider no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $model->setData($data);


            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Bannerslider.'));
                $this->dataPersistor->clear('dotsquares_bannerslider_bannerslider');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['bannerslider_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Bannerslider.'));
            }

            $this->dataPersistor->set('dotsquares_bannerslider_bannerslider', $data);
            return $resultRedirect->setPath('*/*/edit', ['bannerslider_id' => $this->getRequest()->getParam('bannerslider_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
