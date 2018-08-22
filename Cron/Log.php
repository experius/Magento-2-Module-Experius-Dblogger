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

namespace Experius\Dblogger\Cron;

class Log
{
    /**
     * @var \Experius\Dblogger\Helper\Log
     */
    protected $logHelper;

    /**
     * @var integer
     */
    protected $numberOfDays;

    /**
     * @param \Experius\Dblogger\Helper\Log $logHelper
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct (
        \Experius\Dblogger\Helper\Log $logHelper,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->logHelper = $logHelper;

        $numberOfDays = $scopeConfig->getValue('dev/dblogger/days', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if(!is_numeric($numberOfDays)) {
            throw new \InvalidArgumentException('Dblogger constructor $numberOfDays function only accepts integers. Input was: '. $numberOfDays);
        }
        $this->numberOfDays = $numberOfDays;
    }

    /**
     * Execute the cron
     *
     * @return void
     */
    public function cleanLog()
    {
        $this->logHelper->cleanLog($this->numberOfDays);
    }
}
