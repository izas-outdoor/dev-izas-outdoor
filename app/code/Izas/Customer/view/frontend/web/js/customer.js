require([
    'jquery'
], function ($) {
    'use strict';

    var customer = {
        init: function () {
            this.addIcons().binding();
        },

        binding: function () {
            $('#nav-home-tab').on('click', $.proxy(this.showHome, this));
            $('#nav-profile-tab').on('click', $.proxy(this.showProfile, this));
            $('.menu_aside').on('click', $.proxy(this.menuAside, this));
            $('.review-add').on('click',$.proxy(this.leaveaReview, this));
            return this;
        },

        showHome: function () {
            $('#nav-profile').removeClass('active').removeClass('show');
            $('#nav-home').addClass('active').addClass('show');
        },

        showProfile: function () {
            $('#nav-home').removeClass('active').removeClass('show');
            $('#nav-profile').addClass('active').addClass('show');
        },

        addIcons: function() {
            $("#account-nav ul li").first().find("a").append('<i class="icon_user"></i>');
            $("#account-nav ul li:eq(2)").first().find("a").append('<i class="icon_home"></i>');
            $("#account-nav ul li:eq(3)").first().find("a").append('<i class="icon_user"></i>');
            return this;
        },

        menuAside: function () {
            $('.menu_account').toggleClass('open_menu');

            if ( $('.menu_account').hasClass("open_menu") ) {
                $('.menu_aside').html('<i class="fas fa-outdent"></i>');
            }else {
                $('.menu_aside').html('<i class="fas fa-indent"></i>');
            }
        },

        leaveaReview: function(){
            $(".review-add").css("display","block");
            return false;
        }
    };

    $(document).ready(function (){$.proxy(customer.init(), this);});
});
