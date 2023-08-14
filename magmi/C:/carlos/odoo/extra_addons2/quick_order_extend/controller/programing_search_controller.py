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
MAX_PAGE_SIZE_PAGINATION = 8


class ProgramingSearchConroller(Controller):

###########################################################
## Change currency according as from_currency to to_currency
############################################################
	def compute_currency(self, price):
		order = request.website.sale_get_order(force_create=1)
		from_currency = order.company_id.currency_id
		to_currency = order.pricelist_id.currency_id
		return round(from_currency.compute(price, to_currency), 2)


	def variants_availability(self):
		quick_order = request.env['quick.order'].search([('state','=','draft'), ('user_id', '=', request._uid),('type','=','programing')])
		return [id.product_id.id for id in quick_order.quick_order_line.current()]
	def shopping_list_availability(self, shopping_list):
		if len(shopping_list)==1:
			return [id.product_id.id for id in shopping_list.quick_order_line.current()]
		return []

###########################################################################
## Get main page, product Order List, searching logic, pagination and
## domain filter for product template that are already in Order List.
###########################################################################
	@route(['/programing','/programing/page/<page_no>','/programing/cart','/programing/cart/page/<page_cart_no>','/programing/programingsearch'], type = 'http', auth = 'public', website = True)
	def get_programing_search_form(self,search='', page_no=1, key_press=False,page_cart_no=1, **kw):
		if request.website.is_public_user():
			return request.render('quick_order_extend.programing_order_public_user_sugges',{})
		if not request.website.viewref('quick_order_extend.Programingheader').active:
			return request.render('quick_order_extend.programing_disactive_mode',{})
		order_quick = request.env["quick.order"].search([('user_id', '=', request._uid), ('state', '=', 'draft'),('type','=','programing')], limit=1)
		domain = [('product_variant_ids.id', 'not in', self.variants_availability()),('website_published','=', True)]
		cart_domain = []
		error = ''
		s_error = ''
		prev_str = request.session.get('previous_search_string')
		not_click_event = request.httprequest.full_path.startswith('/programing/programingsearch')
		if not (prev_str == search) and not not_click_event:
			if search:
				url = '/programing?search='+search
			else:
				url = '/programing'
			
			request.session['previous_search_string'] = search
			return werkzeug.utils.redirect(url)
		if search:
			for srch in search.split(" "):
				if kw.get('type') == 'cart':
					cart_domain += [('name', 'ilike', srch)]
				else:
					domain += [
							'|', '|', '|', ('name', 'ilike', srch), ('description', 'ilike', srch),
							('description_sale', 'ilike', srch), ('product_variant_ids.default_code', 'ilike', srch)
						 ]
				
				
		page_no = int(page_no)
		page_cart_no = int(page_cart_no)
		offset = (page_no-1)*MAX_PAGE_SIZE_PAGINATION
		cart_offset = (page_cart_no-1)*MAX_PAGE_SIZE_PAGINATION
		prod = request.env['product.template'].search(domain + [('id','not in',order_quick.product_tmp_ids.ids)])
		quick_order_line = order_quick.quick_order_line.current()
		order_quick_templte = order_quick.product_tmp_ids
		print ("order_quick",order_quick, quick_order_line)
		if kw.get('type') == 'cart':
			products_template = request.env['product.template'].search(cart_domain)
			order_quick_templte = order_quick_templte.filtered(lambda x:x.id in products_template.ids)			
		if len(prod) <= 0:
			s_error = request.env['quick.order.message'].search([],limit=1)
			s_error = s_error.message_on_product_search
		length = len(prod)//MAX_PAGE_SIZE_PAGINATION
		if len(prod)%MAX_PAGE_SIZE_PAGINATION == 0:
			length = length
		else:
			length = length+1
		pager = request.website.pager(url="/programing", total=len(prod), page=page_no, step=MAX_PAGE_SIZE_PAGINATION, scope=5, url_args={"search": search})
		cart_pager = request.website.pager(url="/programing/cart", total=len(order_quick_templte), page=page_cart_no, step=MAX_PAGE_SIZE_PAGINATION, scope=5, url_args={"search": search})
		if len(order_quick.quick_order_line) <= 0:
			error = request.env['quick.order.message'].search([],limit=1)
			error = error.message_on_empty_order_list
		shopping_list = request.env["quick.order"].search([('user_id', '=', request._uid), ('state', '=', 'shopping_list'),('type','=','programing')])
		response = {
			'products' : prod[offset : offset+MAX_PAGE_SIZE_PAGINATION],
			'pager' : pager,
			'cart_pager' : cart_pager,
			'order_quicks' : quick_order_line[cart_offset : cart_offset+MAX_PAGE_SIZE_PAGINATION],
			'order_quick_templte' : order_quick_templte[cart_offset : cart_offset+MAX_PAGE_SIZE_PAGINATION],
			'id' : order_quick.id,
			'quick_order' : order_quick,
			'shopping_list' : shopping_list,
			'error' : {'error': error, 's_error': s_error},
			'compute_currency' : self.compute_currency,
			'product_r': self.variants_availability()
			}
		if kw.get('type') != 'cart':
			if not not_click_event:
				request.session['previous_search_string'] = search
			if search:
				response['search']=search
		if key_press:
			if kw.get('type') == 'cart':
				return request.render('quick_order_extend.add_to_cart_mutliple_programing', response)
			else:
				return request.render('quick_order_extend.main_table_data_programing', response)
		return request.render('quick_order_extend.programing_search_main_template', response)

