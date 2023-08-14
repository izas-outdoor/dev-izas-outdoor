from wagtail import blocks
from wagtail.blocks import RichTextBlock
from wagtail.images.blocks import ImageChooserBlock
from wagtail_color_panel.blocks import NativeColorBlock

GRADIENT_DIRECTION_CHOICES = (
    ('none', 'None'),
    ('bottom', 'Bottom'),
    ('top', 'Top'),
    ('left', 'Left'),
    ('right', 'Right'),
)
TEXT_DIRECTION_CHOICES = (
    ('start', 'Left'),
    ('center', 'Center'),
    ('end', 'Right'),

)


class SliderBlock(blocks.StructBlock):
    # title = blocks.CharBlock(required=True, help_text="Cards Title")
    slides = blocks.ListBlock(
        blocks.StructBlock([
            ("title", RichTextBlock(required=False, label='title')),
            ("highlight", blocks.CharBlock(required=False)),
            ("image", ImageChooserBlock(required=False)),
            ("description", RichTextBlock(required=False, max_length=200)),
            ("button_page", blocks.PageChooserBlock(required=False)),
            ("external_text", blocks.CharBlock(required=False, max_length=100)),
            ('text_color', NativeColorBlock(default="#000000")),
            ('background_color', NativeColorBlock(default="#000000")),
            ('gradient_direction',
             blocks.ChoiceBlock(choices=GRADIENT_DIRECTION_CHOICES, default='none', required=False)),
            ('text_direction', blocks.ChoiceBlock(choices=TEXT_DIRECTION_CHOICES, default='start', required=False)),
            ("external_page",
             blocks.URLBlock(required=False, max_length=200, help_text="If button is selected this is ignored")),
        ])
    )

    class Meta:
        template = "streams/slider.html"
