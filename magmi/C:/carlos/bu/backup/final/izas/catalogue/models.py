from django.core.cache import cache
from django.db import models
from django.db.models import Exists, OuterRef
from django.template.defaultfilters import striptags
from django.urls import reverse
from django.utils.translation import gettext_lazy as _, get_language
from modelcluster.fields import ParentalKey
from modelcluster.models import ClusterableModel
from taggit.models import TaggedItemBase
from wagtail.admin.panels import FieldPanel, InlinePanel
from wagtail.fields import RichTextField
from wagtail.models import Page, Orderable
from wagtail.snippets.models import register_snippet

from .blocks import *


# from colors.edit_handlers import NativeColorPanel
# from colors.fields import ColorField, ColorFieldWagtail


# from wagtail_color_panel.edit_handlers import NativeColorPanel
# from wagtail_color_panel.fields import ColorField


class CategoryPage(Page):
    # color1 = ColorField(default="#000000")
    # color2 = ColorFieldWagtail(default="#000000")
    """
    A product category. Merely used for navigational purposes; has no
    effects on business logic.
    Uses :py:mod:`django-treebeard`.
    """
    #: Allow comparison of categories on a limited number of fields by ranges.
    #: When the Category model is overwritten to provide CMS content, defining
    #: this avoids fetching a lot of unneeded extra data from the database.
    template = 'catalogue/category_page.html'
    COMPARISON_FIELDS = ('id', 'path', 'depth')
    description = RichTextField(_('Description'), blank=True)

    image = models.ForeignKey(
        'wagtailimages.Image',
        null=True,
        blank=True,
        on_delete=models.SET_NULL,
        related_name='+'
    )
    # slug = SlugField(_('Slug'), max_length=255, db_index=True)

    is_public = models.BooleanField(
        _('Is public'),
        default=True,
        db_index=True,
        help_text=_("Show this category in search results and catalogue listings."))

    ancestors_are_public = models.BooleanField(
        _('Ancestor categories are public'),
        default=True,
        db_index=True,
        help_text=_("The ancestors of this category are public"))

    _slug_separator = '/'
    _full_name_separator = ' > '

    content_panels = Page.content_panels + [

        FieldPanel("description"),
        FieldPanel("image"),
        FieldPanel("is_public"),
        FieldPanel("ancestors_are_public"),
        # NativeColorPanel('color1'),
        # NativeColorPanel('color2'),
    ]

    # objects = CategoryQuerySet.as_manager()

    def __str__(self):
        return self.full_name

    @property
    def full_name(self):
        """
        Returns a string representation of the category and it's ancestors,
        e.g. 'Books > Non-fiction > Essential programming'.
        It's rarely used in Oscar, but used to be stored as a CharField and is
        hence kept for backwards compatibility. It's also sufficiently useful
        to keep around.
        """
        names = [category.title for category in self.get_ancestors_and_self()]
        return self._full_name_separator.join(names)

    def get_full_slug(self, parent_slug=None):
        if self.is_root():
            return self.slug

        cache_key = self.get_url_cache_key()
        full_slug = cache.get(cache_key)
        if full_slug is None:
            parent_slug = parent_slug if parent_slug is not None else self.get_parent().full_slug
            full_slug = "%s%s%s" % (parent_slug, self._slug_separator, self.slug)
            cache.set(cache_key, full_slug)

        return full_slug

    @property
    def full_slug(self):
        """
        Returns a string of this category's slug concatenated with the slugs
        of it's ancestors, e.g. 'books/non-fiction/essential-programming'.
        Oscar used to store this as in the 'slug' model field, but this field
        has been re-purposed to only store this category's slug and to not
        include it's ancestors' slugs.
        """
        return self.get_full_slug()

    # def generate_slug(self):
    #     """
    #     Generates a slug for a category. This makes no attempt at generating
    #     a unique slug.
    #     """
    #     return slugify(self.title)

    def save(self, *args, **kwargs):
        """
        Oscar traditionally auto-generated slugs from names. As that is
        often convenient, we still do so if a slug is not supplied through
        other means. If you want to control slug creation, just create
        instances with a slug already set, or expose a field on the
        appropriate forms.
        """
        # if not self.slug:
        #     self.slug = self.generate_slug()
        super().save(*args, **kwargs)

    def set_ancestors_are_public(self):
        # Update ancestors_are_public for the sub tree.
        # note: This doesn't trigger a new save for each instance, rather
        # just a SQL update.
        included_in_non_public_subtree = self.__class__.objects.filter(
            is_public=False, path__rstartswith=OuterRef("path"), depth__lt=OuterRef("depth")
        )
        self.get_descendants_and_self().update(
            ancestors_are_public=Exists(
                included_in_non_public_subtree.values("id"), negated=True))

        # Correctly populate ancestors_are_public
        self.refresh_from_db()

    @classmethod
    def fix_tree(cls, destructive=False):
        super().fix_tree(destructive)
        for node in cls.get_root_nodes():
            # ancestors_are_public *must* be True for root nodes, or all trees
            # will become non-public
            if not node.ancestors_are_public:
                node.ancestors_are_public = True
                node.save()
            else:
                node.set_ancestors_are_public()

    def get_meta_title(self):
        return self.meta_title or self.title

    def get_meta_description(self):
        return self.meta_description or striptags(self.description)

    def get_ancestors_and_self(self):
        """
        Gets ancestors and includes itself. Use treebeard's get_ancestors
        if you don't want to include the category itself. It's a separate
        function as it's commonly used in templates.
        """
        if self.is_root():
            return [self]

        return list(self.get_ancestors()) + [self]

    def get_descendants_and_self(self):
        """
        Gets descendants and includes itself. Use treebeard's get_descendants
        if you don't want to include the category itself. It's a separate
        function as it's commonly used in templates.
        """
        return self.get_tree(self)

    def get_url_cache_key(self):
        current_locale = get_language()
        cache_key = 'CATEGORY_URL_%s_%s' % (current_locale, self.id)
        return cache_key

    def _get_absolute_url(self, parent_slug=None):
        """
        Our URL scheme means we have to look up the category's ancestors. As
        that is a bit more expensive, we cache the generated URL. That is
        safe even for a stale cache, as the default implementation of
        ProductCategoryView does the lookup via primary key anyway. But if
        you change that logic, you'll have to reconsider the caching
        approach.
        """
        return reverse('catalogue:category', kwargs={
            'category_slug': self.get_full_slug(parent_slug=parent_slug), 'id': self.id
        })

    def get_absolute_url(self):
        return self._get_absolute_url()

    class Meta:
        # abstract = True

        app_label = 'catalogue'
        ordering = ['path']
        verbose_name = _('Category')
        verbose_name_plural = _('Categories')

    def has_children(self):
        return self.get_num_children() > 0

    def get_num_children(self):
        return self.get_children().count()


