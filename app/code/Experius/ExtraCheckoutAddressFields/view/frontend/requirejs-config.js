var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/action/set-billing-address': {
                'Experius_ExtraCheckoutAddressFields/js/action/set-billing-address-mixin': true
            },
            'Magento_Checkout/js/action/set-shipping-information': {
                'Experius_ExtraCheckoutAddressFields/js/action/set-shipping-information-mixin': true
            },
            'Magento_Checkout/js/action/create-shipping-address': {
                'Experius_ExtraCheckoutAddressFields/js/action/create-shipping-address-mixin': true
            },
            'Magento_Checkout/js/action/place-order': {
                'Experius_ExtraCheckoutAddressFields/js/action/set-billing-address-mixin': true
            },
            'Magento_Checkout/js/action/create-billing-address': {
                'Experius_ExtraCheckoutAddressFields/js/action/set-billing-address-mixin': true
            }
        }
    },
    map: {
        '*': {                      
       //   'Magento_Checkout/template/shipping-address/address-renderer/default.html': 'Experius_ExtraCheckoutAddressFields/template/shipping-address/address-renderer/default.html',
            'Magento_Checkout/template/shipping-address/address-renderer/default.html': 'Experius_ExtraCheckoutAddressFields/template/shipping-information/address-renderer/default.html',
            'Magento_Checkout/template/shipping-address/list.html': 'Experius_ExtraCheckoutAddressFields/template/shipping-information/address-renderer/list.html',
            'Magento_Checkout/template/shipping-information/address-renderer/default.html': 'Experius_ExtraCheckoutAddressFields/template/shipping-information/address-renderer/default.html',
        }
    }
};