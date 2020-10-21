
$(document).ready(function () {
    new WOW().init();
    if($(window).width() > 991){
        $('.image-left-text-right-wrapper .text-right-front .content').each( (index, value)=>{
            var content = $(value);
            var parent = $(content).parent();
            if($(content).outerHeight() >= 520){
                parent.css('height', $(content).outerHeight() + 60 + 'px');
            }else{
                parent.css('height', 560 + 'px');
            }
        });
    }

    $(window).on('resize', function(){
        if($(window).width() <= 991){
            $('.image-left-text-right-wrapper .text-right-front .content').each( (index, value)=>{
                var content = $(value);
                var parent = $(content).parent();
                parent.css('height', 'auto');
            });
        }else{
            $('.image-left-text-right-wrapper .text-right-front .content').each( (index, value)=>{
                var content = $(value);
                var parent = $(content).parent();
                if($(content).outerHeight() >= 520){
                    parent.css('height', $(content).outerHeight() + 60 + 'px');
                }else{
                    parent.css('height', 560 + 'px');
                }
            });
        }
    });
    /* scroll spy */
    $(function () {
        $('.nav-item a, a.btn[href*="#"]').on('click', function (event) {
            var $anchor = $(this);
            var scrollValue = ($($anchor.attr('href')).offset().top - 130);
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
            $('.bottom-bar').removeClass('d-block');
            $('.bottom-bar').addClass('d-none');
        } else{
            $('.mobile-hamburger-menu').removeClass('fadeOut');
            $('.mobile-hamburger-menu').addClass('fadeIn');
            $('.bottom-bar').removeClass('d-none');
            $('.bottom-bar').addClass('d-block');
        }
    });
})