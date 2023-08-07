define([
    'Magento_Ui/js/grid/columns/column'
], function (Column) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'WebPanda_Rma/ui/grid/cells/link'
        },
        getLinkText: function(row) {
            return row[this.index + '_text'];
        },
        getLinkUrl: function(row) {
            return row[this.index + '_url'];
        }
    });
});