###################################################################################
## Get the all variants of product template if exixts else submit into Order List
###################################################################################
	@route(['/programing/getvariants'], type = "http", auth = "user", website = True)
	def get_variants_programing(self, product_id, **kw):
		product_id = int(product_id)
		products = None
		total_valid =[]
		if not request.website.viewref('quick_order_extend.Programingheader').active:
			return request.render('quick_order_extend.programing_disactive_mode',{})
		prod = request.env['product.template'].sudo().browse(product_id)
		if not prod.website_published:
			return Response(status=212)
		not_id = prod.product_variant_ids.ids
		product_variant_ids = []
		user_exists = request.env['quick.order'].search([('user_id', '=', request._uid),('state', '=', 'draft'),('type','=','programing')])
		# if len(prod.product_variant_ids) == 1:
		if prod and prod.product_variant_ids:
			product_variant_ids = prod.product_variant_ids[0]
		print ("prod.product_variant_ids",prod.product_variant_ids)
		if user_exists:
			# products_exists = self.variants_availability()
			# if prod.product_variant_ids.id not in products_exists:
			user_exists.type = "programing"
			user_exists.quick_order_line = [(0, 0, {"product_id" : product_variant.id}) for product_variant in product_variant_ids]
		elif not user_exists:
			user_exists = request.env['quick.order'].create({
										"type":"programing",
										"quick_order_line": [(0, 0, {"product_id" : product_variant.id}) for product_variant in product_variant_ids]
										})
		products = prod.product_variant_ids.ids
		order_quick_templte = user_exists.product_tmp_ids.filtered(lambda x:x.id == product_id)
		
		return Response(request.env.ref('quick_order_extend.add_to_cart_mutliple_body_programing')._render({'order_quicks' : user_exists.quick_order_line.current(), 'order_quick_templte':order_quick_templte,'id':user_exists.id,'quick_order':user_exists, 'compute_currency' : self.compute_currency, 'product_r': products}),content_type='text/html;charset=utf-8',status=211)
		if not prod.product_variant_ids:
			return Response({'error' : "No variants found"}, content_type='application/json',status=500)
		if user_exists:
			not_id = list(set(prod.product_variant_ids.filtered(lambda x: x.product_tmpl_id._is_combination_possible(x.product_template_attribute_value_ids)).ids)-set(self.variants_availability()))
		# return request.render("quick_order_extend.row_select_model_programing", {"docs" : prod, "not_id" : not_id})


	@route(['/getvariantspwise/details'], methods=['POST'], type = "json", auth = "user", website = True)
	def get_variants_product_wise(self,product_id,**kw):
		product_template = request.env['product.template'].sudo().browse(int(product_id))
		user_exists = request.env['quick.order'].sudo().search([('user_id', '=', request._uid),('state', '=', 'draft'),('type','=','programing')])
		product_variants = user_exists.quick_order_line.filtered(lambda x:x.product_id.product_tmpl_id.id == product_template.id)
		product_variants_data = [{'id':product.id,'name':product.name} for product in product_variants]
		attribute_lines = product_template.attribute_line_ids.mapped('attribute_id.name')
		return {'product_variants':product_variants_data,'attribute_lines':attribute_lines}

	##########################################################################
	## Submit the variants of product template into Quick Order List
	##########################################################################
	@route(['/programing/addproducts'], methods=['POST'], type = "json", auth = "user", website = True)
	def programing_add_products(self, **kw):
		product_ids = kw.get('product_ids')
		products = None
		total_valid = []
		delete_template_row = False
		template = ''
		product_r = []
		try :
			if len(product_ids):
				user_exists = request.env['quick.order'].search([('user_id', '=', request._uid),('state', '=', 'draft'),('type','=','programing')])
				if user_exists:
					products_exists = self.variants_availability()
					for product_id in product_ids:
						if int(product_id) not in products_exists:
							user_exists.quick_order_line= [(0,0,{"product_id" : int(product_id)})]
							total_valid.append(int(product_id))
					product_r = total_valid
				elif not user_exists:
					ids = [(0,0, {"product_id" : int(id)}) for id in product_ids]
					product_r = [int(id) for id in product_ids]
					user_exists = request.env['quick.order'].create({
						'quick_order_line': ids
					})
					products = user_exists.quick_order_line
				user_exists = request.env['quick.order'].search([('user_id', '=', request._uid),('state', '=', 'draft'),('type','=','programing')])
				if total_valid:
					products = user_exists.quick_order_line
				product_template = request.env['product.template'].search([('product_variant_ids.id', '=', int(product_ids[0]))])
				if products:
					template = request.env.ref('quick_order_extend.add_to_cart_mutliple_body_programing')._render({'order_quicks' : products.current(),'order_quick_templte':product_template,'id' :user_exists.id,'quick_order':user_exists,'compute_currency' : self.compute_currency, 'product_r':  product_r})
				if product_template:
					combination = set(product_template.product_variant_ids.filtered(lambda x: x.product_tmpl_id._is_combination_possible(x.product_template_attribute_value_ids)).ids)
					delete_template_row = (set(self.variants_availability()) > combination) or (set(self.variants_availability()) == combination)
				return {
					"template" : template,
					"delete_template_row" : delete_template_row
					}
		except Exception as e:
			raise Warning('Product id is invalid need int found String {}.'.format(e))
		return Response({'error' : "error"}, content_type='application/json',status=500)

	########################################################################
	## Delete the products from Quick Order List baesd on product id
	########################################################################
	@route(['/programing/deleteproduct'], type = "json", auth = "user", website = True)
	def delete_product(self, item_id='', **kw):
		success = ''
		delete = False
		if item_id and item_id == 'all':
			user_exists = request.env['quick.order'].search([('user_id', '=', request._uid),('state','=', 'draft'),('type','=','programing')])
			if user_exists:
				user_exists.quick_order_line.unlink()
				if not len(user_exists.quick_order_line):
					success  = request.env['quick.order.message'].search([], limit = 1)
					success = success.message_on_delete_all_products
					delete = True

		elif item_id:
			user_exists = request.env['quick.order'].search([('user_id', '=', request._uid),('state','=', 'draft'),('type','=','programing')])
			quick_order_line = user_exists.quick_order_line.filtered(lambda x:x.product_id.product_tmpl_id.id == int(item_id))
			if user_exists:
				user_exists.write({"quick_order_line":[(2, int(line.id)) for line in quick_order_line]})
				if not len(user_exists.quick_order_line):
					success  = request.env['quick.order.message'].search([], limit = 1)
					success = success.message_on_delete_all_products
					delete = True
		return {"success" : success, "delete" : delete}

	#####################################################################################
	## Delete the all products from Quick Order List baesd on product id accepted as json
	#####################################################################################
	@route(['/programing/deleteallproduct'], type = 'http', auth = 'public', website = True)
	def delete_all_product_programing(self, product_tmp_id=False, type=False, shop_data=False, **kw):
		quick_order = request.env['quick.order'].search([('user_id', '=', request._uid),('state','=', 'draft'),('type','=','programing')])
		print("\n\n/programing/detailallproduct  __________________")
		if type == 'shop' and shop_data:
			quick_order = request.env['quick.order'].sudo().browse(int(shop_data))
		product_tmp_id = request.env['product.template'].sudo().browse(int(product_tmp_id))
		color_line = product_tmp_id.attribute_line_ids.filtered(lambda x: x.attribute_id.display_type ==  'color')
		attribute = request.env['product.attribute'].sudo().search([('display_type','=','size')], limit=1)

		def get_current_quantity(product_id,c_attribute):
			print ("product_id,c_attribute",product_id,c_attribute)
			if product_id and c_attribute:
				line = quick_order.quick_order_line.filtered(lambda x:x.product_id.product_tmpl_id.id == product_id.id and x.product_id.product_template_attribute_value_ids.filtered(lambda a:c_attribute.id == a.product_attribute_value_id.id))
				print ("line",line)
				if line:
					return sum(line.mapped('quantity'))
				else:
					return 0
			else:
				return 0

		def check_availability(product_id,c_attribute):
			if product_id and c_attribute:
				line = request.env['product.template.attribute.line'].sudo().search([]).filtered(lambda x:x.product_tmpl_id.id == product_id.id and x.value_ids.filtered(lambda a:c_attribute.id == a.id))
				if line:
					return False
				else:
					return True
		
		def get_onhand_quntity(product_id,c_attribute):
			if product_id and c_attribute:
				line = quick_order.quick_order_line.filtered(lambda x:x.product_id.product_tmpl_id.id == product_id.id and x.product_id.product_template_attribute_value_ids.filtered(lambda a:c_attribute.id == a.product_attribute_value_id.id))
				if line.product_id:
					return line[0].product_id.qty_available
				else:
					return 0

		vals = {
			'quick_order':quick_order,
			'product_tmp_id':product_tmp_id,
			'attribute':attribute,
			'get_current_quantity':get_current_quantity,
			'check_availability':check_availability,
			'get_onhand_quntity':get_onhand_quntity,
		}
		return request.render("quick_order_extend.quick_orde_verinet_details", vals)
	
	

