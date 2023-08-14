from wagtail import blocks


class ClassifierBlock(blocks.StructBlock):
    single_selection_classifier=blocks.ChoiceBlock()
