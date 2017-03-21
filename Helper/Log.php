<?php

namespace Experius\Dblogger\Helper;

class Log {
	
	protected $logFactory;
	protected $isEnabled;
	protected $dateTimeLib;
	protected $logger;
	protected $scopeConfig;

    public function __construct(\Experius\Dblogger\Model\LogFactory $logFactory, 
    							\Magento\Framework\Stdlib\DateTime\DateTime $dateTimeLib,
    							\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
								\Psr\Log\LoggerInterface $logger)
    {
        $this->logFactory = $logFactory;
		$this->dateTimeLib = $dateTimeLib;
		$this->scopeConfig = $scopeConfig;
		$this->logger = $logger;
		$this->isEnabled = $this->scopeConfig->getValue('dev/dblogger/is_enabled', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
	
	public function log($module, $action, $message, $type) {
		if($this->isEnabled) {
			$this->logFactory->create()
	        ->setModule($module)
	        ->setAction($action)
	        ->setMessage($message)
	        ->setType(ucfirst(strtolower($type)))
	        ->setCreatedAt($this->dateTimeLib->gmtDate())
			->save();
			return;
		}
		
		$this->logger->debug(strtolower($module) . '-' . strtolower($type) . '[' . $action . ']: ' . $message);
	}
	
	public function cleanLog($numberOfDays){
		$collection = $this->logFactory->getCollection();
		$collection->addFieldToFilter('created_at', array('to' => $this->dateTimeLib->date('Y-m-d H:i:s', strtotime('-' . $numberOfDays . ' day'))));
		foreach($collection as $log){
			$log->delete();
		} 
	}
}