################################################################################################
## Move Quick Order List into Order Cart as a single entity and change state of Quick Order List
################################################################################################
	@route(['/programing/createorder'], auth="user", type="json", website=True)
	def create_order_programing(self,id=0, order_now=[], **kw):
		success  = request.env['quick.order.message'].search([], limit = 1)
		try :
			quick_order = request.env['quick.order'].browse(int(id))
		except Exception as e:
			raise Warning('Product id is invalid need int found String {}.'.format(e))
		if order_now and quick_order.state != 'done':
			total_lines = []
			sale_order = request.website.sale_get_order(force_create=1)
			if sale_order.order_line:
				total_lines = [order.product_id.id for order in sale_order.order_line]

		if quick_order:
			sale_order = request.website.sale_get_order(force_create=1)
			for line in quick_order.quick_order_line:
				if line.quantity > 0:
					order_line = sale_order.order_line.filtered(lambda x:x.product_id.id == line.product_id.id) 
					if order_line:
						sale_order._cart_update(product_id=line.product_id.id, line_id=order_line[0].id, set_qty=line.quantity, add_qty=None)
					else:
						sale_order._cart_update(product_id=line.product_id.id, line_id = None, set_qty=line.quantity, add_qty=None)


			# for order in order_now:
			# 	if order.get('id'):
			# 		for product_id in order.get('id'):
			# 			if product_id not in total_lines:
			# 				sale_order._cart_update(product_id = product_id,line_id = None, set_qty = order.get('quantity'), add_qty = None)
			# 			else:
			# 				order_line = request.env['sale.order.line'].sudo().search([('product_id', '=', product_id)])
			# 				if len(order_line) > 0:
			# 					sale_order._cart_update(product_id = product_id, line_id = order_line[0].id, add_qty = order.get('quantity'), set_qty = None )
			if not id:
				user_exists = request.env['quick.order'].search([('user_id', '=', request._uid),('state', '=', 'draft'),('type','=','programing')])
			if id:
				user_exists = request.env['quick.order'].browse(id)
			user_exists.write({'state' : 'done'})
			return success.message_on_empty_order_list
		return {"error": success.empty_shopping_list_submit}

