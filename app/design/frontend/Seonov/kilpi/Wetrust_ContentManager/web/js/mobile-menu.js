require([
    'jquery',
    'underscore',
    'jquerymmenu'
], function ($, _) {
    var mobileMenu = {
        container: '.page-header',
        minSearchLength: 3,
        data: null,

        init: function () {
            if (typeof menuJson != "undefined") {
                this.data = menuJson;
                this.unbinding()
                    .generateMenu()
                    .initMenu()
                    .binding();
            }
        },

        unbinding: function () {
            $('.menu-mobile .icon-menu').off('click', this.toggleMenu);

            return this;
        },

        binding: function () {
            $('.menu-mobile .icon-menu').on('click', $.proxy(this.toggleMenu, this));
            $('.top-link.basket').on('click', $.proxy(this.toggleMinicart, this));
            $('#mobile_search_mini_form').on('submit', $.proxy(this.search, this));
            $('.hidden-md-down[data-item="6"]').addClass('outlet');
            return this;
        },

        generateMenu: function () {
            var self = this;
            var $container = $(this.container);
            var $nav = $('<nav>').attr('id', 'mobile-menu');
            var $list = $('<ul>');
            var $item;

            _.forEach(this.data.items, function (value) {
                $item = self.generateItem(value, $list);
                $list.append($item);
            });

            $nav.append($list);
            $container.append($nav);

            return this;
        },

        decodeEntities : function (encodedString) {
            var textArea = document.createElement('textarea');
            textArea.innerHTML = encodedString;
            return textArea.value;
        },

        generateItem: function (value, $container) {
            var self = this;
            if(value.classname === undefined){
                value.classname = "";
            }

            var $item = $('<li class="'+value.classname+'">');
            var $list;

            if (value.children) {
                $('<span>').text(self.decodeEntities(value.title)).appendTo($item);

                if (value.menu_mode === 'category') {
                    value.children.unshift({
                        title: this.data.translations.viewAll,
                        href: value.href,
                        active: value.active
                    });
                }

                $list = $('<ul>');
                _.forEach(value.children, function (child) {
                    $list.append(self.generateItem(child, $list));
                });
                $item.append($list);
            } else if (value.href) {
                $item.toggleClass('active', value.active);
                $('<a>').attr('href', value.href).text(value.title).appendTo($item);
            }

            return $container.append($item);
        },

        initMenu: function () {
            $('#mobile-menu').mmenu({
                offCanvas: {
                    position : 'left',
                },
                extensions: [
                    'border-full',
                    'position-left',
                    'effect-menu-slide',
                    'pagedim-black',
                    'theme-white'
                ],
                navbar: {
                    title: this.data.translations.menu
                },
                navbars: [
                    {
                        content: [
                            'prev',
                            'title',
                            'close'
                        ],
                        position: 'top'
                    },
                    {
                        "position": "middle",
                        "content": [menuJsonMiddle.content]
                    },
                    {
                        "position": "bottom",
                        "content": [menuJsonBottom.content]
                    }
                ]
            }, {
                classNames: {
                    selected: 'active'
                }
            });

            this.menu = $('#mobile-menu').data('mmenu');

            return this;
        },

        toggleMenu: function () {
            this.menu.open();
        },

        toggleMinicart: function(e) {
            e.preventDefault();
            var $minicart = $('.block-minicart');
            $minicart.parent('.ui-dialog').toggle();
        },

        search: function (e) {
            var $input = $('#mobile_search');
            if ($input.val().length < this.minSearchLength) {
                e.preventDefault();
                $input.addClass('search-error');
                setTimeout(function() {
                    $input.removeClass('search-error');
                }, 1000);
            } else {
                $input.removeClass('search-error');
            }
        }
    };

    $(document).ready($.proxy(mobileMenu.init, mobileMenu));
});