const eProduct = {
    init: function(){
        this.initSlider();
    },
    initSlider: function(){
        $('.product-vertical-slider').slick({
            vertical: true,
            arrows: true,
            dots: false,
            slidesToShow: 7,
            slidesToScroll: 1,
            infinite: false,
            draggable: false,
        });
    },
}

$(document).ready(function() {
    eProduct.init();
});
