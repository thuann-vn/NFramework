const eProduct = {
    init: function(){
        this.initSlider();
        this.initVariant();
        this.initRelatedProducts();
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
    initVariant: function(){
        $('.product-variant').click(function(){
            $('.product-price').text($(this).data('price-text'));
            $('[name="price"]').val($(this).data('price'));
            $('.product-section-image > img').attr('src', $(this).find('img').attr('src'));
        })
    },
    initRelatedProducts: function(){
        $('.related-products') .slick({
            infinite: true,
            slidesToShow: 8,
            slidesToScroll: 8,
            autoplay: true,
            autoplaySpeed: 3000,
            dots: true,
        });
        $('.similar-products') .slick({
            infinite: true,
            slidesToShow: 8,
            slidesToScroll: 8,
            autoplay: true,
            autoplaySpeed: 3000,
            dots: true,
            centerMode: false,
        });
    }
}

$(document).ready(function() {
    eProduct.init();
});
