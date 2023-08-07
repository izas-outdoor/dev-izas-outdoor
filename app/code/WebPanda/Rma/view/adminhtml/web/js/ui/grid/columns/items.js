define([
    'Magento_Ui/js/grid/columns/column'
], function (Column) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'WebPanda_Rma/ui/grid/cells/items'
        },
        getItems: function(row) {
            return row[this.index]['items'];
        }
    });
});
