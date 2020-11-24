
$(document).ready(function () {

    $(window).scrollTop() > 0 ? $('.navbar.scrolling-navbar').addClass('top-nav-collapse') : $('.navbar.scrolling-navbar').removeClass('top-nav-collapse');

    /* scroll spy */
    $(function () {
        $('a.nav-link[href*="#"] , a.btn[href*="#"]').on('click', function (event) {
            var $anchor = $(this);
            var scrollValue = ($($anchor.attr('href')).offset().top - $('.navbar').height());
            $('html,body').stop().animate({
                scrollTop: scrollValue
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });
    });

    $('.c-hamburger--htx').on('click', ()=>{
        $('.c-hamburger--htx').toggleClass('is-active');
    });

    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() == $(document).height()) {
            $('.mobile-hamburger-menu').removeClass('fadeIn');
            $('.mobile-hamburger-menu').addClass('fadeOut');
        } else{
            $('.mobile-hamburger-menu').removeClass('fadeOut');
            $('.mobile-hamburger-menu').addClass('fadeIn');
        }
    });
})