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

namespace Experius\Dblogger\Model;

use Experius\Dblogger\Model\ResourceModel\Log\CollectionFactory as LogCollectionFactory;
use Experius\Dblogger\Api\Data\LogSearchResultsInterfaceFactory;
use Magento\Framework\Reflection\DataObjectProcessor;
use Experius\Dblogger\Model\ResourceModel\Log as ResourceLog;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Experius\Dblogger\Api\LogRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Experius\Dblogger\Api\Data\LogInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Store\Model\StoreManagerInterface;

class LogRepository implements LogRepositoryInterface
{

    protected $dataObjectHelper;

    protected $LogCollectionFactory;

    protected $searchResultsFactory;

    protected $dataLogFactory;

    protected $LogFactory;

    private $storeManager;

    protected $resource;

    protected $dataObjectProcessor;

    protected $logFactory;
    
    protected $logCollectionFactory;

    /**
     * @param ResourceLog $resource
     * @param LogFactory $logFactory
     * @param LogInterfaceFactory $dataLogFactory
     * @param LogCollectionFactory $logCollectionFactory
     * @param LogSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceLog $resource,
        LogFactory $logFactory,
        LogInterfaceFactory $dataLogFactory,
        LogCollectionFactory $logCollectionFactory,
        LogSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->logFactory = $logFactory;
        $this->logCollectionFactory = $logCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataLogFactory = $dataLogFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Experius\Dblogger\Api\Data\LogInterface $log
    ) {
        /* if (empty($log->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $log->setStoreId($storeId);
        } */
        try {
            $this->resource->save($log);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the log: %1',
                $exception->getMessage()
            ));
        }
        return $log;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($logId)
    {
        $log = $this->logFactory->create();
        $log->load($logId);
        if (!$log->getLogId()) {
            throw new NoSuchEntityException(__('Log with id "%1" does not exist.', $logId));
        }
        return $log;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $collection = $this->logCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        $items = [];
        
        foreach ($collection as $logModel) {
            $logData = $this->dataLogFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $logData,
                $logModel->getData(),
                'Experius\Dblogger\Api\Data\LogInterface'
            );
            $items[] = $this->dataObjectProcessor->buildOutputDataArray(
                $logData,
                'Experius\Dblogger\Api\Data\LogInterface'
            );
        }
        $searchResults->setItems($items);
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Experius\Dblogger\Api\Data\LogInterface $log
    ) {
        try {
            $this->resource->delete($log);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Log: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($logId)
    {
        return $this->delete($this->getById($logId));
    }
}
