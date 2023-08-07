define([
    'ko',
    'Magento_Checkout/js/model/quote'
], function (ko, quote) {
    'use strict';

    return function (parent) {
        return parent.extend({
            ifShowValue: function () {
                return false;
            }
        });
    };
});
