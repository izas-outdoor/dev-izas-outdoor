from odoo import api, fields, models


class CustomerMagentoType(models.Model):
    _name = 'customer.magento.type'
    _rec_name ='name'
    
    name = fields.Char(string='Name')        
    code = fields.Char(string="id Magento",help="Este número o código en el id de magenteo para esta tabla en la bbdd de magento Magento = 0 y Decathlon = 1")    
    magento_instance_id = fields.Many2one(        
        comodel_name='magento.instance',
        string="Magento Instance",
        help="This field relocates Magento Instance",        
       
    )

    
