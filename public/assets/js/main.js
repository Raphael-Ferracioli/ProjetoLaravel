(function ($) {
    "use strict";

    /* ================= PRELOADER ================= */
    $(window).on('load', function () {
        $('#ctn-preloader').fadeOut();
        $('#preloader').delay(300).fadeOut('slow');
        $('body').css({ 'overflow': 'visible' });
    });

    /* ================= STICKY HEADER ================= */
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 200) {
            $(".main-header-area").addClass("sticky-menu");
        } else {
            $(".main-header-area").removeClass("sticky-menu");
        }
    });

    /* ================= SLICK SLIDERS ================= */
    $('.ht-carousel').not('.slick-initialized').slick({
        autoplay: true,
        autoplaySpeed: 4000,
        arrows: true,
        dots: false,
        speed: 800,
        slidesToShow: 1
    });

    $('.author-thumb-slider').slick({
        slidesToShow: 1,
        fade: true,
        arrows: false,
        asNavFor: '.author-content-slider'
    });

    $('.author-content-slider').slick({
        slidesToShow: 1,
        autoplay: true,
        arrows: true,
        asNavFor: '.author-thumb-slider'
    });

    /* ================= COUNTER ================= */
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });

    /* ================= POPUP VIDEO ================= */
    $('.popup-video').magnificPopup({
        type: 'iframe'
    });

    /* ================= WOW ANIMATION ================= */
    new WOW({
        boxClass: 'wow',
        animateClass: 'animated',
        offset: 0,
        mobile: true,
        live: true
    }).init();

})(jQuery);
