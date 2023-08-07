require([
    'jquery',
    'bootstrapselect',
    'bootstrapjs'
], function ($) {
    'use strict';

    var filters = {
        init: function () {
            this.binding();
        },

        binding: function () {
            $('.close-filters-link').on('click', $.proxy(this.hidden, this));
            $('.toolbar-sorter').on('click', $.proxy(this.hidden, this));
            $(window).on('resize', $.proxy(this.resize, this));
            $('.panel-collapse').on('show.bs.collapse', function () {
                $(event.target).closest('.panel-heading').addClass('active');
            });

            $('.panel-collapse').on('hide.bs.collapse', function () {
                $(event.target).closest('.panel-heading').removeClass('active');
            });
            return this;
        },

        hidden: function () {
            var self = this;
            if (self.isMobile()) {
                $('#layer-product-list .panels').toggle();
                if ($('#layer-product-list .panels').is(':visible')) {
                    $('.wt-overlay').addClass('black-overlay');
                } else {
                    $('.wt-overlay').removeClass('black-overlay');
                }
            }
        },

        resize: function () {
            var self = this;
            if (self.isMobile()) {
                $('#layer-product-list .panels').hide();
                $('.wt-overlay').removeClass('black-overlay');
            } else {
                $('#layer-product-list .panels').show();
            }

        },

        isMobile: function () {
            return ($(window).width() < 768);
        }
    };

    $(document).ready(function () {
        filters.init();
    });
});
