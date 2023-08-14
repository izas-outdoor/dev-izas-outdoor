from django.db import models
from wagtail.admin.panels import FieldPanel, FieldRowPanel
from wagtail.models import PreviewableMixin
from wagtail.snippets.models import register_snippet

from colors.edit_handlers import NativeColorPanel
from colors.fields import ColorField

COLOR_PALETTE = [
    ("#FFFFFF", "white",),
    ("#000000", "black",),
]


# Create your models here.
def unslugify(value):
    value = value.replace('tone-', 'tone: ').capitalize()
    value = value.split()
    return f'{value[0]}{value[1].upper()}'


def get_dec(hex_color):
    if hex_color.upper() == 'F':
        return 15
    if hex_color.upper() == 'E':
        return 14
    if hex_color.upper() == 'D':
        return 13
    if hex_color.upper() == 'C':
        return 12
    if hex_color.upper() == 'B':
        return 11
    if hex_color.upper() == 'A':
        return 10

    return int(hex_color)


def get_hex(dec):
    if dec == 15:
        return 'F'
    if dec == 14:
        return 'E'
    if dec == 13:
        return 'D'
    if dec == 12:
        return 'C'
    if dec == 11:
        return 'B'
    if dec == 10:
        return 'A'
    return '' + str(dec)


def hex_to_dec(c, start):
    c1 = get_dec(c[start:start + 1])
    c2 = get_dec(c[start + 1:start + 2])
    # c2 = get_dec(c.substring(start+1,start+2))
    return (c1 * 16) + c2 * 1


def web_safe(r, g, b):
    tmp = r % 51
    if tmp > 25:
        tmp = r + 51 - tmp
    else:
        tmp = r - tmp
    c1 = get_hex(round(tmp / 17))

    tmp = g % 51
    if tmp > 25:
        tmp = g + 51 - tmp
    else:
        tmp = g - tmp
    c2 = get_hex(round(tmp / 17))

    tmp = b % 51
    if tmp > 25:
        tmp = b + 51 - tmp
    else:
        tmp = b - tmp
    c3 = get_hex(round(tmp / 17))
    return c1 + c1 + c2 + c2 + c3 + c3


@register_snippet
class Color(PreviewableMixin, models.Model):
    code = models.CharField(max_length=3)
    name = models.CharField(max_length=100)
    pantone_name = models.CharField(null=True, blank=True, max_length=100)
    pantone_chart_code = models.CharField(null=True, blank=True, max_length=25)
    hex_color = ColorField(default="#000000")
    red = models.SmallIntegerField(null=True, blank=True, default=0)
    green = models.SmallIntegerField(null=True, blank=True, default=0)
    blue = models.SmallIntegerField(null=True, blank=True, default=0)

    panels = [
        FieldRowPanel([
            FieldPanel("code"),
            FieldPanel("name"),
        ]),
        FieldRowPanel([
            FieldPanel("pantone_name"),
            FieldPanel("pantone_chart_code"),
        ]),
        NativeColorPanel("hex_color"),
        # NativeColorPanel("hex_color2"),
        # NativeColorPanel("hex_color3"),
        FieldRowPanel([
            FieldPanel("red"),
            FieldPanel("green"),
            FieldPanel("blue"),
        ]),
    ]

    def __str__(self):
        return f'{self.code}/{self.name}'.upper()

    def get_preview_template(self, request, mode_name):
        return "colors/pantone.html"

    @property
    def unslug_pantone(self):
        return unslugify(self.pantone_chart_code)

    @property
    def web_safe_color(self):
        r1 = hex_to_dec(self.hex_color[1:], 0)
        g1 = hex_to_dec(self.hex_color[1:], 2)
        b1 = hex_to_dec(self.hex_color[1:], 4)

        result = web_safe(r1, g1, b1)
        r2 = hex_to_dec(result, 0)
        g2 = hex_to_dec(result, 2)
        b2 = hex_to_dec(result, 4)

        return result
