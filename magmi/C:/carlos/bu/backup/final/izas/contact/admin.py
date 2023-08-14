from django.contrib import admin

# Register your models here.
from .models import *
admin.site.register(Contact)
admin.site.register(ContactClassifier)
admin.site.register(ContactClassifierLabel)
admin.site.register(PropertyClassifier)
admin.site.register(PropertyClassifierLabel)
admin.site.register(MagicClassifier)
admin.site.register(MagicClassifierLabel)