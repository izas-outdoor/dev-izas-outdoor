import pandas as pd
import os

os.environ.setdefault("DJANGO_SETTINGS_MODULE", "sizas.settings.dev")
import django

django.setup()
from catalogue.models import Category
from home.models import HomePage, ListingPage

data = pd.read_csv("catss.csv")
token = None
entity = 0
cat = None
prev = 0
parent = None
for index, row in data.iterrows():
    print("#######################")
    print(index, row)
    if not entity:
        entity = row['entity_id']

    # prev = row['entity_id']
    category_name = row['value']
    locale = row['order']

    # if not parent:
    if row['parent'] < 3:

        parent = ListingPage.objects.get(depth=3, locale_id=locale, slug='categorias')
    else:
        print({'locale_id': locale, 'old_id': row['parent']})
        try:
            print(row['parent'],locale)
            parent = Category.objects.get(locale_id=locale, old_id=row['parent'])
        except:
            parent = ListingPage.objects.get(depth=3, locale_id=locale, slug='categorias')

    if prev != row['entity_id']:
        token = None
        prev = row['entity_id']

    cat = Category(title=category_name)
    cat.old_id = row['entity_id']
    cat.old_parent=row['parent']
    cat.show_in_menus = True
    cat.locale_id = locale
    print(cat.locale,token)
    parent.add_child(instance=cat)
    if token and cat:
        cat.translation_key = token
    cat.save()
    if not token:
        token = cat.translation_key
    pass
