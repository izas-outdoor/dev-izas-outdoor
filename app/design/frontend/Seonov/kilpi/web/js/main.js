require([ 'jquery' , 'owlCarousel', 'bootstrapselect', 'bootstrapjs'],function($){
    // home slider

    $(document).ready(function(){
        $(".owl-carousel").each(function(){
            $(this).on('initialize.owl.carousel', function(){
            
              $(this).find('.item').removeClass('hidden');

            });
            $(this).owlCarousel({
                loop:true,
                items:4,
                margin:10,
                nav:true,
                autoplay:true,
                autoplayTimeout:6000,
                autoplayHoverPause:false,
                responsive:{
                    0:{
                        items:1
                    },
                    648:{
                        items:1
                    },

                    1000:{
                        items:3
                    },
                    1308:{
                        items:3
                    }
                }
            });
        });
        
        $('.hidden-md-down[data-item="6"]').addClass('outlet');
        
    
        $('.loading-mask .loader').remove();
        $('#checkout-loader .loader').remove();
    });
    $('#newsletter-popin-subscribe-footer').on('submit', function(e){
        e.preventDefault();
        email = $('#newsletter-popin-email-footer').val();
        $('.footer-newsletter-error').addClass('hidden');
        $('.footer-newsletter-error-email').addClass('hidden');
        $('.footer-newsletter-success').addClass('hidden');
        var $form = $(e.currentTarget);
        if (email != "") {
            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: $form.serialize(),
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        $('.footer-newsletter-success').removeClass('hidden');
                    } else {
                        $('.footer-newsletter-error').removeClass('hidden');
                    }
                }
            });
        }else{
            $('.footer-newsletter-error-email').removeClass('hidden');
        }
    });
    $('#footer-newsletter').on('submit', function(e){
        e.preventDefault();
        email = $('#newsletter-popin-email-footer').val();
        $('.footer-newsletter-error').addClass('hidden');
        $('.footer-newsletter-error-email').addClass('hidden');
        $('.footer-newsletter-success').addClass('hidden');
        var $form = $(e.currentTarget);
        if (email != "") {
            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: $form.serialize(),
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        $('.footer-newsletter-success').removeClass('hidden');
                    } else {
                        $('.footer-newsletter-error').removeClass('hidden');
                    }
                }
            });
        }else{
            $('.footer-newsletter-error-email').removeClass('hidden');
        }
    });

    $( ".links li" ).first().addClass( "newsletter-popup-listener" );
    $("ul.links li:nth-child(2)").addClass( "store-searcher-link" );
    $( ".links li.newsletter-popup-listener a" ).removeAttr("href");
    $( ".links li.newsletter-popup-listener a" ).prepend('<i class="fas fa-envelope"></i>');
    $( ".links li.store-searcher-link a" ).prepend('<i class="fas fa-store-alt"></i>');
    $('.minisearch').click(function () {
        $(".minisearch").removeClass("active");
        // $(".tab").addClass("active"); // instead of this do the below 
        $(this).addClass("active");   
    });

    $('#confirm-conditions').prop('checked', false);
    $('#confirm-conditions').change(function() {
        if(this.checked) {
            $(".checkout").prop('disabled', false);
        }else{
            $(".checkout").prop('disabled', true);
        }
    });
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");

        /* Toggle between hiding and showing the active panel */
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
        panel.style.display = "none";
        } else {
        panel.style.display = "block";
        }
    });
    }
});

// document.querySelectorAll('.category-list').forEach(c=>{
//     c.addEventListener("mouseenter",function(e){
//         c.closest('header').addClass('hover')
//         c.getElementsByClassName('submenu-container').removeClass('hidden')
//     })
// })
// document.querySelectorAll('.category-list').forEach(c=>{
//     c.addEventListener("mouseleave",function(e){
//         c.closest('header').removeClass('hover')
//         c.getElementsByClassName('submenu-container').addClass('hidden')
//     })
// })

// document.querySelectorAll('category-list').addEventListener("mouseleave",function(e){
//     this.closest('header').removeClass('hover')
//     this.getElementsByClassName('submenu-container').addClass('hidden')

// })