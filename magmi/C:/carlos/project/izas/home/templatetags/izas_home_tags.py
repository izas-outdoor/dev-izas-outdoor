from django import template
import math

register = template.Library()

@register.filter
def multiply_and_round(value, factor):
    return int(round(value * (factor if factor is not None else 1)))