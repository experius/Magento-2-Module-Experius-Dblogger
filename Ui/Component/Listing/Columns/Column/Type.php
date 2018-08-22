<?php

namespace Experius\Dblogger\Ui\Component\Listing\Columns\Column;

/**
 * Class Type
 * @package Experius\Dblogger\Ui\Component\Listing\Columns\Column
 */
class Type extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
	public function prepareDataSource(array $dataSource)
    {
		if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                if(!empty($item[$fieldName])){
                    $stateCode = $item[$fieldName];
			
					$statusLabels = array (
						'Notice'					=> '#00BFFF', //light blue
						'Success' 					=> '#3CB861', //green
						'Error' 					=> '#E33434', //red
						'Warning'					=> '#FF9C00', //orange
						'Exception'					=> '#E33434', //red
					);	
					
			        if(isset($statusLabels[$stateCode])){
			            $item[$fieldName] = '<p style="display:block; margin-top:5px; text-align:center;"><span style="display:block; background:'.$statusLabels[$stateCode].'; padding:5px 10px; border-radius:100px; color:#fff; font-weight:bold;">'.$stateCode.'</span></p>';
			        }else{
			            $item[$fieldName] = '<p style="display:block; margin-top:5px; text-align:center;"><span style="display:block; background:#A4A4A4; padding:5px 10px; border-radius:100px; color:#fff; font-weight:bold;">'.$stateCode.'</span></p>';
			        }   
                }
            }
        }
              
        return $dataSource;
    }

}
