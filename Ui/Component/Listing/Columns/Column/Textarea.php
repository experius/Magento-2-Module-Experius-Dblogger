<?php

namespace Experius\Dblogger\Ui\Component\Listing\Columns\Column;

/**
 * Class Info
 * @package Experius\Dblogger\Ui\Component\Listing\Columns\Column
 */
class Textarea extends \Magento\Ui\Component\Listing\Columns\Column
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
                    $item[$fieldName] = '<pre style="max-height: 200px; max-width: 500px; word-wrap:break-word;"><code><textarea style="min-height: 100px; width: 100%; background-color: inherit; border:none;" disabled>'.$item[$fieldName].'</textarea></code></pre>';
                }
            }
        }

        return $dataSource;
    }

}
