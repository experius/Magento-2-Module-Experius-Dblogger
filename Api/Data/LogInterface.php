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

namespace Experius\Dblogger\Api\Data;

interface LogInterface
{
    /**
     * @var string
     */
    const MODULE = 'module';

    /**
     * @var string
     */
    const ACTION = 'action';

    /**
     * @var string
     */
    const CREATED_AT = 'created_at';

    /**
     * @var string
     */
    const LOG_ID = 'log_id';

    /**
     * @var string
     */
    const TYPE = 'type';

    /**
     * @var string
     */
    const MESSAGE = 'message';

    /**
     * Get log_id
     * @return string|null
     */
    public function getLogId();

    /**
     * Set log_id
     * @param string $log_id
     * @return Experius\Dblogger\Api\Data\LogInterface
     */
    public function setLogId($logId);

    /**
     * Get module
     * @return string|null
     */
    public function getModule();

    /**
     * Set module
     * @param string $module
     * @return Experius\Dblogger\Api\Data\LogInterface
     */
    public function setModule($module);

    /**
     * Get action
     * @return string|null
     */
    public function getAction();

    /**
     * Set action
     * @param string $action
     * @return Experius\Dblogger\Api\Data\LogInterface
     */
    public function setAction($action);

    /**
     * Get message
     * @return string|null
     */
    public function getMessage();

    /**
     * Set message
     * @param string $message
     * @return Experius\Dblogger\Api\Data\LogInterface
     */
    public function setMessage($message);

    /**
     * Get type
     * @return string|null
     */
    public function getType();

    /**
     * Set type
     * @param string $type
     * @return Experius\Dblogger\Api\Data\LogInterface
     */
    public function setType($type);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $created_at
     * @return Experius\Dblogger\Api\Data\LogInterface
     */
    public function setCreatedAt($created_at);
}
