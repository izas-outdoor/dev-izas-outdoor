from odoo import api, models, fields
from odoo.addons.odoo_magento2_ept.models.api_request import req


PRODUCT_ATTRIBUTE = 'product.attribute'


class MagentoColor(models.Model):
    _name = "magento.color"
    _description = "Magento Color"

    name = fields.Char(
        string='Nombre',
    )

    magento_color_id = fields.Integer(
        string='ID magento',
    )

    odoo_color_id = fields.Many2many(
        string='Odoo Color ID',
        comodel_name='product.color',
    )

    magento_instance_id = fields.Many2one(
        'magento.instance',
        'Instance',
        help="This field relocates magento instance"
    )

class ColorExport(models.TransientModel):
    _name = 'product.color.export'

    # product_season_ids = fields.Many2many(
    #     string='Odoo Color ID',
    #     comodel_name='product.season',
    # )
    magento_instance_id = fields.Many2one(
        comodel_name='magento.instance',
        string='Instance',
        help="This field relocates magento instance"
    )

    def create_color_attribute_in_magento(self):
        magento_instance = self.magento_instance_id
        odoo_color_id = self.env['product.color'].browse(
            self._context.get("active_ids"))
        attribute_color = self.env['magento.product.attribute'].search(
            [('magento_attribute_code', '=', 'color'), ('instance_id', '=', magento_instance.id)], limit=1)
        url_comprobation = '/V1/products/attributes/%s/' % int(attribute_color.magento_attribute_id)
        attribute_data = req(magento_instance,url_comprobation)
        options ={}
        for dictio in attribute_data['options']:
            labe = {f'{dictio["label"]}':dictio['value'] }
            options.update(labe)
         
        for color in odoo_color_id:
            if (not color.magento_color_id or color.magento_color_id == 0 )and color.magento_name:
                    
                if  color.magento_name.capitalize() in options:
                    for key,value in options.items():
                        if color.magento_name.capitalize() == key:
                            color.magento_color_id = value
                            color.magento_instance_id = magento_instance.id
                else:
                    data = {"option": {
                        "label": str(color.magento_name.capitalize()),
                        "value":  str(color.magento_name.capitalize()),
                        "sort_order": 0,
                        "is_default": True,
                        "store_labels": [
                            {
                                "store_id": 0,
                                "label":  str(color.magento_name.capitalize())
                            }
                        ]
                    }

                    }
                    url = '/V1/products/attributes/%s/options' % attribute_color.magento_attribute_id
                    attribute_data = req(magento_instance,url,method='POST',  data=data)
                    color.magento_color_id = attribute_data.split('_')[-1]
                    color.magento_instance_id = magento_instance.id

class ProductColor(models.Model):
    _inherit = 'product.color'
    
    
    
    magento_color_id = fields.Integer(
        string='ID magento',
    )

    magento_instance_id = fields.Many2one(
        'magento.instance',
        'Instancia',
        help="This field relocates magento instance"
    )
    magento_name = fields.Char(
        string='Nombre en  Magento',
    )