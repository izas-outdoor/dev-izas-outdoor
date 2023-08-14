from django.apps import apps
from django.db import models
from modelcluster.models import ClusterableModel
from wagtail.models import Page

from classifier.models import ClassifierAbstract, ClassifierLabelAbstract


# from django_classifier_shop.utils.es import get_es


class Product(models.Model):
    name = models.CharField(max_length=100)
    price = models.DecimalField(max_digits=7, decimal_places=2)

    def get_es_data(self):
        """
        prepare data to do index in ElasticSearch
        """
        data = {
            'id': self.pk,
            'name': self.name,
            'price': float(self.price),
            'attrs': {},
        }
        for attribute in self.attributes.all():
            data['attrs'][attribute.label.label] = attribute.value

        return data


class AttributeClassifier(ClassifierAbstract):
    pass


class AttributeClassifierLabel(ClassifierLabelAbstract):
    classifier = models.ForeignKey(AttributeClassifier, related_name='labels', on_delete=models.CASCADE)


class Attribute(models.Model):
    product = models.ForeignKey(Product, related_name='attributes', on_delete=models.CASCADE)
    label = models.ForeignKey(AttributeClassifierLabel, related_name='+', on_delete=models.CASCADE)
    value = models.CharField(max_length=500)


def _update_es_index(sender, **kwargs):
    """
    update data in ElasticSearch on product udpates
    """
    if isinstance(kwargs['instance'], Attribute):
        product = kwargs['instance'].product
    else:
        product = kwargs['instance']

    # es = get_es()
    #
    # es.index(
    #     index=settings.ELASTICSEARCH['index'],
    #     doc_type='product',
    #     body=product.get_es_data()
    # )


# post_save.connect(_update_es_index, sender=Product)
# post_save.connect(_update_es_index, sender=Attribute)


def _update_es_mapping(sender, **kwargs):
    """
    put new mapping for ElasticSearch on change attributes configuration
    """
    apps.app_configs['product'].create_es_mapping()


#
# post_save.connect(
#     _update_es_mapping,
#     sender=AttributeClassifier,
#     dispatch_uid='product__es_mapping'
# )
# post_save.connect(
#     _update_es_mapping,
#     sender=AttributeClassifierLabel,
#     dispatch_uid='product__es_mapping'
# )


class Family(ClusterableModel):
    name = models.CharField(max_length=250)


class Subfamily(ClusterableModel):
    name = models.CharField(max_length=250
                            )


class ProductTest(models.Model):
    name = models.CharField(max_length=100)
    # family=models.ForeignKey(Family,on_delete=models.CASCADE,blank=True,default=None,null=True, related_name='+')
    # subfamily=models.ForeignKey(Subfamily,on_delete=models.CASCADE,blank=True,default=None,null=True, related_name='+')


# class ProductTest1(Page):
#     name = models.CharField(max_length=100)
#     family = models.ForeignKey(Family, on_delete=models.SET_NULL, blank=True, default=None, null=True, related_name='+')
#     subfamily = models.ForeignKey(Subfamily, on_delete=models.SET_NULL, blank=True, default=None, null=True,
#                                   related_name='+')

#
# class ProductVariant(ProductTest):
#     parent = models.ForeignKey(ProductTest1, on_delete=models.PROTECT, related_name='+')
#
#
# class ProductVariant1(ProductTest1):
#     parent = models.ForeignKey(ProductTest1, on_delete=models.PROTECT, related_name='+')
#
#
# class StockUnit(models.Model):
#     product = models.ForeignKey(ProductVariant, on_delete=models.PROTECT)
#     sku = models.CharField(max_length=12)
#     label = models.ForeignKey(AttributeClassifierLabel, related_name='+', on_delete=models.PROTECT)
#     quantity = models.BigIntegerField(default=0)
#
#     class Meta:
#         unique_together = ('product', 'label',)
