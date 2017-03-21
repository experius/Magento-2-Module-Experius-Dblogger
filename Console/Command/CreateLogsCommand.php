<?php 

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
        $this->setName('experius:create_logs')->setDescription('Creates test logs.');
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
		$this->logHelper->log('Experius_Dblogger', 'first', 'Test melding', 'success');
	}
	protected function second(){
		$this->logHelper->log('Experius_Dblogger', 'second', 'Test melding', 'error');
	}
	protected function third(){
		$this->logHelper->log('Experius_Dblogger', 'third', 'Test melding', 'notice');
	}
	protected function fourth(){
		$this->logHelper->log('Experius_Dblogger', 'fourth', 'Test melding', 'warning');
	}
	protected function fifth(){
		$this->logHelper->log('Experius_Dblogger', 'fifth', 'Test melding', 'exception');
	}
 
}