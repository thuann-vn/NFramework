$(document)["ready"](function () {
    "use strict";
    if ($(".navbar-burger")["length"]) {
        $(".navbar-burger")["on"]("click", function () {
            $(this)["toggleClass"]("is-active");
            if ($(".navbar-menu")["hasClass"]("is-active")) {
                $(".navbar-menu")["removeClass"]("is-active")
            } else {
                $(".navbar-menu")["addClass"]("is-active")
            }
        })
    };
    if ($(".pageloader")["length"]) {
        $(".pageloader")["toggleClass"]("is-active");
        $(window)["on"]("load", function () {
            var variable_0 = setTimeout(function () {
                $(".pageloader")["toggleClass"]("is-active");
                $(".infraloader")["toggleClass"]("is-active");
                clearTimeout(variable_0)
            }, 700)
        })
    };
    if ($(".has-background-image")["length"]) {
        $(".has-background-image")["each"](function () {
            var variable_1 = $(this)["attr"]("data-background");
            if (variable_1 !== undefined) {
                $(this)["css"]("background-image", "url(" + variable_1 + ")")
            }
        })
    };
    if ($(".slider-wrapper")["length"]) {
        $(".fullscreen-slick")["slick"]({
            dots: true,
            infinite: true,
            speed: 500,
            cssEase: "cubic-bezier(0.645, 0.045, 0.355, 1.000)",
            autoplay: true,
            autoplaySpeed: 5000,
            arrows: false
        })
    };
    if ($(".is-carousel")["length"]) {
        $(".is-carousel")["slick"]({
            dots: true,
            infinite: true,
            speed: 500,
            cssEase: "cubic-bezier(0.645, 0.045, 0.355, 1.000)",
            arrows: false
        })
    };
    if (window["matchMedia"]("(max-width: 767px)")["matches"]) {
        $(".has-simple-popover")["removeClass"]("has-simple-popover")["addClass"]("popover-removed")
    } else {
        $(".popover-removed")["addClass"]("has-simple-popover")["removeClass"]("popover-removed")
    };
    $(window)["on"]("resize", function () {
        if (window["matchMedia"]("(max-width: 767px)")["matches"]) {
            $(".has-simple-popover")["removeClass"]("has-simple-popover")["addClass"]("popover-removed")
        } else {
            $(".popover-removed")["addClass"]("has-simple-popover")["removeClass"]("popover-removed")
        }
    });
    if (window["matchMedia"]("(max-width: 767px)")["matches"]) {
        $(".has-popover-top")["removeClass"]("has-popover-top")["addClass"]("popover-removed")
    } else {
        $(".popover-complex-removed")["addClass"]("has-popover-top")["removeClass"]("popover-complex-removed")
    };
    $(window)["on"]("resize", function () {
        if (window["matchMedia"]("(max-width: 767px)")["matches"]) {
            $(".has-popover-top")["removeClass"]("has-popover-top")["addClass"]("popover-removed")
        } else {
            $(".popover-complex-removed")["addClass"]("has-popover-top")["removeClass"]("popover-complex-removed")
        }
    });
    $(".hamburger-btn")["on"]("click", function () {
        $(".menu-toggle .icon-box-toggle")["toggleClass"]("active");
        $(".category-quickview")["toggleClass"]("is-active")
    });
    $(".icon-menu li a")["on"]("click", function () {
        $(".icon-menu li a.is-active")["removeClass"]("is-active");
        $(this)["addClass"]("is-active")
    });
    $("#open-search")["on"]("click", function () {
        $(".search-overlay")["toggleClass"]("is-active");
        $(this)["addClass"]("is-opened is-hidden");
        $("#close-search")["removeClass"]("is-hidden");
        setTimeout(function () {
            $("#close-search")["removeClass"]("is-inactive")
        }, 50);
        $(".search-input-wrapper")["removeClass"]("is-hidden");
        setTimeout(function () {
            $(".search-input-wrapper .control")["addClass"]("is-active")
        }, 300)
    });
    $("#close-search")["on"]("click", function () {
        $(".search-overlay")["toggleClass"]("is-active");
        $(this)["addClass"]("is-inactive is-hidden");
        $("#open-search")["removeClass"]("is-hidden");
        setTimeout(function () {
            $("#open-search")["removeClass"]("is-opened")
        }, 50);
        $(".search-input-wrapper .control")["removeClass"]("is-active");
        setTimeout(function () {
            $(".search-input-wrapper")["addClass"]("is-hidden")
        }, 150)
    });
    $("#clear-search")["on"]("click", function () {
        $(this)["siblings"]("input")["val"]("")
    });
    $("#open-shop")["on"]("click", function () {
        if ($(".cart-quickview, .filters-quickview")["hasClass"]("is-active")) {
            $(".cart-quickview, .filters-quickview")["removeClass"]("is-active")
        };
        if ($(".menu-fab")["hasClass"]("dismissed")) {
            $(".menu-fab")["removeClass"]("dismissed")
        };
        $(".shop-quickview")["toggleClass"]("is-active")
    });
    $("#close-shop-sidebar")["on"]("click", function () {
        $(".shop-quickview, #open-shop")["toggleClass"]("is-active")
    });
    $("#open-filters")["on"]("click", function () {
        if ($(".shop-quickview, .cart-quickview")["hasClass"]("is-active")) {
            $(".shop-quickview, .cart-quickview")["removeClass"]("is-active")
        };
        if (!$(".menu-fab")["hasClass"]("dismissed")) {
            $(".menu-fab")["addClass"]("dismissed")
        };
        $(".filters-quickview")["toggleClass"]("is-active")
    });
    $("#close-filters-sidebar")["on"]("click", function () {
        $(".menu-fab")["removeClass"]("dismissed");
        $(".filters-quickview, #open-filters")["toggleClass"]("is-active")
    });
    $("#open-cart")["on"]("click", function () {
        if ($(".shop-quickview, .filters-quickview")["hasClass"]("is-active")) {
            $(".shop-quickview, .filters-quickview")["removeClass"]("is-active")
        };
        if (!$(".menu-fab")["hasClass"]("dismissed")) {
            $(".menu-fab")["addClass"]("dismissed")
        };
        $(".cart-quickview")["toggleClass"]("is-active")
    });
    $("#close-cart-sidebar")["on"]("click", function () {
        $(".menu-fab")["removeClass"]("dismissed");
        $(".cart-quickview, #open-cart")["toggleClass"]("is-active")
    });
    if ($(".price-range-wrapper")["length"]) {
        var variable_2 = $(".input-range"),
            variable_3 = $(".range-value");
        variable_3["html"]("$0" + " " + "-" + " " + "$" + variable_2["attr"]("value"));
        variable_2["on"]("input", function () {
            variable_3["html"]("$0" + " " + "-" + " " + "$" + this["value"])
        })
    };
    $(".flat-card .actions .like svg, .sidebar-whishlist svg")["on"]("click", function () {
        $(this)["toggleClass"]("is-active gelatine");
        if (!$(this)["hasClass"]("is-active")) {
            iziToast["show"]({
                class: "success-toast",
                icon: "fa fa-heart-o",
                title: "Successfuly removed from Wishlist",
                message: "",
                titleColor: "#fff",
                messageColor: "#fff",
                iconColor: "#fff",
                backgroundColor: "#FF7273",
                progressBarColor: "#444F60",
                position: "bottomRight",
                transitionIn: "fadeInUp",
                close: false,
                timeout: 2000,
                zindex: 99999
            })
        } else {
            iziToast["show"]({
                class: "success-toast",
                icon: "fa fa-heart",
                title: "Successfuly added to Wishlist",
                message: "",
                titleColor: "#fff",
                messageColor: "#fff",
                iconColor: "#fff",
                backgroundColor: "#FF7273",
                progressBarColor: "#444F60",
                position: "bottomRight",
                transitionIn: "fadeInUp",
                close: false,
                timeout: 2000,
                zindex: 99999
            })
        }
    });
    $(".flat-card .actions .add svg")["on"]("click", function () {
        $(this)["toggleClass"]("is-active gelatine");
        if (!$(this)["hasClass"]("is-active")) {
            iziToast["show"]({
                class: "success-toast",
                icon: "fa fa-shopping-cart",
                title: "Successfuly removed from Cart",
                message: "",
                titleColor: "#fff",
                messageColor: "#fff",
                iconColor: "#fff",
                backgroundColor: "#0023ff",
                progressBarColor: "#444F60",
                position: "bottomRight",
                transitionIn: "fadeInUp",
                close: false,
                timeout: 2000,
                zindex: 99999
            })
        } else {
            iziToast["show"]({
                class: "success-toast",
                icon: "fa fa-cart-plus",
                title: "Successfuly added to Cart",
                message: "",
                titleColor: "#fff",
                messageColor: "#fff",
                iconColor: "#fff",
                backgroundColor: "#0023ff",
                progressBarColor: "#444F60",
                position: "bottomRight",
                transitionIn: "fadeInUp",
                close: false,
                timeout: 2000,
                zindex: 99999
            })
        }
    });
    $(".cart-button")["on"]("click", function () {
        $(this)["toggleClass"]("is-active gelatine");
        iziToast["show"]({
            class: "success-toast",
            icon: "fa fa-cart-plus",
            title: "Successfuly added to Cart",
            message: "",
            titleColor: "#fff",
            messageColor: "#fff",
            iconColor: "#fff",
            backgroundColor: "#0023ff",
            progressBarColor: "#444F60",
            position: "bottomRight",
            transitionIn: "fadeInUp",
            close: false,
            timeout: 2000,
            zindex: 99999
        })
    });

    if ($(".chosen-select")["length"]) {
        $(".chosen-select")["chosen"]({
            disable_search_threshold: 6,
            width: "100%"
        })
    };
    $(".product-action")["on"]("click", function () {
        $(".product-action.is-active")["removeClass"]("is-active");
        $(this)["addClass"]("is-active")
    });
    $("#show-product")["on"]("click", function () {
        $("#meta-view, #ratings-view")["addClass"]("is-hidden");
        $("#product-view")["removeClass"]("is-hidden")
    });
    $("#show-meta")["on"]("click", function () {
        $("#product-view, #ratings-view")["addClass"]("is-hidden");
        $("#meta-view")["removeClass"]("is-hidden")
    });
    $("#show-ratings")["on"]("click", function () {
        $("#meta-view, #product-view")["addClass"]("is-hidden");
        $("#ratings-view")["removeClass"]("is-hidden")
    });
    $(".sidebar-whishlist")["on"]("click", function () {
        $(this)["toggleClass"]("is-active");
        $(".product-panel .panel-header .likes svg")["toggleClass"]("is-liked gelatine")
    });
    $(".modal-trigger")["on"]("click", function () {
        var variable_6 = $(this)["attr"]("data-modal");
        $("#" + variable_6)["toggleClass"]("is-active")["find"](".box")["addClass"]("scaleIn")
    });
    $(".modal-delete")["on"]("click", function () {
        $(this)["closest"](".modal")["removeClass"]("is-active")
    });

    $(".dropdown-trigger")["on"]("click", function (variable_04) {
        variable_04["stopPropagation"]();
        $(".dropdown")["removeClass"]("is-active");
        $(this)["closest"](".dropdown")["addClass"]("is-active")
    });
    $(window)["on"]("click", function (variable_04) {
        if ($(".dropdown")["hasClass"]("is-active")) {
            $(".dropdown")["removeClass"]("is-active")
        }
    });
    $(".shipping-wrapper .mini-card")["on"]("click", function () {
        $(".shipping-wrapper .mini-card")["removeClass"]("is-active");
        $(".active-indicator")["removeClass"]("gelatine");
        $(this)["addClass"]("is-active");
        $(this)["find"](".active-indicator")["addClass"]("gelatine")
    });
    $(".payment-method")["on"]("click", function () {
        var variable_05 = $(this)["attr"]("data-method");
        $("#payment-header, #payment-methods")["addClass"]("is-hidden");
        $("#" + variable_05)["removeClass"]("is-hidden")
    });
    $(".back-to-methods")["on"]("click", function () {
        $("#paypal, #bank-transfer, #cash, #credit-card")["addClass"]("is-hidden");
        $("#payment-header, #payment-methods")["removeClass"]("is-hidden")
    });
    if ($("#credit-card")["length"]) {
        var variable_06 = new Card({
            form: ".active form",
            container: ".card-wrapper"
        })
    };
    $(".tabs li")["on"]("click", function () {
        var variable_07 = $(this)["attr"]("data-tab");
        $(this)["siblings"]("li")["removeClass"]("is-active");
        $(this)["closest"](".tabs-wrapper")["children"](".navtab-content")["removeClass"]("is-active");
        $(this)["addClass"]("is-active");
        $("#" + variable_07)["addClass"]("is-active")
    });
    if ($("#mobile-mode, #sidebar-mode")["length"]) {
        $("#mobile-mode, #sidebar-mode")["on"]("click", function () {
            $(".icon-menu li a.is-active")["removeClass"]("is-active");
            $(".mobile-navbar")["toggleClass"]("is-active");
            $(".shop-wrapper")["toggleClass"]("is-mobile-mode");
            $(".main-sidebar, .shop-quickview, .cart-quickview, .filters-quickview")["toggleClass"]("is-pushed-mobile");
            $(".pageloader, .infraloader")["toggleClass"]("is-full")
        });
        if (window["matchMedia"]("(max-width: 768px)")["matches"]) {
            $(".mobile-navbar")["addClass"]("is-active");
            $(".shop-wrapper")["addClass"]("is-mobile-mode");
            $(".main-sidebar, .shop-quickview, .cart-quickview, .filters-quickview")["addClass"]("is-pushed-mobile");
            $(".pageloader, .infraloader")["addClass"]("is-full")
        } else {
            $(".mobile-navbar")["removeClass"]("is-active");
            $(".shop-wrapper")["removeClass"]("is-mobile-mode");
            $(".main-sidebar, .shop-quickview, .cart-quickview, .filters-quickview")["removeClass"]("is-pushed-mobile");
            $(".pageloader, .infraloader")["removeClass"]("is-full")
        };
        $(window)["on"]("resize", function () {
            if (window["matchMedia"]("(max-width: 768px)")["matches"]) {
                $(".mobile-navbar")["addClass"]("is-active");
                $(".shop-wrapper")["addClass"]("is-mobile-mode");
                $(".main-sidebar, .shop-quickview, .cart-quickview, .filters-quickview")["addClass"]("is-pushed-mobile");
                $(".pageloader, .infraloader")["addClass"]("is-full")
            } else {
                $(".mobile-navbar")["removeClass"]("is-active");
                $(".shop-wrapper")["removeClass"]("is-mobile-mode");
                $(".main-sidebar, .shop-quickview, .cart-quickview, .filters-quickview")["removeClass"]("is-pushed-mobile");
                $(".pageloader, .infraloader")["removeClass"]("is-full")
            }
        })
    };
    if ($(".action-bar")["length"]) {
        if (window["matchMedia"]("(max-width: 768px)")["matches"]) {
            $(".action-bar")["addClass"]("is-mobile");
            $(".shop-wrapper")["addClass"]("is-mobile-mode");
            $(".main-sidebar, .shop-quickview, .cart-quickview, .filters-quickview")["addClass"]("is-pushed-mobile");
            $(".pageloader, .infraloader")["addClass"]("is-full")
        } else {
            $(".shop-wrapper")["removeClass"]("is-mobile-mode");
            $(".main-sidebar, .shop-quickview, .cart-quickview, .filters-quickview")["removeClass"]("is-pushed-mobile");
            $(".pageloader, .infraloader")["removeClass"]("is-full")
        };
        $(window)["on"]("resize", function () {
            if (window["matchMedia"]("(max-width: 768px)")["matches"]) {
                $(".action-bar")["addClass"]("is-mobile");
                $(".shop-wrapper")["addClass"]("is-mobile-mode");
                $(".main-sidebar, .shop-quickview, .cart-quickview, .filters-quickview")["addClass"]("is-pushed-mobile");
                $(".pageloader, .infraloader")["addClass"]("is-full")
            } else {
                $(".shop-wrapper")["removeClass"]("is-mobile-mode");
                $(".main-sidebar, .shop-quickview, .cart-quickview, .filters-quickview")["removeClass"]("is-pushed-mobile");
                $(".pageloader, .infraloader")["removeClass"]("is-full")
            }
        })
    };
    if ($("#avatar-upload")["length"]) {
        var variable_08 = function (variable_8) {
            if (variable_8["files"] && variable_8["files"][0]) {
                var variable_09 = new FileReader();
                variable_09["onload"] = function (variable_11) {
                    $(".profile-pic")["attr"]("src", variable_11["target"]["result"])
                };
                variable_09["readAsDataURL"](variable_8["files"][0])
            }
        };
        $(".file-upload")["on"]("change", function () {
            variable_08(this)
        });
        $(".upload-button")["on"]("click", function () {
            $(".file-upload")["click"]()
        })
    };
    $(".button.will-upload")["on"]("click", function () {
        $(this)["removeClass"]("will-upload")["addClass"]("is-loading");
        setTimeout(function () {
            $(".button.is-loading")["removeClass"]("is-loading")["addClass"]("will-upload");
            iziToast["show"]({
                class: "success-toast",
                icon: "fa fa-check",
                title: "Your profile picture has been saved",
                message: "",
                titleColor: "#fff",
                messageColor: "#fff",
                iconColor: "#fff",
                backgroundColor: "#00b289",
                progressBarColor: "#444F60",
                position: "topRight",
                transitionIn: "fadeInDown",
                close: false,
                timeout: 2000,
                zindex: 99999
            })
        }, 2000)
    });
    $(".form-switch .is-switch")["on"]("change", function () {
        $(this)["closest"](".flat-card")["find"](".card-body")["toggleClass"]("is-disabled")
    });
    $(".list-card ul li")["on"]("click", function () {
        $(".list-card ul li")["removeClass"]("is-active");
        $(this)["addClass"]("is-active");
        var variable_0a = $(this)["attr"]("data-order");
        $(".order-list-card")["addClass"]("is-hidden");
        $("#" + variable_0a)["removeClass"]("is-hidden")
    });
})