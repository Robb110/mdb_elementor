jQuery(document).ready(function () {
    //new WOW().init();

    /* scroll spy */
    jQuery(function () {
        jQuery('a[href*="#"]').on('click', function (event) {
            var $anchor = jQuery(this);
            var scrollValue = (jQuery($anchor.attr('href')).offset().top - jQuery('.navbar').height());
            jQuery('html,body').stop().animate({
                scrollTop: scrollValue
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });
    });

    function findGetParameter(parameterName) {
        var result = null,
            tmp = [];
        var items = location.search.substr(1).split("&");
        for (var index = 0; index < items.length; index++) {
            tmp = items[index].split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        }
        return result;
    }

    if($('#thank-you-email-page').length > 0){
        window.location.href= "mailto:" + findGetParameter('email');
    }else if($('#thank-you-phone-page').length > 0){
        window.location.href = "tel:" + findGetParameter('phone');
    }
});

function toggleFullscreenHamburgerMenu(wrapper){
    let body = document.querySelector('body');
    body.classList.toggle(wrapper);
}

function closeFullscreenHamburgerMenu(wrapper){
    let body = document.querySelector('body');
    body.classList.remove(wrapper);
};