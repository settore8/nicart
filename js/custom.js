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


$('.woocommerce-product-gallery__wrapper a').swipebox({
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


$(document).on('click','#chiudimodal', function() {
    $('#modalspedizione').hide();
    setCookie('nicart_modal_dismissed', 'true', 1);
});


$(document).on('click','#modalspedizione', function() {
    $('#modalspedizione').hide();
});

// Set a cookie to remember if the user has dismissed the modal
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

// Check if the cookie exists
function checkCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return true;
        }
    }
    return false;
}

function is_cookie_expired(cookieName, expirationDays) {
    var cookieValue = checkCookie(cookieName);
    if (cookieValue) {
        var expirationDate = new Date();
        expirationDate.setDate(expirationDate.getDate() + expirationDays);
        var currentTimestamp = new Date().getTime();
        var expirationTimestamp = expirationDate.getTime();
        if (currentTimestamp > expirationTimestamp) {
            // Cookie has expired
            return true;
        } else {
            // Cookie is still valid
            return false;
        }
    } else {
        // Cookie is not set
        return true;
    }
}

setTimeout(function(){
    if (!checkCookie('nicart_modal_dismissed') || is_cookie_expired('nicart_modal_dismissed', 1)) {
        $('#modalspedizione').show();
    }
}, 20000);

 
document.addEventListener('DOMContentLoaded', () => {
  const faqs = document.querySelectorAll('.faq');

  faqs.forEach(faq => {
    const title = faq.querySelector('h3');
    const content = faq.querySelector('.entry-content');

    title.addEventListener('click', () => {
      const isOpen = faq.classList.contains('is-open');

      // 🔒 chiude le altre (rimuovi questo blocco se vuoi più FAQ aperte)
      faqs.forEach(item => {
        item.classList.remove('is-open');
        const c = item.querySelector('.entry-content');
        c.style.maxHeight = null;
      });

      if (!isOpen) {
        faq.classList.add('is-open');
        content.style.maxHeight = content.scrollHeight + 'px';
      }
    });
  });
});