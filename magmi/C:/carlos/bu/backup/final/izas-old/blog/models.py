from django.db import models
from django.utils import timezone

from wagtail.admin.panels import FieldPanel, StreamFieldPanel, MultiFieldPanel
from wagtail import blocks
from wagtail.fields import StreamField, RichTextField
# from wagtail.images.edit_handlers import ImageChooserPanel

from materializecss.blocks import MaterializePage, get_headings, get_components, \
    Collection, Carousel
from materializecss.javascript import Parallax


class BloggerHomePage(MaterializePage):
    author = models.CharField(max_length=255)
    background_image = models.ForeignKey('wagtailimages.Image', on_delete=models.SET_NULL, null=True, related_name='+')
    user_image = models.ForeignKey('wagtailimages.Image', on_delete=models.SET_NULL, null=True, related_name='+')

    intro = RichTextField(blank=True)

    content_panels = MaterializePage.content_panels + [
        MultiFieldPanel([
            FieldPanel('author'),
            FieldPanel('background_image'),
            FieldPanel('user_image'),
        ], heading="Author Fields", ),
        FieldPanel('intro', classname="full"),
    ]

    subpage_types = ['blog.BlogPage', 'blog.ParallaxPage', 'blog.DynamicParallaxPage']

    def get_context(self, request):
        # Update context to include only published posts, ordered by reverse-chron
        context = super().get_context(request)
        blogpages = self.get_children().live().order_by('-first_published_at')
        context['blogpages'] = blogpages
        return context


class BlogPage(MaterializePage):
    date = models.DateField("Post date", default=timezone.now)
    description = RichTextField(blank=True)
    body = StreamField([
        *get_headings(exclude=['h1', 'h2']),
        ('paragraph', blocks.RichTextBlock(icon='pilcrow')),
        ('collection', Collection()),
        ('gallery', Carousel()),
        *get_components(),
    ],use_json_field=False)

    content_panels = MaterializePage.content_panels + [
        MultiFieldPanel([
            FieldPanel('date'),
            FieldPanel('description', classname='full'),
        ], heading="Document Fields", ),
        FieldPanel('body'),
    ]

    parent_page_types = ['blog.BloggerHomePage']

    @property
    def author(self):
        return self.get_parent().specific.author

    @property
    def user_image(self):
        return self.get_parent().specific.user_image


class ParallaxPage(MaterializePage):
    date = models.DateField("Post date", default=timezone.now)
    description = RichTextField(blank=True)
    parallax1 = models.ForeignKey('wagtailimages.Image', on_delete=models.SET_NULL, null=True, related_name='+')
    parallax2 = models.ForeignKey('wagtailimages.Image', on_delete=models.SET_NULL, null=True, related_name='+')
    body = StreamField([
        *get_headings(exclude=['h1', 'h2']),
        ('paragraph', blocks.RichTextBlock(icon='pilcrow')),
        ('collection', Collection()),
        ('gallery', Carousel()),
        *get_components(),
    ],use_json_field=False)

    content_panels = MaterializePage.content_panels + [
        MultiFieldPanel([
            FieldPanel('date'),
            FieldPanel('description', classname='full'),
        ], heading="Document Fields", ),
        MultiFieldPanel([
            FieldPanel('parallax1'),
            FieldPanel('parallax2'),
        ], heading="Parallax", ),
        FieldPanel('body'),
    ]

    parent_page_types = ['blog.BloggerHomePage']

    @property
    def author(self):
        return self.get_parent().specific.author

    @property
    def user_image(self):
        return self.get_parent().specific.user_image


class DynamicParallaxPage(MaterializePage):
    date = models.DateField("Post date", default=timezone.now)
    description = RichTextField(blank=True)
    body = StreamField([
        *get_headings(exclude=['h1', 'h2']),
        ('paragraph', blocks.RichTextBlock(icon='pilcrow')),
        ('parallax', Parallax()),
        ('collection', Collection()),
        ('gallery', Carousel()),
        *get_components(),
    ],use_json_field=False)

    content_panels = MaterializePage.content_panels + [
        MultiFieldPanel([
            FieldPanel('date'),
            FieldPanel('description', classname='full'),
        ], heading="Document Fields", ),
        FieldPanel('body'),
    ]

    parent_page_types = ['blog.BloggerHomePage']

    @property
    def author(self):
        return self.get_parent().specific.author

    @property
    def user_image(self):
        return self.get_parent().specific.user_image
