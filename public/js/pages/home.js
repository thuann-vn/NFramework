$(document).ready(function(){
    $('.slider.fade').slick({
        dots: true,
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear'
    });

    $('.products').slick({
        infinite: true,
        slidesToShow: 8,
        slidesToScroll: 8,
        autoplay: true,
        autoplaySpeed: 3000,
        dots: true,
    });
})
