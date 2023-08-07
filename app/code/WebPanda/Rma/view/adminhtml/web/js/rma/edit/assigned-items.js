define([
    'mage/adminhtml/grid'
], function () {
    'use strict';

    return function (config) {
        var selectedItems = config.selectedItems,
            rmaItem = $H(selectedItems),
            gridJsObject = window[config.gridJsObjectName],
            tabIndex = 1000;

        $('in_assigned_items').value = Object.toJSON(rmaItem);

        /**
         * Register Rma code Item
         *
         * @param {Object} grid
         * @param {Object} element
         * @param {Boolean} checked
         */
        function registerRmaItem(grid, element, checked) {
            if (checked) {
                rmaItem.set(element.value, element.value);
            } else {
                rmaItem.unset(element.value);
            }
            $('in_assigned_items').value = Object.toJSON(rmaItem);
            grid.reloadParams = {
                'selected_items[]': rmaItem.keys()
            };
        }

        /**
         * Click on item row
         *
         * @param {Object} grid
         * @param {String} event
         */
        function rmaItemRowClick(grid, event) {
            var trElement = Event.findElement(event, 'tr'),
                isInput = Event.element(event).tagName === 'INPUT',
                checked = false,
                checkbox = null;

            if (trElement) {
                checkbox = Element.getElementsBySelector(trElement, 'input');

                if (checkbox[0]) {
                    checked = isInput ? checkbox[0].checked : !checkbox[0].checked;
                    gridJsObject.setCheckboxChecked(checkbox[0], checked);
                }
            }
        }

        /**
         * Initialize rma item row
         *
         * @param {Object} grid
         * @param {String} row
         */
        function rmaItemRowInit(grid, row) {
            var checkbox = $(row).getElementsByClassName('checkbox')[0],
                position = $(row).getElementsByClassName('input-text')[0];

            if (checkbox && position) {
                checkbox.positionElement = position;
                position.checkboxElement = checkbox;
                position.disabled = !checkbox.checked;
                position.tabIndex = tabIndex++;
            }
        }

        gridJsObject.rowClickCallback = rmaItemRowClick;
        gridJsObject.initRowCallback = rmaItemRowInit;
        gridJsObject.checkboxCheckCallback = registerRmaItem;

        if (gridJsObject.rows) {
            gridJsObject.rows.each(function (row) {
                rmaItemRowInit(gridJsObject, row);
            });
        }
    };
});
