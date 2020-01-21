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
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateLogsCommand extends Command
{
	protected $loghelper;

 	public function __construct( \Experius\Dblogger\Helper\Log $logHelper)
	{
		$this->logHelper = $logHelper;
		parent::__construct();
	}

    protected function configure()
    {
        $this->setName('experius:dblogger:create')->setDescription('Creates test logs.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	$this->first();
		$this->second();
		$this->third();
		$this->fourth();
		$this->fifth();
        $output->writeln('Created Logs');
    }

	protected function first(){
		$this->logHelper->log('Experius_Dblogger', 'first', 'Test melding', 'success', 'context');
	}
	protected function second(){
		$this->logHelper->log('Experius_Dblogger', 'second', 'Test melding', 'error', 'context');
	}
	protected function third(){
		$this->logHelper->log('Experius_Dblogger', 'third', 'Test melding', 'notice', 'context');
	}
	protected function fourth(){
		$this->logHelper->log('Experius_Dblogger', 'fourth', 'Test melding', 'warning', 'context');
	}
	protected function fifth(){
		$this->logHelper->log('Experius_Dblogger', 'fifth', 'Test melding', 'exception', 'context');
	}

}
