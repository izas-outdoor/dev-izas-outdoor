import json

from django.conf import settings
from django.forms import TextInput
from django.forms import widgets
from django.template.loader import render_to_string
from django.utils.safestring import mark_safe
from wagtail import VERSION as WAGTAIL_VERSION
from wagtail.utils.widgets import WidgetWithScript

if WAGTAIL_VERSION >= (3, 0):
    from wagtail.telepath import register
    from wagtail.widget_adapters import WidgetAdapter
else:
    from wagtail.core.telepath import register
    from wagtail.core.widget_adapters import WidgetAdapter


class PolyfillColorInputWidget(widgets.TextInput):
    class Media:
        css = {
            "all": (
                "https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css",
            )
        }

        js = ("https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js",)

    def render(self, name, value, attrs=None, renderer=None):
        out = super().render(name, value, attrs, renderer=renderer)
        field_id = attrs["id"]

        return mark_safe(
            out
            + """
            <script>
            (function(){
                function init() {
                    $("#__FIELD_ID__").spectrum({
                        showPalette: false,
                        preferredFormat: "hex",
                        showInput: true,
                    });
                }
                if (document.readyState === 'complete') {
                    init({});
                }
                $(window).on('load', function() {
                    init();
                });
            })();
            </script>
            """.replace(
                "__FIELD_ID__", field_id
            )
        )


class ColorInputWidget(WidgetWithScript, widgets.TextInput):
    template_name = "colors/widgets/color-input-widget.html"

    def __init__(self, attrs=None):
        default_attrs = {
            "class": "color-input-widget__text-input",
        }
        attrs = attrs or {}
        attrs = {**default_attrs, **attrs}
        super().__init__(attrs=attrs)

    def render_js_init(self, id_, name, value):
        return "new ColorInputWidget({0});".format(json.dumps(id_))

    class Media:
        css = {
            "all": [
                "colors/css/color-input-widget.css",
            ]
        }
        js = [
            "colors/js/color-input-widget.js",
        ]


class ColorInputWidgetAdapter(WidgetAdapter):
    js_constructor = "colors.widgets.ColorInput"

    class Media:
        js = [
            "colors/js/color-input-widget-telepath.js",
        ]


register(ColorInputWidgetAdapter(), ColorInputWidget)


class BigColorWidget(TextInput):
    template_name = "colorfield/color.html"

    class Media:
        if settings.DEBUG:
            js = [
                "colorfield/jscolor/jscolor.js",
                "colorfield/colorfield.js",
            ]
        else:
            js = [
                "colorfield/jscolor/jscolor.min.js",
                "colorfield/colorfield.js",
            ]

    def get_context(self, name, value, attrs=None):
        context = {}
        context.update(self.attrs.copy() or {})
        context.update(attrs or {})
        context.update(
            {
                "widget": self,
                "name": name,
                "value": value,
            }
        )
        return context

    def render(self, name, value, attrs=None, renderer=None):
        return render_to_string(
            self.template_name, self.get_context(name, value, attrs)
        )


class BigColorInputWidgetAdapter(WidgetAdapter):
    js_constructor = "colors.widgets.BigColorInput"

    class Media:
        js = [
            "colors/js/color-input-widget-telepath.js",
        ]


register(BigColorInputWidgetAdapter(), BigColorWidget)