@register_snippet
class Brand(models.Model):
    id = models.CharField(max_length=1, primary_key=True)
    title = models.CharField(max_length=50)

    def __str__(self):
        return self.title


@register_snippet
class ProductType(ClusterableModel):
    name = models.CharField(max_length=255)

    panels = [
        FieldPanel('name'),
        InlinePanel('options', label='Product options'),

    ]

    def __str__(self):
        return self.name


@register_snippet
class ProductTypeOption(ClusterableModel):
    product_type = ParentalKey('catalogue.ProductType', related_name='options')
    name = models.CharField(max_length=120, blank=True, null=True, default=None)

    def __str__(self):
        return self.name


@register_snippet
class OptionValue(Orderable):
    option = ParentalKey(ProductTypeOption, related_name='option_values', blank=True, null=True, default=None)
    value = models.CharField(max_length=2)
    text = models.CharField(max_length=100)

    def __str__(self):
        return self.text


class Product(Page):
    def get_context(self, request):
        context = super().get_context(request)
        fields = []
        for f in self.custom_fields.get_object_list():
            if f.options:
                f.options_array = f.options.split('|')
                fields.append(f)
            else:
                fields.append(f)
            print(f)
        context['custom_fields'] = fields

    description = RichTextField()
    # short_description = models.TextField(blank=True, null=True)
    price = models.DecimalField(decimal_places=2, max_digits=10, default=0)
    product_type = models.ForeignKey('catalogue.ProductType', on_delete=models.SET_NULL, null=True, blank=True,
                                     default=None)
    image = models.ForeignKey(
        'wagtailimages.Image',
        null=True,
        blank=True,
        on_delete=models.SET_NULL,
        related_name='+'
    )
    content_panels = Page.content_panels + [
        # FieldPanel('sku'),
        FieldPanel('price'),
        FieldPanel('image'),
        FieldPanel('description'),
        InlinePanel('custom_fields', label='Custom fields'),
        InlinePanel('product_images', label='Product images'),
    ]


class ProductImage(models.Model):
    image = models.ForeignKey('wagtailimages.Image', on_delete=models.CASCADE)
    product = ParentalKey(Product, related_name='product_images', on_delete=models.CASCADE)


class ProductCustomField(Orderable):
    product = ParentalKey(Product, on_delete=models.CASCADE, related_name='custom_fields')
    name = models.CharField(max_length=255)
    options = models.CharField(max_length=500, null=True, blank=True)

    panels = [
        FieldPanel('name'),
        FieldPanel('options')
    ]