######################################################################################
## Move Quick Order List into Shopping List by changing the state of Quick Order List
######################################################################################
	@route(['/programing/addshoppinglist'], auth='user', type='json', website=True)
	def add_shopping_list(self, name='', id=None, create=False, list_id= 0, **kw):
		quick_order = request.env['quick.order'].browse(int(id))
		quick_order.write({"state": "done"})
		product_ids = []
		template = ''
		data = {}
		if id and create:
			if quick_order:
				quick_order.write({"name": name, "state": "shopping_list"})
				return {
						"url" : "/programing/shoppinglist/"+str(quick_order.id),
						"route" : True
					}
		elif id and list_id:

			quick_order_1 = request.env['quick.order'].browse(int(list_id))
			products = self.shopping_list_availability(quick_order_1)
			for id in quick_order.quick_order_line:
				if id.product_id.id not in products:
					product_ids.append((4,id.id))
				else:
					q_products = quick_order_1.quick_order_line.filtered(lambda x: x.product_id.id == id.product_id.id)
					if q_products.exists():
						q_products.quantity = id.quantity + q_products.quantity
			if product_ids:
				quick_order_1.write({"quick_order_line": product_ids})
				quick_order.unlink()
			return {
					"url" : "/programing/shoppinglist/"+str(quick_order_1.id),
					"route" : True
				}
		return json.dumps({"route" : False})

