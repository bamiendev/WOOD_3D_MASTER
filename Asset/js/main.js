/*  --------------------------------------------------- */
(function ($) {
    /*Language Selector*/
    $(document).ready(function (e){
        $(".language_drop").msDropdown({roundedBorder:false});
        $("#tech").data("dd");
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    /*------------------
        Hero Slider
    --------------------*/
    $(".hero-items").owlCarousel({
        navigation : true,
        loop: true,
        margin: 0,
        nav: true,
        items: 1,
        dots: false,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
    });

    /*------------------
        Product Slider
    --------------------*/
    $(".product-slider").owlCarousel({
        navigation : true,
        margin: 25,
        nav: true,
        items: 3,
        dots: true,
        navText: ['<i class="fa-sharp fa-light fa-arrow-left fa-beat"></i>', '<i class="fa-sharp fa-light fa-arrow-right fa-beat" style="color: #919191;"></i>'],
        smartSpeed: 1200,
        autoplay: true,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 2,
            },
            992: {
                items: 2,
            },
            1200: {
                items: 3,
            }
        }
    });

    $(".video-items").owlCarousel({
        items:2,
        merge:true,
        loop:true,
        margin:10,
        video:true,
        autoHeight: true,
        lazyLoad:false,
        center:true,
        responsive:{
            480:{
                items:2
            },
            600:{
                items:4
            }
        }
    })


    /*-----------------------
     Product Single Slider
  -------------------------*/
    $(".ps-slider").owlCarousel({
        navigation: true,
        loop: false,
        margin: 10,
        nav: true,
        items: 3,
        dots: false,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
    });
})(jQuery);
