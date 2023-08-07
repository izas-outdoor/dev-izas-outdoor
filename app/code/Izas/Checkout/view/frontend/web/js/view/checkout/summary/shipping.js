define([
    'ko',
    'Magento_Checkout/js/model/quote'
], function (ko, quote) {
    'use strict';

    return function (parent) {
        return parent.extend({
            isCalculated: function () {
                return this.totals() && null != quote.shippingMethod();
            },

            getShippingMethodTitle: function () {
                var shippingMethod = '',
                    shippingMethodTitle = '';

                if (!this.isCalculated()) {
                    return '';
                }
                shippingMethod = quote.shippingMethod();

                if (typeof shippingMethod['method_title'] !== 'undefined') {
                    shippingMethodTitle =  shippingMethod['method_title'];
                }

                return shippingMethod ?
                    shippingMethodTitle :
                    shippingMethod['carrier_title'];
            },
        });
    };
});
