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

use Experius\Dblogger\Api\Data\LogInterface;

class Log extends \Magento\Framework\Model\AbstractModel implements LogInterface
{

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'experius_dblogger_log';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Experius\Dblogger\Model\ResourceModel\Log');
    }

    /**
     * Get log_id
     * @return string
     */
    public function getLogId()
    {
        return $this->getData(self::LOG_ID);
    }

    /**
     * Set log_id
     * @param string $logId
     * @return Experius\Dblogger\Api\Data\LogInterface
     */
    public function setLogId($logId)
    {
        return $this->setData(self::LOG_ID, $logId);
    }

    /**
     * Get module
     * @return string
     */
    public function getModule()
    {
        return $this->getData(self::MODULE);
    }

    /**
     * Set module
     * @param string $module
     * @return Experius\Dblogger\Api\Data\LogInterface
     */
    public function setModule($module)
    {
        return $this->setData(self::MODULE, $module);
    }

    /**
     * Get action
     * @return string
     */
    public function getAction()
    {
        return $this->getData(self::ACTION);
    }

    /**
     * Set action
     * @param string $action
     * @return Experius\Dblogger\Api\Data\LogInterface
     */
    public function setAction($action)
    {
        return $this->setData(self::ACTION, $action);
    }

    /**
     * Get message
     * @return string
     */
    public function getMessage()
    {
        return $this->getData(self::MESSAGE);
    }

    /**
     * Set message
     * @param string $message
     * @return Experius\Dblogger\Api\Data\LogInterface
     */
    public function setMessage($message)
    {
        return $this->setData(self::MESSAGE, $message);
    }

	 /**
     * Get type
     * @return string
     */
    public function getType()
    {
        return $this->getData(self::TYPE);
    }

    /**
     * Set type
     * @param string $type
     * @return Experius\Dblogger\Api\Data\LogInterface
     */
    public function setType($type)
    {
        return $this->setData(self::TYPE, $type);
    }

    /**
     * Get context
     * @return string
     */
    public function getContext()
    {
        return $this->getData(self::CONTEXT);
    }

    /**
     * Set context
     * @param string $context
     * @return Experius\Dblogger\Api\Data\LogInterface
     */
    public function setContext($context)
    {
        return $this->setData(self::CONTEXT, $context);
    }

    /**
     * Get created_at
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $created_at
     * @return Experius\Dblogger\Api\Data\LogInterface
     */
    public function setCreatedAt($created_at)
    {
        return $this->setData(self::CREATED_AT, $created_at);
    }
}
