# -*- coding: utf-8 -*-
#################################################################################
#
# Copyright (c) 2018-Present Webkul Software Pvt. Ltd. (<https://webkul.com/>:wink:
# See LICENSE file for full copyright and licensing details.
#################################################################################

from odoo.http import route, request, Controller, Response
from odoo.addons.portal.controllers.portal import CustomerPortal
import werkzeug
import json
import logging
from odoo.exceptions import Warning
_log = logging.getLogger(__name__)
MAX_PAGE_SIZE_PAGINATION = 10
from odoo.addons.quick_order.controller.quick_search_controller import QuickSearchConroller

class QuickSearchConrollerInherit(QuickSearchConroller):

###########################################################
## Change currency according as from_currency to to_currency
############################################################
    def compute_currency(self, price):
        order = request.website.sale_get_order(force_create=1)
        from_currency = order.company_id.currency_id
        to_currency = order.pricelist_id.currency_id
        return round(from_currency.compute(price, to_currency), 2)


    def variants_availability(self):
        quick_order = request.env['quick.order'].search([('state','=','draft'), ('user_id', '=', request._uid),('type','=','replenish')])
        return [id.product_id.id for id in quick_order.quick_order_line.current()]
    def shopping_list_availability(self, shopping_list):
        if len(shopping_list)==1:
            return [id.product_id.id for id in shopping_list.quick_order_line.current()]
        return []



class CustomerPortal(CustomerPortal):

    @route(['/my', '/my/home'], type='http', auth="user", website=True)
    def home(self, **kw):
        values = super(CustomerPortal, self).home(**kw)
        total_quick_order = len(request.env['quick.order'].search([('user_id', '=', request._uid),('state', '=', 'done'),('type','=','replenish')]).ids)
        values.qcontext.update({"total_quick_order":total_quick_order})
        return values
