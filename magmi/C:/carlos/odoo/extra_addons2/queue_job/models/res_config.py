from odoo import fields, models, api


class ResConfigSettings(models.TransientModel):
    _inherit = 'res.config.settings'

    allow_queue_job_dev = fields.Boolean(string="Allow Queue in Dev Mode",
                                         config_parameter='queue_job.default_allow_queue_job_dev')
