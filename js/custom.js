$(document).ready(function() {
    $('.gallery a').addClass('swipebox');
    $('.entry-content a img').parents('a').addClass('swipebox');
    $('.logged-out #topBar ul li.menu_areariservata a').wrapInner('<span class="hidden-xs"> </span>').prepend('<i class="icon-lock"></i> ');
    $('.logged-in #topBar ul li.menu_areariservata a').wrapInner('<span class="hidden-xs"> </span>').prepend('<i class="icon-lock-open"></i> ');
    $('li.divider').html('<span class="divider-line"></span>');

    $('#contactButton').click(function() {
        $('html, body').animate({
            scrollTop: $("#contactSection").offset().top
        }, 500);
    });


    $('.slide').slick({
        autoplay: true,
        autoplaySpeed: 3500,
        lazyLoad: 'ondemand',
        dots: true,
        responsive: [{
            breakpoint: 768,
            settings: {
                dots: false,
            }
        }]
    });

    $('.productSlider').slick({
        autoplay: true,
        autoplaySpeed: 3500,
        lazyLoad: 'ondemand',
        dots: true,
        arrows: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                dots: false,
            }
        }]
    });


    $('#socializeToggle').on('click', function() {
        $('#socialize').slideToggle();
    });


    $('#lista_regioni').change(function() {
        var t = '#reg-' + $(this).val();
        console.log(t);
        $('html, body').animate({
            scrollTop: $(t).offset().top - 100
        }, 500);
    });


});


$(window).scroll(function(e) {
    var $el = $('#lista_regioni_container');
    var isPositionFixed = ($el.css('position') == 'fixed');

    if ($(this).scrollTop() > 450 && !isPositionFixed) {
        $('#lista_regioni_container').css({ 'position': 'fixed', 'top': '0px' }).addClass('fixed');
    }
    if ($(this).scrollTop() < 450 && isPositionFixed) {
        $('#lista_regioni_container').css({ 'position': 'static', 'top': '0px' }).removeClass('fixed');
    }
});



$('.swipebox').swipebox({
    useCSS: true, // false will force the use of jQuery for animations
    useSVG: true, // false to force the use of png for buttons
    initialIndexOnArray: 0, // which image index to init when a array is passed
    hideCloseButtonOnMobile: false, // true will hide the close button on mobile devices
    removeBarsOnMobile: true, // false will show top bar on mobile devices
    hideBarsDelay: 3000, // delay before hiding bars on desktop
    videoMaxWidth: 1140, // videos max width
    beforeOpen: function() {}, // called before opening
    afterOpen: null, // called after opening
    afterClose: function() {}, // called after closing
    loopAtEnd: false // true will return to the first image after the last image is reached
});