# -*- coding: utf-8 -*-

from odoo import models, fields, api, _

class QuickOrder(models.Model):
    _inherit = "quick.order"

    type = fields.Selection([('replenish','REPLENISHMENT'),('programing','PROGRAMMING')],string="Type",default="replenish")
    product_tmp_ids = fields.Many2many('product.template', string='Template', compute="compute_quick_order")

    @api.depends('quick_order_line')
    def compute_quick_order(self):
        for rec in self:
            rec.product_tmp_ids = [(6, 0, rec.quick_order_line.mapped('product_id.product_tmpl_id').ids)]


    # @api.model
    # def create(self,vals):
    #     res = super(QuickOrder, self).create(vals)
    #     values = vals.get("quick_order_line")
    #     type = vals.get('type')
    #     if values:
    #         invalid = list(map(lambda x: self.get_product_id(x), values))
    #         if invalid and (sorted(invalid) != sorted(list(set(invalid)))):
    #             raise ValidationError(_('There is a product have already exits in your Quick Order. Please update the existing one or delete'))
    #     result = super(QuickOrder, self).create(vals)
    #     postfix = str(result.id)
    #     exists = False
    #     if vals.get("state") == "draft":
    #         exists = self.search([('user_id', '=', vals.get('user_id')), ('state', '=', 'draft'), ('id', '!=', result.id)], limit=1)
    #     if exists and exists.exists():
    #         raise ValidationError(_('There is already Quotation order %s in draft state for this customer. You can not create another draft qucik order for this customer. Please update the exixting one' % exists.name))
    #     if not vals.get('name'):
    #         name = False
    #         if len(postfix) == 1:
    #             name = 'QO00'+postfix
    #         elif len(postfix) == 2:
    #             name = 'QO0'+postfix
    #         else:
    #             name = 'QO'+postfix
    #         result.name = name
    #     quick_order = self.search([('state', '=', 'draft'),('user_id', '=', self._uid),('type','=',type)])
    #     if len(quick_order) > 1:
    #         result.state = 'shopping_list'
    #     else:
    #         result.state = 'draft'
    #     return res

    # def write(self,vals):
    #     print('=========vals',vals)
    #     print('=========type',self.type)
    #     res = super(QuickOrder, self).write(vals)
    #     return res

    def get_current_quantity_cart(self,product_id, order_quicks=False):
        if product_id and order_quicks:
            print ("Calll l l  -- order_quicksorder_quicksorder_quicks-,",order_quicks, product_id)
            #print ("order_quicksorder_quicks",order_quicks.mapped('quick_order_id'))
            quick_order_line = order_quicks.quick_order_line.filtered(lambda x:x.product_id.product_tmpl_id.id == product_id.id)
            print ("quick_order_line",quick_order_line, sum(quick_order_line.mapped('quantity')))
            return sum(quick_order_line.mapped('quantity'))