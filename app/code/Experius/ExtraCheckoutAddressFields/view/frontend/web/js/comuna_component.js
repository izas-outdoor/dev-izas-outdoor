define([
    'Magento_Ui/js/form/element/abstract'
], function (Component) {
    'use strict';

    return Component.extend({
        defaults: {
            imports: {
                update: 'checkout.steps.shipping-step.shippingAddress.shipping-address-fieldset.country_id:value'
            }
        },

        update: function (value) {
            this.visible(value == 'CL');
        }
    });
});