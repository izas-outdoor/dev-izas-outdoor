# -*- coding: utf-8 -*-
# See LICENSE file for full copyright and licensing details.
"""
Describes methods for importing magento customers into Odoo.
"""
from odoo import models, fields,api

from odoo.addons.odoo_magento2_ept.models.api_request import req

class MagentoProductOption(models.Model):
    _name = "magento.attribute.option"
    _description = 'Magento Attribute Option'

    name = fields.Char(string='Magento Attribute Value', required=True, translate=True)
    odoo_option_id = fields.Many2one('product.attribute.value', string='Odoo Attribute option', ondelete='cascade')
    odoo_attribute_id = fields.Many2one('product.attribute', string='Odoo Attribute', ondelete='cascade')
    magento_attribute_option_name = fields.Char(string="Magento Attribute Option Value", help="Magento Attribute Value")
    magento_attribute_id = fields.Many2one("magento.product.attribute", string="Magento Attribute", ondelete='cascade')
    magento_attribute_option_id = fields.Char(string='Magento ID')
    instance_id = fields.Many2one('magento.instance', string="Instance", ondelete="cascade")
    active = fields.Boolean(string="Status", default=True)
    # add izas magento
    odoo_color_id = fields.Many2one(comodel_name='product.color',
        string='Color Odoo',ondelete='cascade')
    
    frontend_label = fields.Char(
        string="frontend_label",
        related='magento_attribute_id.frontend_label'
    )
    intermiddle_field = fields.Char(string="Intermiddle",compute='_onchange_give_values') 
    
    def _onchange_give_values(self):
        magento_attribute_id = False
        instance_id = False
        for rec in self:
            if not rec.magento_attribute_option_id and rec.odoo_attribute_id:
                magento_attribute = self.env['magento.product.attribute'].search([('odoo_attribute_id','=',rec.odoo_attribute_id.id)],limit=1)
                magento_attribute_id = magento_attribute.id
                if magento_attribute:
                    instance_id = magento_attribute.instance_id.id
                    rec.write({'magento_attribute_id':magento_attribute_id})
                    rec.write({'instance_id': instance_id})
            if not rec.magento_attribute_option_id and rec.odoo_option_id:            
                rec.write({'magento_attribute_option_name': rec.odoo_option_id.name})
                rec.name = rec.odoo_option_id.name
            rec.intermiddle_field= "AQUI"
                
    @api.onchange('odoo_option_id')
    def _onchange_name(self):
         for rec in self:
             if not rec.magento_attribute_option_id and rec.odoo_option_id:            
                # rec.write({'magento_attribute_option_name': rec.odoo_option_id.name})
                 rec.name = rec.odoo_option_id.name
                 
                 
class ProductAtributeOtherExport(models.TransientModel):
    _name = 'product.others.attributes.export'

 
    magento_instance_id = fields.Many2one(
        comodel_name='magento.instance',
        string='Instance',
        help="This field relocates magento instance"
    )

    def create_others_attributes_attribute_in_magento(self):
        for rec in self:
            magento_instance = rec.magento_instance_id
            odoo_attribute_id = self.env['magento.attribute.option'].browse(
            self._context.get("active_ids"))
            for attribute in odoo_attribute_id:
                attribute_magento = self.env['magento.product.attribute'].search(
                [('magento_attribute_code', '=', attribute.magento_attribute_id.magento_attribute_code), ('instance_id', '=', magento_instance.id)], limit=1)                
                
                if not attribute.magento_attribute_option_id:
                    data = {"option": {
                        "label": attribute.name,
                        "value":  attribute.name,
                        "sort_order": 0,
                        "is_default": True,
                        "store_labels": [
                            {
                                "store_id": 0,
                                "label":  attribute.name
                            }
                        ]
                    }

                    }
                    url = '/V1/products/attributes/%s/options' % attribute_magento.magento_attribute_id
                    attribute_data = req(magento_instance,url,method='POST',  data=data)
                    attribute.magento_attribute_option_id = attribute_data.split('_')[-1]