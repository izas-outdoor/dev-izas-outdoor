/*jshint browser:true jquery:true*/
/*global alert*/
define(
    [
        'jquery',
        'Magento_Ui/js/modal/modal',
        'Magento_Checkout/js/checkout-data',
       //  'mage/bootstrap',
      //  'Mageplaza_Core/js/bootstrap.min'
    ],
    function ($, modal, checkoutData) {
        'use strict';
              $.fn.bsModal = $.fn.modal.noConflict(); 
        return {
            modalWindow: null,

            /** Create popUp window for provided element */
            createPopUp: function (element) {
                this.modalWindow = element;
                var options = {
                    'type': 'popup',
                    'modalClass': 'popup-authentication',
                    'responsive': true,
                    'innerScroll': true,
                    'trigger': '.proceed-to-checkout',
                    'buttons': []
                };
                modal(options, $(this.modalWindow));
                $(this.modalWindow).on('modalclosed', this.cleanCustomerEmail);
            },

            /** Show login popup window */
            showModal: function () {
                $(this.modalWindow).modal('openModal').trigger('contentUpdated');
            },

            cleanCustomerEmail: function () {
                checkoutData.setInputFieldEmailValue(null);
                checkoutData.authenticationEmail(null);
                $('#customer-email').val('');
            }
        };
    }
);
