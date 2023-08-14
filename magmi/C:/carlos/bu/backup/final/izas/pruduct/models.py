from django.db import models
from modelcluster.models import ClusterableModel
from wagtail.models import Page

from product.models import AttributeClassifierLabel


class Family(ClusterableModel):
    name = models.CharField(max_length=250)


class Subfamily(ClusterableModel):
    name = models.CharField(max_length=250)


class ProductTest1(Page):
    name = models.CharField(max_length=100)
    family = models.ForeignKey(Family, on_delete=models.PROTECT, blank=True, default=None, null=True, related_name='+')
    subfamily = models.ForeignKey(Subfamily, on_delete=models.PROTECT, blank=True, default=None, null=True,
                                  related_name='+')


class ProductVariant1(ProductTest1):
    parent = models.ForeignKey(ProductTest1, on_delete=models.PROTECT, related_name='pruduct_test')


class StockUnit(models.Model):
    product = models.ForeignKey(ProductVariant1, on_delete=models.PROTECT, related_name='+')
    sku = models.CharField(max_length=12)
    label = models.ForeignKey(AttributeClassifierLabel, related_name='+', on_delete=models.PROTECT)
    quantity = models.BigIntegerField(default=0)

    class Meta:
        unique_together = ('product', 'label',)
