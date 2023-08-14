# -*- coding: utf-8 -*-
# Copyright (c) 2023-Present Clodofy. (<https://clodofy.com/>)

import base64
import xlrd
import logging


from operator import itemgetter
from itertools import groupby
from odoo.tools.misc import get_lang
from datetime import datetime

from odoo import fields, models, _, exceptions, api
from odoo.tools import pycompat, DEFAULT_SERVER_DATETIME_FORMAT, DEFAULT_SERVER_DATE_FORMAT, split_every

_logger = logging.getLogger(__name__)


def LS(values):
    return values and (values.lower()).strip() or ''

def LSV(values, attr):
    return LS(values) == attr

def DS(dictn, attr):
    return dictn.get(attr, '') or ''

def DSF(dictn, attr):
    return dictn.get(attr, 0.0) or 0.0

def NOT_NULL(dictn, attr):
    return isinstance(dictn.get(attr), (int, float)) 

def ExisTs(OrderNumber):
    return 'Sales order number {} already existed'.format(OrderNumber)

def PartnerNotExisTs(OrderNumber):
    return 'Customer not found for  order number {}'.format(OrderNumber)

def ProductNotExisTs(ProductCode, OrderNumber):
    return 'Product sku({}) not exist with sales order number {} '.format(ProductCode, OrderNumber)

def ShippingNotExits(Customer, OrderNumber):
    return 'Shipping Method not found for Customer({}) for Order {}, please fill it on customer'.format(Customer, OrderNumber)


