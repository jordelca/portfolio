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