const eApp = {
    init: function(){
        this.initStickyNav();
    },
    initStickyNav: function(){
        // grab the initial top offset of the navigation
        var stickyNavTop = 250;

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
    },
    initCartButton: function(){
        var addToCartButton = $('.add-to-card.not-added');
        addToCartButton.click(function(e){
            e.preventDefault();
        })
    }
}

$(document).ready(function() {
    eApp.init();
});
