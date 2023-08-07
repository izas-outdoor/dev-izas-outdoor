require([
    'jquery',
    'magnificPopup'
], function ($) {
    'use strict';
    var product = {
        init: function () {
            this.binding();
        },

        binding: function () {
            $('.product-info-section').on('click', $.proxy(this.toggleAccordion, this));
            $('.colors-row .selected').on('click', $.proxy(this.preventUrl, this));
            $('.size-guide-container a').magnificPopup({type:'image'});
            return this;
        },

        preventUrl: function (e) {
            e.preventDefault();
        },

        toggleAccordion: function (event) {
            event.preventDefault();
            var $element = $(event.currentTarget);
            if ($element.hasClass("active")) {
                $element.removeClass('active');
              } else {
                $element.addClass('active');
              }
          //  $('.product-info-section').removeClass('active');
           
        }
    };

    $(document).ready(function (){product.init();});
});