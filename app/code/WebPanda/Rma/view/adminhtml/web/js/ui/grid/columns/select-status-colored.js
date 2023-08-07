define([
    'Magento_Ui/js/grid/columns/select'
], function (Column) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'WebPanda_Rma/ui/grid/cells/status-colored'
        },
        getText: function(row) {
            return row['status_entity_name'] ? row['status_entity_name'] : row['status_name'];
        },
        getColor: function(row) {
            return row['status_entity_color'] ? row['status_entity_color'] : 'red';
        },
        getStyle: function(row) {
            return 'background-color: ' + this.getColor(row)
        }
    });
});
