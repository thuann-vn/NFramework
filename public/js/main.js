$(document).ready(function() {
    // grab the initial top offset of the navigation
    var stickyNavTop = $('header').offset().top;

    var lastScrollPosition = 0;

    // our function that decides weather the navigation bar should have "fixed" css position or not.
    var stickyNav = function(){
        var scrollTop = $(window).scrollTop(); // our current vertical position from the top

        // if we've scrolled more than the navigation, change its position to fixed to stick to top,
        // otherwise change it back to relative
        if (scrollTop > stickyNavTop) {
            $('header').addClass('sticky');
        } else {
            $('header').removeClass('sticky');
        }

        if(lastScrollPosition> scrollTop){
            $('header').addClass('active');
        }else{
            $('header').removeClass('active');
        }

        lastScrollPosition = scrollTop;
    };

    stickyNav();
    // and run it again every time you scroll
    $(window).scroll(function() {
        stickyNav();
    });
});