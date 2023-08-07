define([
    'jquery',
    'jquery/validate',
    'mage/translate'
], function ($) {
    return function(config, element) {
        var telephoneConfig = {
            onlyCountries: config.allowedCountries.split(','),
            utilsScript: config.utilsScript,
            initialCountry: config.initialCountry
        };

        window.intlTelInput(element, telephoneConfig);

        $.validator.addMethod(
            'validate-intl-tel',
            function(value, element) {
                if (event.currentTarget.type === 'tel') {
                    var iti = window.intlTelInputGlobals.getInstance(event.currentTarget);
                    return iti.isValidNumber();
                } else {
                    var valid = true,
                        selector = '[type="tel"]';
                    _.each($(selector), function(element) {
                        if ($(element).is(":visible")) {
                            var iti = window.intlTelInputGlobals.getInstance(element);
                            valid = valid && iti.isValidNumber();
                        }
                    });
                    return valid;
                }
            },
            $.mage.__('Please enter a valid phone number')
        );
    };
});

