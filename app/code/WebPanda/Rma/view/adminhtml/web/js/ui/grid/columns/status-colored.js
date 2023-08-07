define([
    'Magento_Ui/js/grid/columns/column'
], function (Column) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'WebPanda_Rma/ui/grid/cells/status-colored'
        },
        getText: function(row) {
            return row['name'];
        },
        getColor: function(row) {
            return row['color'];
        },
        getStyle: function(row) {
            return 'background-color: ' + this.getColor(row)
        }
    });
});
