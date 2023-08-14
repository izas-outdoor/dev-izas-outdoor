from wagtail.models import Page

from .models import CategoryPage




def unslugify(value):
    return value.replace('-', ' ').capitalize()



def create_from_sequence(bits):
    """
    Create categories from an iterable
    """
    if len(bits) == 1:
        # Get or create root node
        name = bits[0]
        try:
            # CategoryPage names should be unique at the depth=1
            root = CategoryPage.objects.get(slug=name)
        except Page.DoesNotExist:
            root = CategoryPage.add_root(title=unslugify(name).capitalize())
        except CategoryPage.MultipleObjectsReturned:
            raise ValueError((
                                 "There are more than one categories with name "
                                 "%s at depth=1") % name)
        return [root]
    else:
        parents = create_from_sequence(bits[:-1])
        parent, name = parents[-1], bits[-1]
        try:
            child = parent.get_children().get(title=unslugify(name).capitalize())
        except Page.DoesNotExist:
            child=CategoryPage(title=unslugify(name).capitalize())
            child = parent.add_child(instance=child)
        except CategoryPage.MultipleObjectsReturned:
            raise ValueError((
                                 "There are more than one categories with name "
                                 "%s which are children of %s") % (name, parent))
        parents.append(child)
        return parents


def create_from_breadcrumbs(breadcrumb_str, separator='>'):
    """
    Create categories from a breadcrumb string
    """
    CategoryPage_names = [x.strip() for x in breadcrumb_str.split(separator)]
    categories = create_from_sequence(CategoryPage_names)
    return categories[-1]
