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

namespace Experius\Dblogger\Ui\Component\Listing\Columns\Column;

class Type extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * {@inheritDoc}
     * @see \Magento\Ui\Component\AbstractComponent::prepareDataSource()
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                if (!empty($item[$fieldName])) {
                    $stateCode = $item[$fieldName];

                    $statusLabels = array(
                        'Notice' => '#00BFFF', //light blue
                        'Success' => '#3CB861', //green
                        'Error' => '#E33434', //red
                        'Warning' => '#FF9C00', //orange
                        'Exception' => '#E33434', //red
                    );

                    if (isset($statusLabels[$stateCode])) {
                        $item[$fieldName] = '<p style="display:block; margin-top:5px; text-align:center;"><span style="display:block; background:'.$statusLabels[$stateCode].'; padding:5px 10px; border-radius:100px; color:#fff; font-weight:bold;">'.$stateCode.'</span></p>';
                    } else {
                        $item[$fieldName] = '<p style="display:block; margin-top:5px; text-align:center;"><span style="display:block; background:#A4A4A4; padding:5px 10px; border-radius:100px; color:#fff; font-weight:bold;">'.$stateCode.'</span></p>';
                    }
                }
            }
        }
        return $dataSource;
    }
}
