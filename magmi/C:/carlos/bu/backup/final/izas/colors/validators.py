import re

from django.core.validators import RegexValidator
from django.utils.translation import gettext_lazy as _

hex_triplet_validator = RegexValidator(
    re.compile("^#[A-Fa-f0-9]{6}$"),
    message=_("Enter a valid color hash."),
    code="invalid",
)




COLOR_HEX_RE = re.compile("^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$")
color_hex_validator = RegexValidator(
    COLOR_HEX_RE,
    _("Enter a valid hex color, eg. #000000"),
    "invalid",
)


COLOR_HEXA_RE = re.compile("#([A-Fa-f0-9]{8}|[A-Fa-f0-9]{4})$")
color_hexa_validator = RegexValidator(
    COLOR_HEXA_RE,
    _("Enter a valid hexa color, eg. #00000000"),
    "invalid",
)