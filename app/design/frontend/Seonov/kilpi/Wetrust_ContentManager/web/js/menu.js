require([
    'jquery'
], function ($) {
    var menu = {
        menuContainerSelector: '.submenu-container',
        menuWrapperSelector: '.category-list',
        header: '.page-header',
        active: false,

        init: function () {
            this.binding();
			$('.hidden-md-down[data-item="6"]').addClass('outlet');
        },

        binding: function () {
            $(this.menuWrapperSelector + ' > li').on('mouseenter', $.proxy(this.showCategories, this));
            $(this.header + ' .submenu-wrapper').on('mouseleave', $.proxy(this.hideMenu, this));
         //   $('.top-link.search').on('click', $.proxy(this.openMobileSearch, this));
         //   $('.search.icon').on('click', $.proxy(this.openSearch, this));
            $(window).on('scroll', $.proxy(this.scroll, this));

            return this;
        },

        hideMenu: function () {
            var self = this;
            if (self.active === false) {
                return true;
            }
            $(self.header).removeClass('hover');
            // $(self.header).removeClass('hover');
            self.active.addClass('hidden');
            self.active = false;
            return true;
        },

        showCategories: function (e) {
            var self = this;
            var item = $(e.currentTarget).data('item');
            self.hideMenu();

            if (item) {
                var $element = $(self.menuContainerSelector + '[data-item=' + item + ']');
                if ($element.length > 0) {
                    $(self.header).addClass('hover');
                    self.active = $element;
                    self.active.removeClass('hidden');
                }
            }
            return this;
        },

        openMobileSearch: function (e) {
            e.preventDefault();
            $('.icon-menu').trigger('click');
            $('#mobile_search').focus();
        },

        openSearch: function (e) {
            e.preventDefault();
            $('.block.block-search .block-content').toggleClass('hidden');
        },

        scroll: function (e) {
            var target = $(e.currentTarget);
            if (target.scrollTop() > 200) {
                $(".page-header").addClass('scrolled');
            } else {
                $(".page-header").removeClass('scrolled');
            }
        }
    };

    $(document).ready($.proxy(menu.init, menu));
});
