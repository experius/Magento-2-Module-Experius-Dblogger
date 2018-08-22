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

namespace Experius\Dblogger\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface LogRepositoryInterface
{
    /**
     * Save Log
     * @param \Experius\Dblogger\Api\Data\LogInterface $log
     * @return \Experius\Dblogger\Api\Data\LogInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Experius\Dblogger\Api\Data\LogInterface $log
    );

    /**
     * Retrieve Log
     * @param string $logId
     * @return \Experius\Dblogger\Api\Data\LogInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($logId);

    /**
     * Retrieve Log matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Experius\Dblogger\Api\Data\LogSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Log
     * @param \Experius\Dblogger\Api\Data\LogInterface $log
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Experius\Dblogger\Api\Data\LogInterface $log
    );

    /**
     * Delete Log by ID
     * @param string $logId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($logId);
}