##################################################################
## Get All Shopping List and also based on id
##################################################################
	@route(['/programing/shoppinglist', '/programing/shoppinglist/<int:shopping_id>'], auth='user', type='http', website=True)
	def programingshopping_list(self,shopping_id=0, id=0, **kw):
		if not request.website.viewref('quick_order_extend.Programingheader').active:
			return request.render('quick_order_extend.programing_disactive_mode',{})
		shopping_lists = request.env['quick.order'].search([('user_id', '=', request._uid),('state', '=', 'shopping_list'),('type','=','programing')])
		if id:
			shopping_list = request.env['quick.order'].search([('id', '=', int(id)),('state', '=', 'shopping_list'),('type','=','programing'),('user_id', '=', request._uid)])
			shopping_lists = request.env['quick.order'].search([('id', '=', int(id)),('state', '=', 'shopping_list'),('type','=','programing'),('user_id', '=', request._uid)])
			order_quick_templte = shopping_list.product_tmp_ids
			return request.env.ref('quick_order_extend.add_to_cart_mutliple_programing')._render({
																	'shopping_lists' : shopping_list,
																	'shopping_list' : shopping_lists,
																	'compute_currency' : self.compute_currency,
																	'product_r': self.shopping_list_availability(shopping_list),
																	'cart_pager': False,
																	'order_quick_templte': order_quick_templte,
																	'quick_order' : shopping_list,
																	})
		if shopping_id:
			shopping_list = request.env['quick.order'].search([('id', '=', shopping_id), ('state', '=', 'shopping_list'),('user_id', '=', request._uid),('type','=','programing')])
			try:
				len(shopping_list.product_tmp_ids)
			except Exception:
				shopping_list=None
		else:
			shopping_list = request.env['quick.order'].search([('user_id', '=', request._uid),('type','=','programing'),('state', '=', 'shopping_list')])
		s_error = request.env['quick.order.message'].search([], limit = 1)
		order_quick_templte = shopping_list.product_tmp_ids
		return request.render('quick_order_extend.shopping_list_programing', {
						'shopping_lists' : shopping_list,
						'shopping_list' : shopping_lists,
						'compute_currency' : self.compute_currency,
						'error' :{'s_error': s_error.message_on_empty_shopping_list},
						'product_r': self.shopping_list_availability(shopping_list),
						'quick_order' : shopping_list,
						'order_quick_templte': order_quick_templte,
					})

