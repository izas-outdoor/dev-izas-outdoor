from odoo import api, models,fields

class MagentoAttribute(models.Model):
    _name = "magento.attribute"
    _description = "Magento Color"

    name = fields.Char(
        string='Nombre',
    )
    
    magento_attribute_id = fields.Integer(
        string='ID magento',
    )
    magento_attribute_value_id = fields.Integer(
        string='ID valor atributo magento',
    )
    
    odoo_attribute_id = fields.Many2one(
        string='Odoo Attribute ID',
        comodel_name='product.attribute',
    )
    odoo_attribute_value_id = fields.Many2one(
        string='Odoo Attribute Value ID',
        comodel_name='product.attribute.value',
    )
    
    magento_instance_id = fields.Many2one(
        'magento.instance',
        'Instance',
        help="This field relocates magento instance"
    )
    
    
