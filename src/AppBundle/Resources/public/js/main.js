$(document).ready(function() {
    /* Every time the window is scrolled ... */
    $(window).scroll( function(){

        /* Check the location of each desired element */
        $('.hideme').each( function(i){

            var bottom_of_object = $(this).offset().top + $(this).outerHeight();
            var bottom_of_window = $(window).scrollTop() + $(window).height();

            /* If the object is completely visible in the window, fade it it */
            if( bottom_of_window > bottom_of_object - 400 ){

                if ( $(this).hasClass('hide-left') ){
                    $(this).animate({'left':'0px'},500);
                }else if ( $(this).hasClass('hide-right') ){
                    $(this).animate({'right':'0px'},500);
                }

            }

        });

    });

    $(window).trigger('scroll');

});

$(window).scroll(function() {
    if ($(document).scrollTop() > 315) {
        $('nav').addClass('shrink');
        $('.navbar-brand .useravatar').removeAttr('hidden');
    } else {
        $('nav').removeClass('shrink');
        $('.navbar-brand .useravatar').attr('hidden', 'hidden');
    }


});

$(function(){
    var navMain = $("#nav-main");
    navMain.on("click", "a", null, function () {
        navMain.collapse('hide');
    });
});