####################################################################
## Delete all Shopping Lists and also baesd on unique id.
####################################################################
	@route(['/programing/shoppinglist/delete'], auth='user', type='http', website=True)
	def programingshopping_list_delete(self, shopping_id=0, product_id=0, **kw):

		# if not request.website.viewref('quick_order.Programingheader').active:
		# 	return request.render('quick_order.quick_order_disactive_mode',{})
		if shopping_id:
			shopping_list = request.env['quick.order'].search([('id', '=', int(shopping_id)),('state', '=', 'shopping_list'), ('type','=','programing'),('user_id', '=', request._uid)])
			if shopping_list:
				# if int(product_id) in shopping_list.quick_order_line.ids:
				print ("shopping_list",shopping_id)
				if int(product_id) in shopping_list.product_tmp_ids.ids:
					shopping_list.write({"product_tmp_ids": [(3, int(product_id))]})
				elif not product_id:
					shopping_list.unlink()
					if len(request.env['quick.order'].search([('user_id', '=', request._uid),('state', '=', 'shopping_list'),('type','=','programing')])) <= 0:
						s_error = request.env['quick.order.message'].search([], limit = 1)
						return request.env.ref('quick_order.404')._render({'error' :{'s_error': s_error.message_on_empty_shopping_list}})
				return json.dumps({'success' : "success"})
		return json.dumps({'error' : "error"})

