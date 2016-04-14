$(window).scroll(function() {
    if ($(document).scrollTop() > 50) {
        $('nav').addClass('shrink');
    } else {
        $('nav').removeClass('shrink');
    }
});

$(function(){
    var navMain = $("#nav-main");
    navMain.on("click", "a", null, function () {
        navMain.collapse('hide');
    });
});