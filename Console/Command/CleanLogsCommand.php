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

namespace Experius\Dblogger\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CleanLogsCommand extends Command
{
    /**
     * @var \Experius\Dblogger\Cron\Log
     */
    protected $cronLog;

    /**
     * @param \Experius\Dblogger\Cron\Log $cronLog
     */
    public function __construct(\Experius\Dblogger\Cron\Log $cronLog)
    {
        $this->cronLog = $cronLog;
        parent::__construct();
    }

    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Console\Command\Command::configure()
     */
    protected function configure()
    {
        $this->setName('experius:dblogger:clean')->setDescription('Deletes logs old logs (default 30 days)');
    }

    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Console\Command\Command::execute()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->cronLog->cleanLog();
        $output->writeln('Cleaned Logs');
    }
}
