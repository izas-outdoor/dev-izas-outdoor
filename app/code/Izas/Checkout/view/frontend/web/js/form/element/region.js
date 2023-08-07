define([
    'jquery',
    'Magento_Ui/js/form/element/region',
    'Magento_Ui/js/lib/validation/validator'
], function ($, Select, validator) {
    'use strict';

    return Select.extend({

        initialize: function () {
            this._super();
            this.addValidation();
        },

        addValidation: function() {
            if (window.checkoutConfig.validate_region_ids) {
                var regions = window.checkoutConfig.excluded_region_ids;
                validator.addRule(
                    'validate-region',
                    function (regionId) {
                        return $.inArray(parseInt(regionId), regions) < 0;
                    },
                    $.mage.__(window.checkoutConfig.shipping_address_validation_error_message)
                );
            }
        }
    });
});