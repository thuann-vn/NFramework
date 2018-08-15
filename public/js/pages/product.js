const eProduct = {
    init: function(){
        this.initSlider();
        this.initVariant();
        this.initRelatedProducts();
        this.initCartForm();
        this.initVideos();
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
            mobileFirst: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 7,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 200,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        const currentImage = document.querySelector('#currentImage');
        const images = document.querySelectorAll('.product-section-thumbnail');

        images.forEach((element) => element.addEventListener('click', thumbnailClick));

        function thumbnailClick(e) {
            currentImage.classList.remove('active');

            currentImage.addEventListener('transitionend', () => {
                currentImage.src = this.querySelector('img').src;
                currentImage.classList.add('active');
            })

            images.forEach((element) => element.classList.remove('selected'));
            this.classList.add('selected');
        }
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
            mobileFirst: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 8,
                        slidesToScroll: 8
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 200,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
            ]
        });
        $('.similar-products') .slick({
            infinite: true,
            slidesToShow: 8,
            slidesToScroll: 8,
            autoplay: true,
            autoplaySpeed: 3000,
            dots: true,
            centerMode: false,
            mobileFirst: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 8,
                        slidesToScroll: 8
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 200,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }
            ]
        });
    },
    initCartForm: function () {
        $('.cart-form').submit(function(e){
            e.preventDefault();

            axios.post(ROUTES.cart.add_to_cart, $(this).serialize()).then(function (response) {
                var modal = $(response.data);
                $('body').append(modal);
                modal.show();
            })
        })
    },
    initVideos: function(){
        $('.product-videos').find('.video').each(function(){
            var image = eApp.getYoutubeThumbnail($(this).data('url'));
            $(this).css({'backgroundImage': 'url('+image+')'});

            $(this).click(function(){
                $('#videoModal').show().find('.modal-body').html('<div id="player" data-plyr-provider="youtube" data-plyr-embed-id="'+ $(this).data('url') +'"></div>');
                new Plyr('#player');
            })
        })
    }
}

$(document).ready(function() {
    eProduct.init();
});
