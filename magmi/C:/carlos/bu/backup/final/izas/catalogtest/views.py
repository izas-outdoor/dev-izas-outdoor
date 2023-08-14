from catalogtest.models import Product

from django.template.response import TemplateResponse

from catalogtest.models import Product


# Create your views here.
def shop(request):
    products = Product.objects.live()
    p = Paginator(products, 10)
    # shows number of items in page
    totalProducts = (p.count)
    pageNum = request.GET.get('page', 1)
    page1 = p.page(pageNum)

    return TemplateResponse(request, 'home/shop.html', {
        'products': products,
        'dataSaved': page1
    })
