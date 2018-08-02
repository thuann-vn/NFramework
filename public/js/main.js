const eApp = {
    init: function(){
        this.initStickyNav();
        this.initScrollToAchor();
        this.initCartButton();
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
        var addToCartButton = $('.add-to-cart.not-added');
        addToCartButton.click(function(e){
            e.preventDefault();

            axios.post(ROUTES.cart.add_to_cart, {
                'id' : $(this).data('id')
            }).then(function (response) {
                var modal = $(response.data);
                $('body').append(modal);
                modal.show();
            })
        });

        $(document).on('click', '.modal-remove', function(e){
            e.preventDefault();
            $(this).parents('.modal').remove();
        })
    },
    initScrollToAchor: function(){
        $('.scrollToAnchor').click(function(e){
            e.preventDefault();
            var target = $(this).attr('href');
            var offset = $(this).data('offset');
            $('html, body').animate({
                scrollTop: $(target).offset().top - (offset?parseInt(offset):100)
            }, 300);
        })
    }
}

$(document).ready(function() {
    eApp.init();
});
