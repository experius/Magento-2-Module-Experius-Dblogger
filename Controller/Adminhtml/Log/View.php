<?php
/**
 * Database logger
 * Copyright (C) 2017  Experius
 *
 * This file is part of Experius/Dblogger.
 *
 * Experius/Dblogger is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Experius\Dblogger\Controller\Adminhtml\Log;

/**
 * Class View
 * @package Experius\Dblogger\Controller\Adminhtml\Log
 */
class View extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Experius_Dblogger::top_level';

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $coreRegistry;
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
        $resultPage->setActiveMenu('Experius::experius_dblogger')
            ->addBreadcrumb(__('Experius'), __('Experius'))
            ->addBreadcrumb(__('Dblogger'), __('Dblogger'));
        return $resultPage;
    }


    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('log_id');
        $model = $this->_objectManager->create('Experius\Dblogger\Model\Log');
        
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getLogId()) {
                $this->messageManager->addError(__('This Log Message no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('experius_dblogger_log', $model);
        
        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            __('View Log Message'),
            __('View Log Message')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('View Log Message'));
        return $resultPage;
    }
}
