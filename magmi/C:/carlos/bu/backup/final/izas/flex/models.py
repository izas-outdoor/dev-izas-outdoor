from django.db import models
from modelcluster.fields import ParentalKey, ParentalManyToManyField
from modelcluster.models import ClusterableModel
from wagtail.admin.panels import FieldPanel, MultiFieldPanel, InlinePanel
from wagtail.fields import RichTextField
from wagtail.models import Page, Orderable
from wagtail.search import index
from wagtail.snippets.models import register_snippet


class BlogPage(Page):
    # Database fields

    body = RichTextField()
    date = models.DateField("Post date")

    feed_image = models.ForeignKey(
        'wagtailimages.Image',
        null=True,
        blank=True,
        on_delete=models.SET_NULL,
        related_name='+'
    )

    # Search index configuration

    search_fields = Page.search_fields + [
        index.SearchField('body'),
        index.FilterField('date'),

    ]

    # Editor panels configuration

    content_panels = Page.content_panels + [
        FieldPanel('date'),
        FieldPanel('body', classname="full"),
        InlinePanel('related_links', label="Related links"),
        InlinePanel('classifiers', label="Classifers")
    ]

    promote_panels = [
        MultiFieldPanel(Page.promote_panels, "Common page configuration"),
        FieldPanel('feed_image'),
    ]

    # Parent page / subpage type rules

    # parent_page_types = ['blog.BlogIndex']
    subpage_types = []


class BlogPageRelatedLink(Orderable):
    page = ParentalKey(BlogPage, on_delete=models.CASCADE, related_name='related_links')
    name = models.CharField(max_length=255)
    url = models.URLField()

    panels = [
        FieldPanel('name'),
        FieldPanel('url'),
    ]


@register_snippet
class Classifier(ClusterableModel):
    name = models.CharField(max_length=100)

    panels = [
        FieldPanel('name'),
        InlinePanel('classifier_options')
    ]

    def __str__(self):
        return self.name


@register_snippet
class ClassifierOptions(Orderable):
    title = models.CharField(max_length=250)
    classifier = ParentalKey('flex.Classifier', on_delete=models.CASCADE, related_name='classifier_options')

    def __str__(self):
        return self.title


class ClassifierPageValue(models.Model):
    classifier = ParentalManyToManyField('flex.Classifier')
    page = ParentalKey('flex.BlogPage', on_delete=models.CASCADE, related_name='classifiers', blank=True, null=True)
