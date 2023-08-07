define([
    'jquery',
    'Magento_Customer/js/model/authentication-popup',
    'Magento_Customer/js/customer-data'
],
function ($, authenticationPopup, customerData) {
    'use strict';

    return function (config, element) {
        $(element).on('click tap', function (event) {
            var cart = customerData.get('cart'),
                customer = customerData.get('customer');

            event.preventDefault();
            $(element).attr('disabled', true);
            location.href = config.checkoutUrl;
        });
    };
});
