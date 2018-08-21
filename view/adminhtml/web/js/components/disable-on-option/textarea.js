define([
    'Magento_Ui/js/form/element/textarea',
    'Magento_Catalog/js/components/disable-on-option/strategy'
], function (Element, strategy) {
    'use strict';

    return Element.extend(strategy);
});
