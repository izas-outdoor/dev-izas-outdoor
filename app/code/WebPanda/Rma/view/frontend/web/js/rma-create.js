define([
    'jquery',
    'underscore',
    'mage/template',
    'mage/translate',
    'mage/validation/validation'
], function ($, _, mageTemplate) {
    'use strict';

    $.widget('mage.WebpandaRmaCreate', {
        options: {
            getOrderInfoCallback: "",
            rmaForm: "",
            currentOrder: "",
            orderSelectWrapper: '.select-order-wrapper',
            orderSelect: "#order-select",
            rmaViewWrapper: ".rma-view-wrapper",
            orderGeneralInfo: ".rma-view-wrapper .general-info",
            orderContactInfo: ".rma-view-wrapper .contact-info",
            generalInfoTemplate: mageTemplate('#general-info-template'),
            contactInfoTemplate: mageTemplate('#contact-info-template'),
            itemsWrapper: ".items-wrapper table tbody",
            itemTemplate: mageTemplate('#return-item-template')
        },

        _init: function () {
            this._RenderOrderSelect();
            this._EventListener();

            if (this.options.currentOrder.length > 0) {
                $(this.options.orderSelect).val(this.options.currentOrder);
                this._LoadOrderdata(this.options.currentOrder);
            }
        },

        _RenderOrderSelect: function() {
            var $widget = this,
                orderSelect = $(this.options.orderSelect),
                orderData = this.options.jsonData['orders'],
                option = '';

            $.each(orderData, function () {
                var item = this;

                option = document.createElement('option');
                option.setAttribute('value', item.id);
                option.innerHTML = '#' + item.increment_id + ' from ' + item.date;
                orderSelect.append(option);
            });
        },

        _EventListener: function() {
            var $widget = this,
                orderSelectWrapper = $(this.options.orderSelectWrapper),
                orderSelect = $(this.options.orderSelect),
                orderData = '';

            orderSelectWrapper.find('button.apply-order-select').click(function (e) {
                e.preventDefault();

                if (orderSelect.val() == '') {
                    $widget._resetRma();
                    return false;
                }
                $widget._LoadOrderdata(orderSelect.val());
            });
        },

        _LoadOrderdata: function(orderId) {
            var $widget = this,
                rmaViewWrapper = $(this.options.rmaViewWrapper),
                rmaForm = $(this.options.rmaForm),
                data = '';

            data = {
                'order_id': orderId
            };
            $.ajax({
                'data': data,
                'method': 'get',
                'url': $widget.options.getOrderInfoCallback,
                'dataType': 'json',
                'showLoader': true,
                'success': function (res) {
                    if (res.success) {
                        $widget._RenderOrder(res);
                        $widget._RenderItems(res);
                        rmaViewWrapper.show();

                        rmaForm.validate();
                    } else {
                        alert(res.message);
                    }
                }
            })
        },

        _RenderOrder: function(data) {
            var $widget = this,
                orderGeneralInfo = $(this.options.orderGeneralInfo),
                orderContactInfo = $(this.options.orderContactInfo),
                generalInfoTemplate = this.options.generalInfoTemplate,
                contactInfoTemplate = this.options.contactInfoTemplate,
                generalInfoHtml = '',
                contactInfoHtml = '';

            generalInfoHtml = generalInfoTemplate({
                data: data
            });

            contactInfoHtml = contactInfoTemplate({
                data: data
            });

            orderGeneralInfo.html(generalInfoHtml);
            orderContactInfo.html(contactInfoHtml);
        },

        _RenderItems: function(data) {
            var $widget = this,
                itemsWrapper = $(this.options.itemsWrapper),
                itemTemplate = this.options.itemTemplate,
                rmaForm = $(this.options.rmaForm),
                submitButton = rmaForm.find('.action.primary'),
                itemHtml = '';

            itemsWrapper.html('');
            $.each(data.items, function(key, item) {
                itemHtml = itemTemplate({
                    data: item
                });

                itemsWrapper.append(itemHtml);
            });

            itemsWrapper.find('.col-active input[type=checkbox]').on('click', function(e) {
                if ($(this).is(':disabled')) {
                    return false;
                }
                var item = $(this).parents('tr');

                if ($(this).is(':checked')) {
                    item.find('.col-request fieldset').show();
                    item.find('.col-request fieldset .field, .col-request fieldset .select').each(function() {
                        $(this).addClass('required');
                    });
                    submitButton.attr('disabled', false);
                } else {
                    item.find('.col-request fieldset').hide();
                    item.find('.col-request fieldset .field, .col-request fieldset .select').each(function() {
                        $(this).removeClass('required');
                    });
                    var submitEnabled = false;
                    itemsWrapper.find('.col-active input[type=checkbox]').each(function() {
                        if ($(this).is(':checked')) {
                            submitEnabled = true;
                        }
                    });
                    if (submitEnabled) {
                        submitButton.attr('disabled', false);
                    } else {
                        submitButton.attr('disabled', true);
                    }
                }
            });
        }
    });

    return $.mage.WebpandaRmaCreate;
});