############################################################################
## Move Shopping List into Order Cart and chnge the state of Shopping List.
############################################################################
	@route(['/programing/shoppinglist/curd'], auth='user', type='json', website=True)
	def programingshopping_list_curd(self, shopping_id, order_now = [] , **kw):
		quick_order = request.env['quick.order'].search([('id', '=', int(shopping_id)),('state', '=', 'shopping_list'), ('type','=','programing'),('user_id', '=', request._uid)])
		if not order_now:
			order_now = [{'id': order.product_id.id, 'quantity': order.quantity} for order in quick_order.quick_order_line.current()]
		if quick_order:
			return self.create_order(shopping_id,order_now)
		s_error = request.env['quick.order.message'].search([], limit = 1)
		return {"error": s_error.empty_shopping_list_submit}

	# @route(['/my/programing'], auth='user', type='http', website=True)
	# def my_quick_orders(self, **kw):
	#     total_quick_order = request.env['quick.order'].search([('user_id', '=', request._uid),('state', '=', 'done')])
	#     return request.render('quick_order.portal_my_quick_order',{'quick_orders':total_quick_order,'page_name':'quick_order'})

	# @route(['/my/programing/<int:id>'], auth='user', type='http', website=True)
	# def my_quick_orders_products(self, id=0, **kw):
	#     value = {}
	#     if id:
	#         total_quick_order = request.env['quick.order'].browse(id)
	#         value = {
	#             "name": total_quick_order.name,
	#             "quick_order": total_quick_order.quick_order_line.current(),
	#             "compute_currency": self.compute_currency,
	#             "page_name": "quick_products"
	#             }
	#     return request.render('quick_order.portal_my_quick_order_details',value)

	# @route(['/my/programing/update'], auth='user', type='http', website=True)
	# def quick_order_recover_shopping_lists(self, id=0, action='', **kw):
	#     urls = '/quickorder'
	#     if id:
	#         try:
	#             id = int(id)
	#         except Exception:
	#             return request.redirect(urls)
	#         total_quick_order = request.env['quick.order'].browse(id)
	#         if action == 're-order':
	#             sale_order = request.website.sale_get_order(force_create=1)
	#             for products in total_quick_order.quick_order_line.current():
	#                 sale_order._cart_update(product_id = products.product_id.id,line_id = None,add_qty = products.quantity)
	#             urls = '/shop/cart'
	#         elif action == 'shopping-list' :
	#             total_quick_order.write({'state': 'shopping_list'})
	#             unpublished_line = total_quick_order.quick_order_line.current()
	#             unpublished_line.unlink()
	#             urls = '/programing/shoppinglist/'+str(total_quick_order.id)
	#     return request.redirect(urls)

	@route(['/programing/update/name'], auth="public", website=True, type="json")
	def update_shopping_list_name(self, s_name='', id=0, **kw):
		success = "No"
		name = ""
		if id:
			try:
				quick_order = request.env['quick.order'].browse(int(id))
				quick_order.write({'name':s_name})
				success = "ok"
				name = quick_order.name+str('<span class="open-e-sp-name"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>')
			except Exception:
				return {"success": "No"}
		return {"success": success, "name": name}

	@route(['/programing/shoppinglist/update/quantity'], auth="user", website="true", type="http")
	def update_quanity(self, line_id=0, qty=0, **kw):
		if not request.website.viewref('quick_order.Programingheader').active:
			return request.render('quick_order_extend.programing_disactive_mode',{})
		if line_id:
			quick_order = request.env['quick.order.line'].browse(int(line_id))
			quick_order.write({"quantity" : int(qty)})
			res = quick_order.product_id.product_tmpl_id._get_combination_info(product_id=quick_order.product_id.id, add_qty=quick_order.quantity)
		return json.dumps({"price" : res['price']})

	@route(['/programing/update/quantity'], auth="public", website="true",  type="http")
	def update_cart_quanity(self, line_id=0, quantity=0,product_id=0,quick_order=0, **kw):
		if line_id and product_id and quick_order:
			quick_order = request.env['quick.order'].browse(int(quick_order))
			product_id = request.env['product.template'].browse(int(product_id))
			quick_order_line = quick_order.quick_order_line.filtered(lambda x:x.product_id.product_tmpl_id.id == product_id.id and x.product_id.product_template_attribute_value_ids.filtered(lambda a:int(line_id) == a.product_attribute_value_id.id))
			print ("quick_order_line",quick_order, quick_order_line)
			if quick_order_line:
				quick_order_line.quantity = quantity
			else:
				print ("Callll  Line ", line_id, product_id, quantity)
				new_quick_order_line = request.env['product.product'].sudo().search([]).filtered(lambda x:x.product_tmpl_id.id == product_id.id and x.product_template_attribute_value_ids.filtered(lambda a:int(line_id) == a.product_attribute_value_id.id))
				print ("new_quick_order_line",new_quick_order_line)
				if new_quick_order_line:
					quick_order.quick_order_line= [(0,0,{"product_id" : new_quick_order_line[0].id,'quantity':quantity})]
			return json.dumps({"code" : '200','status':quick_order.state}) #get_current_quantity_cartrequest.render('quick_order_extend.add_to_cart_mutliple_body_programing', {'order_quick_templte':quick_order.product_tmp_ids,'compute_currency':self.compute_currency,'quick_order':quick_order})