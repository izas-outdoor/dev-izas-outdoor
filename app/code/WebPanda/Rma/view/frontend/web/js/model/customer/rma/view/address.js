define(
    [
        'jquery'
    ],
    function ($) {
        'use strict';

        var data =  {
            init: function(options) {
                for (var name in options) {
                    this[name] = options[name];
                }
            },
            get: function(name, def) {
                if (typeof this[name] !== "undefined") {
                    return this[name];
                }
                return def;
            },
            "WebPanda_Rma/js/model/customer/rma/view/address": function(options) {
                data.init(options);
            }
        };

        return data;
    }
);