class TDImportSalesOrder(models.TransientModel):
    _name = "td.import.sales_order"
    _description = "Import Sales Order"

    file = fields.Binary(
        string="Upload XLS File", required=True
    )
    file_name = fields.Char(
        string="File Name", required=True
    )
    order_no_type = fields.Selection([
        ('auto', 'Auto'),
        ('as_per_sheet', 'As Per Sheet')
        ], default="auto", string="Order Number", required=True
    )
    is_create_customer = fields.Boolean(
        string="Create Customer", help="True, Create customer if not found in database system"
    )
    auto_confirm_sale = fields.Boolean(
        string="Auto Confirm Sale", default=True
    )

    def _is_okey(self):
        """Check all validations"""
        if not self.file: raise exceptions.UserError("Please select xls file to import it.")

    @api.model
    def _get_check_value(self, book, cell):
        exact_value = cell.value
        if cell.ctype is xlrd.XL_CELL_NUMBER:
            is_float = cell.value % 1 != 0.0
            if is_float:
                exact_value = pycompat.to_text(cell.value)
            else:
                exact_value = pycompat.to_text(int(cell.value))
        elif cell.ctype is xlrd.XL_CELL_DATE:
            is_datetime = cell.value % 1 != 0.0
            # emulate xldate_as_datetime for pre-0.9.3
            dt = datetime(*xlrd.xldate.xldate_as_tuple(cell.value, 0))
            if is_datetime:
                exact_value = dt.strftime(DEFAULT_SERVER_DATETIME_FORMAT)
            else:
                exact_value = dt.strftime(DEFAULT_SERVER_DATE_FORMAT)
        elif cell.ctype is xlrd.XL_CELL_BOOLEAN:
            exact_value = u'True' if cell.value else u'False'
        elif cell.ctype is xlrd.XL_CELL_ERROR:
            raise ValueError(
                _("Error cell found while reading XLS/XLSX file: %s") % 
                xlrd.error_text_from_code.get(
                    cell.value, "unknown error code %s" % cell.value)
            )
        return exact_value

    def sticky_notification(self, subject, message):
        return {
       'type': 'ir.actions.client',
       'tag': 'display_notification',
       'params': {
           'title': subject,
           'message': message,
           'sticky': True,
           }
       }

    def _find_state(self, state_name):
        state_id = False
        if state_name:
            state_id = self.env['res.country.state'].search([('name', '=', state_name)], limit=1).id
        return state_id

    def _find_country(self, country_name):
        country_id = False
        if country_name:
            country_id = self.env['res.country'].search([('code', '=', country_name)], limit=1).id
        return country_id

    def _find_delivery_address_id(self, ParentID, OrderValues):
        ModelPartner, DeliveryName, DeliveryStreet = self.env['res.partner'], DS(OrderValues, 'Delivery Name'), DS(OrderValues, 'Street')
        ShippingSearchs = [('parent_id', '=', ParentID), ('name', 'in', (DeliveryName, DeliveryName.strip()))]
        if DeliveryStreet:
            ShippingSearchs += [('street', 'in', (DeliveryStreet, DeliveryStreet.strip()))]
        ShippingPartner = ModelPartner.search(ShippingSearchs, limit=1)
        if not ShippingPartner:
            ShippingPartner = ModelPartner.create({
                'name': DS(OrderValues, 'Delivery Name'),
                'street': DeliveryStreet,
                'city': DS(OrderValues, 'City'),
                'zip': DS(OrderValues, 'Zip'),
                'phone': DS(OrderValues, 'Phone'),
                'email': DS(OrderValues, 'Mail'),
                'state_id': self._find_state(DS(OrderValues, 'State')),
                'country_id': self._find_country(DS(OrderValues, 'Country')),
                'parent_id': ParentID,
                'type': 'delivery',
                'unique_code_delivery': 'two',
                })
        return ShippingPartner.id

    @api.model
    def _find_or_create_partner(self, OrderValues):
        ModelPartner, Reference = self.env['res.partner'], DS(OrderValues, 'Customer')
        Partner = ModelPartner.search([('unique_id', '=', Reference)], limit=1)
        if not Partner and self.is_create_customer:
            Partner = ModelPartner.create({
                'name': DS(OrderValues, 'Delivery Name') or Reference,
                'street': DS(OrderValues, 'Street'),
                'city': DS(OrderValues, 'City'),
                'zip': DS(OrderValues, 'Zip'),
                'phone': DS(OrderValues, 'Phone'),
                'email': DS(OrderValues, 'Mail'),
                'state_id': self._find_state(DS(OrderValues, 'State')),
                'country_id': self._find_country(DS(OrderValues, 'Country')),
                'unique_id': Reference
                })
        return Partner, Partner and Partner.address_get(['invoice'])['invoice'], Partner and Partner.address_get(['delivery'])['delivery']

    def get_reference_type(self):
        return self.env['partner.reference.type'].search([('name','=',str(1))], limit=1)

    @api.model
    def _search_a_product(self, Partner, LineValues):
        Product = False
        CustomerInfo = self.env['product.customerinfo'].search([
            ('sku_ids.name', '=', DS(LineValues, 'Product')),
            ('reference_type_id.id', '=', Partner.reference_type_id.id)
        ], limit=1)
        if CustomerInfo:
            Product = CustomerInfo.product_id
        return Product

    def get_header_values(self, worksheet):
        """Get header values"""
        try:
            column_header = {}
            for col_index in range(worksheet.ncols):
                value = worksheet.cell(0, col_index).value
                column_header.update({col_index: value})
        except Exception as e:
            error_value = str(e)
            raise exceptions.UserError(error_value)
        return column_header

    def get_value_from_file(self, worksheet, column_header):
        try:
            data = []
            for row_index in range(1, worksheet.nrows):
                sheet_data = {}
                for col_index in range(worksheet.ncols):
                    sheet_data.update({column_header.get(col_index): self._get_check_value(worksheet, worksheet.cell(row_index, col_index))})
                data.append(sheet_data)
        except Exception as e:
            error_value = str(e)
            raise exceptions.UserError(error_value)
        return data

    def _get_td_models(self):
        return self.env['sale.order']

    def _get_order_date(self, orderdate):
        if orderdate:
            return str(datetime.strptime(orderdate, '%Y-%m-%d').date())
        return False

    def _get_user_id(self, username):
        if username:
            User = self.env['res.users'].search([('name', '=', username)], limit=1)
            if User:
                return User.id
        return False

    def _get_ordertype_id(self, ordertype):
        if ordertype:
            OrderTypeRec = self.env['sale.order.type'].search([('name', 'ilike', ordertype)], limit=1)
            if OrderTypeRec:
                return OrderTypeRec.id
        return False

    def _get_season_id(self, season):
        if season:
            seasonRec = self.env['product.season'].search([('name', 'ilike', season)], limit=1)
            if seasonRec:
                return seasonRec.id
        return False

    def _get_warehouse_id(self, warehouse):
        if warehouse:
            warehouseRec = self.env['stock.warehouse'].search([('name', 'ilike', warehouse)], limit=1)
            if warehouseRec:
                return warehouseRec.id
        return False

    def _create_sales_order_vals(self, OrderNumber, OrderValues):
        Partner, InvoicePartner, ShippingPartner = self._find_or_create_partner(OrderValues[0])
        OrderVals = {
            'partner_id': Partner.id,
            'partner_invoice_id': Partner.id,#InvoicePartner,
            #'partner_shipping_id': ShippingPartner,#added later in seperate function
            'td_xls_order_name': OrderNumber,
            'picking_note': DS(OrderValues[0], 'Reference'),
            'warehouse_id': self._get_warehouse_id(DS(OrderValues[0], 'Warehouse')),
        }
        OrderDate = self._get_order_date(DS(OrderValues[0], 'Order Date'))
        if OrderDate: OrderVals['date_order'] = OrderDate
        UserID = self._get_user_id(DS(OrderValues[0], 'Salesperson'))
        if UserID: OrderVals['user_id'] = UserID
        SeasonID = self._get_season_id(DS(OrderValues[0], 'Project'))
        if SeasonID: OrderVals['season_id'] = SeasonID
        typeID = self._get_ordertype_id(DS(OrderValues[0], 'Type'))
        if typeID: OrderVals['type_id'] = typeID

        if self.order_no_type == 'as_per_sheet':
            OrderVals['name'] = OrderNumber
        return Partner, OrderVals#ModelSale.create(OrderVals)

    def _get_uom_id(self, uom_value, uom_id):
        if uom_value:
            UoMRec = self.env['uom.uom'].search([('name', '=', uom_value)], limit=1)
            if UoMRec:
                uom_id = UoMRec.id
        return uom_id

    def _get_customer_taxes(self, Partner, Product):
        taxesValues = [(6, 0, Product.taxes_id.ids)]
        if Partner:
            if Partner.property_account_position_id:
                taxes = Partner.property_account_position_id.map_tax(Product.taxes_id, partner=Partner)
                if taxes:
                    taxesValues = [(6, 0, taxes.ids)]
        return taxesValues

    def _get_xls_taxes(self, tax_values):
        taxesValues = []
        for TaxName in tax_values.split(','):
            Tax = self.env['account.tax'].search([('name', '=', TaxName)], limit=1)
            if Tax:
                taxesValues.append(Tax.id)
        return taxesValues and [(6, 0, taxesValues)] or []

    def _create_sales_order_line_vals(self, Product, OrderNumber, LineVals, Partner):
        lang = get_lang(self.env, Partner.lang).code
        ProductDict = {
            'product_id': Product.id,
            'product_uom_qty': DSF(LineVals, 'Ordered Qty') or 1.0,
            'product_uom': self._get_uom_id(DS(LineVals, 'Unit of Measure'), Product.uom_id.id),
            'price_unit': DSF(LineVals, 'Unit Price') or Product.lst_price,
            'tax_id': DS(LineVals, 'Taxes') and self._get_xls_taxes((LineVals, 'Taxes')) or self._get_customer_taxes(Partner, Product),
            'discount': DSF(LineVals, 'Discount'),
            'name': self.env['sale.order.line'].with_context(lang=lang).get_sale_order_line_multiline_description_sale(Product)
            }
        Description = DS(LineVals, 'Description')
        if Description.strip():
            ProductDict['name'] = Description.strip()
        return ProductDict

    def _create_an_orders(self):
        """Create Orders"""
        try:
            xls_file = xlrd.open_workbook(file_contents=base64.decodebytes(self.file))
            sheet = xls_file.sheet_by_index(0)
        except:
            raise exceptions.UserError(_('You can only upload .XLS file Extension.'))
    
        XLSHeaders = self.get_header_values(sheet)
        OrdersData = self.get_value_from_file(sheet, XLSHeaders)

        SortByOrders = sorted(OrdersData, key=itemgetter('Sales Order'))
        GroupByOrders = dict((k, [v for v in itr]) for k, itr in groupby(SortByOrders, itemgetter('Sales Order')))

        ModelSale, Errors, total_orders, total_imported, TotalOrdersList = self._get_td_models(), [], 0, 0, []
        SplitEvery = split_every(50, GroupByOrders.items())
        for SplitItems in SplitEvery:
            for OrderNumber, OrderValues in SplitItems:
                _logger.info("checking for order {}".format(OrderNumber))
                total_orders += 1
                if (not OrderNumber) or (not OrderValues) or (OrderNumber and ModelSale.search([('td_xls_order_name', '=', OrderNumber)])):
                    OrderNumber and Errors.append(ExisTs(OrderNumber))
                    continue
                Partner, SalesOrderVals = self._create_sales_order_vals(OrderNumber, OrderValues)
                if not Partner:
                    Errors.append(PartnerNotExisTs(OrderNumber))
                    continue
                if not Partner.property_delivery_carrier_id:
                    Errors.append(ShippingNotExits(Partner.name, OrderNumber))
                    continue
                SalesOrderVals['partner_shipping_id'] = self._find_delivery_address_id(Partner.id, OrderValues[0])
                TotalLines, ProductNotFound = [], False
                for LineVals in OrderValues:
                    Product = self._search_a_product(Partner, LineVals)
                    if not Product:
                        Errors.append(ProductNotExisTs(DS(LineVals, 'Product'), OrderNumber))
                        ProductNotFound = True
                        break
                    TotalLines.append(self._create_sales_order_line_vals(Product, OrderNumber, LineVals, Partner))
                if ProductNotFound: continue
                SalesOrderVals['order_line'] = [(0, 0, xline) for xline in TotalLines]
                SalesOrder = ModelSale.create(SalesOrderVals)
                total_imported += 1
                SalesOrder.onchange_partner_id()
                SalesOrder._compute_payment_mode()
                SalesOrder.set_delivery_line(SalesOrder.partner_id.property_delivery_carrier_id, DSF(OrderValues[0], 'Price delivery'))
                TotalOrdersList.append(SalesOrder.id)
        if self.auto_confirm_sale:
            for to_confirm_order in self.env['sale.order'].browse(TotalOrdersList):
                to_confirm_order.action_confirm()

        return self.display_final_message(Errors, total_orders, total_imported, TotalOrdersList)

    def display_final_message(self, Errors, total_orders, total_imported, TotalOrdersList):
        view = self.env.ref('td_import_sales_order.view_td_success_wizard')
        context = dict(self._context or {})
        WarningMessage = str(total_imported) + " Records imported successfully. \n"
        WarningMessage += str(total_orders - total_imported) + " Errors in Records. \n\n"
        if total_orders != total_imported:
            WarningMessage += 'See Error(s) Below,\n'
        for ErrorMessage in Errors:
            WarningMessage += ErrorMessage+'\n'

        context['warning_message'] = WarningMessage
        context['order_list'] = TotalOrdersList
        return {
            'name': 'Successfully Executed',
            'type': 'ir.actions.act_window',
            'view_mode': 'form',
            'res_model': 'td.success.wizard',
            'views': [(view.id, 'form')],
            'view_id': view.id,
            'target': 'new',
            'context': context,
        }

    def action_create_orders(self):
        """Validation & Create & View Order"""
        self._is_okey()
        return self._create_an_orders()


class TMessageWizard(models.TransientModel):
    _name = "td.success.wizard"
    _description = "Message wizard to display messages"

    def get_default(self):
        return self.env.context.get("warning_message")

    def get_default_order_list(self):
        return self.env.context.get("order_list")

    name = fields.Text(
        string="Message", readonly=True, default=get_default
    )
    order_list_ids = fields.Many2many(
        'sale.order', string="OrderList", default=get_default_order_list
    )

    def action_view_orders(self):
        if not self.order_list_ids:
            raise exceptions.UserError("No orders found, please check in sales order menu directly.")
        sale_order_action = self.env["ir.actions.actions"]._for_xml_id("sale.action_orders")
        sale_order_action.update({
            'domain': [('id', 'in', self.order_list_ids.ids)],
            'context': {'create': 0},
        })
        return sale_order_action
