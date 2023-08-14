import os
from decimal import Decimal
from io import BytesIO
from random import randrange

from django.utils.text import slugify


os.environ.setdefault("DJANGO_SETTINGS_MODULE", "sizas.settings.dev")
import django

django.setup()
from catalogue.models import *

import requests
from django.core.files.images import ImageFile
from wagtail.images.models import Image


from catalogue.views import Uploader

x=Uploader(file='stock.xlsx')
