<?php

/**
 *  A Magento 2 module named Experius/DBlogger
 *  Copyright (C) 2017 Experius
 *
 *  This file is part of Experius/DBlogger
 *
 *  Experius/DBlogger is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace Experius\Dblogger\Helper;

class Log
{

    protected $logFactory;
    protected $isEnabled;
    protected $dateTimeLib;
    protected $logger;
    protected $scopeConfig;
    protected $timeZoneLib;
    protected $logRepository;
    protected $searchCriteriaBuilder;

    public function __construct(\Experius\Dblogger\Model\LogFactory $logFactory,
                                \Magento\Framework\Stdlib\DateTime\DateTime $dateTimeLib,
                                \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
                                \Psr\Log\LoggerInterface $logger,
                                \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timeZoneLib,
                                \Experius\Dblogger\Api\LogRepositoryInterface $logRepository,
                                \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder)
    {
        $this->logFactory = $logFactory;
        $this->dateTimeLib = $dateTimeLib;
        $this->scopeConfig = $scopeConfig;
        $this->logger = $logger;
        $this->isEnabled = $this->scopeConfig->getValue('dev/dblogger/is_enabled', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        $this->logRepository = $logRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function log($module, $action, $message, $type)
    {
        if ($this->isEnabled) {
            $this->logFactory->create()
                ->setModule($module)
                ->setAction($action)
                ->setMessage($message)
                ->setType(ucfirst(strtolower($type)))
                ->setCreatedAt($this->dateTimeLib->date())
                ->save();
            return;
        }

        $this->logger->debug(strtolower($module) . '-' . strtolower($type) . '[' . $action . ']: ' . $message);
    }

    public function cleanLog($numberOfDays)
    {
        $cleanDate = $this->dateTimeLib->date('Y-m-d H:i:s', strtotime('-' . $numberOfDays . ' day'));
        $searchCriteria = $this->searchCriteriaBuilder->addFilter('created_at', $cleanDate, 'lt')->create();
        $searchResults = $this->logRepository->getList($searchCriteria);
        foreach ($searchResults->getItems() as $log) {
            $this->logRepository->deleteById($log['log_id']);
        }
    }
}