from django.shortcuts import render
from django.http import HttpResponse
from magento.handler import MagentoHandler
handler = MagentoHandler()
# Create your views here.


def index(request):
    default_data = handler.get_orders()
    print(default_data)
    return HttpResponse("Hello, world. You're at the polls index.")