$(document).ready(function() {

    //stickyheader
    var scrollDown = function() {
        var scroll = $(window).scrollTop();
        if (scroll > 0) {
            $('header').addClass('whitebg');
            $('.navbar-header a').addClass('smaller_scroll');
            $('.headernav ul').eq(0).addClass('padding_scroll');
            $('.headernav ul').eq(1).addClass('padding_scroll');
        };
        if (scroll < 100){
            $('header').removeClass('whitebg');
            $('.navbar-header a').removeClass('smaller_scroll');
            $('.headernav ul').removeClass('padding_scroll');
        };
    };
    $(window).scroll(function () {
        scrollDown();
    });
    scrollDown();



});