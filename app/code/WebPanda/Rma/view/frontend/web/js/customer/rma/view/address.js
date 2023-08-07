define([
    'jquery',
    'ko',
    'uiComponent',
    'WebPanda_Rma/js/model/customer/rma/view/address',
    'mage/mage'
], function($, ko, Component, address) {
    'use strict';

    return Component.extend({
        editMode: ko.observable(false),
        isLoading: ko.observable(false),

        initialize: function () {
            address.init();
        },
        editClick: function(data, event) {
            this.editMode(true);
        },
        cancelClick: function(data, event) {
            this.editMode(false);
        },
        getData: function(key) {
            return address.get(key, '');
        },
        formSubmit: function(form) {
            if ($(form).valid()) {
                return true;
            }
        }
    });
});
