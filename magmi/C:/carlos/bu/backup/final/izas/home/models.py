from wagtail.admin.panels import FieldPanel
from wagtail.fields import StreamField
from wagtail.models import Page

from streams import blocks


# from catalogtest.models import Product


class HomePage(Page):
    template = "home/home_page.html"
    body = StreamField([
        ("slider", blocks.SliderBlock()),
    ], default=None, use_json_field=True, null=True, blank=True)

    content_panels = Page.content_panels + [
        FieldPanel("body", classname="Full"),
    ]

    class Meta:
        verbose_name = "Home Page"
        verbose_name_plural = "Home Pages"
