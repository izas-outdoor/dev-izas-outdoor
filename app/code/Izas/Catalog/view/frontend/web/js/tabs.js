(function ($) {
    var tabs = {
        init: function () {
            this.unbinding().binding();
        },

        unbinding: function () {
            return this;
        },

        binding: function () {
            $('li.category-link a').on('click', $.proxy(this.showProducts, this));
            $('.section.attribute a.title').on('click', $.proxy(this.showInfo, this));
            return this;
        },

        showProducts: function (e) {
            e.preventDefault();
            var target = $(e.target).parent();
            var category = target.data('category');
            if (category) {
                $('li.category-link').removeClass('active');
                target.addClass('active');
                $('.products.wrapper').addClass('hidden');
                $('.products.wrapper[data-category="' + category + '"]').removeClass('hidden');
            }
        },

        showInfo: function (e) {
            e.preventDefault();
            var $target = $(e.currentTarget);
            var attribute = $target.data('attribute');
            if (attribute) {
                $('.section.attribute a.title').removeClass('active');
                $target.addClass('active');
                $('.section .value').addClass('hidden');
                $('.section .value[data-attribute="' + attribute + '"]').removeClass('hidden');
            }
        }
    };

    $(document).ready($.proxy(tabs.init, tabs));

})(jQuery);