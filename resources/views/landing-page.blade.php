<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Ecommerce Example</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat%7CRoboto:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/slick/slick.css') }}">
    </head>
    <body>
        <header class="with-background">
            <div class="top-nav container">
                <div class="top-nav-left">
                    <div class="logo">Ecommerce</div>
                    {{ menu('main', 'partials.menus.main') }}
                </div>
                <div class="top-nav-right">
                    @include('partials.menus.main-right')
                </div>
            </div> <!-- end top-nav -->
            <div class="container">
                <div class="slider fade">
                    @if(!empty($slider))
                        @foreach($slider->slides as $slide)
                            <div>
                                <div class="image">
                                    <img src="{{Voyager::image($slide->image)}}" alt="hero image">
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div> <!-- end hero -->


        </header>

        <div class="featured-section">

            <div class="container">
                <h1 class="text-center">Laravel Ecommerce</h1>

                <p class="section-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic lorem.</p>

                <div class="text-center button-container">
                    <a href="#" class="button">Featured</a>
                    <a href="#" class="button">On Sale</a>
                </div>

                {{-- <div class="tabs">
                    <div class="tab">
                        Featured
                    </div>
                    <div class="tab">
                        On Sale
                    </div>
                </div> --}}

                <div class="products text-center">
                    @foreach ($products as $product)
                        <div class="product">
                            <a href="{{ route('shop.show', $product->slug) }}"><img src="{{ productImage($product->image) }}" alt="product"></a>
                            <a href="{{ route('shop.show', $product->slug) }}"><div class="product-name">{{ $product->name }}</div></a>
                            <div class="product-price">{{ $product->presentPrice() }}</div>
                        </div>
                    @endforeach

                </div> <!-- end products -->

                <div class="text-center button-container">
                    <a href="{{ route('shop.index') }}" class="button">View more products</a>
                </div>

            </div> <!-- end container -->

        </div> <!-- end featured-section -->

        <div class="blog-section">
            <div class="container">
                <h1 class="text-center">From Our Blog</h1>

                <p class="section-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic.</p>

                <div class="blog-posts">
                    <div class="blog-post" id="blog1">
                        <a href="#"><img src="/img/blog1.png" alt="Blog Image"></a>
                        <a href="#"><h2 class="blog-title">Blog Post Title 1</h2></a>
                        <div class="blog-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi, tenetur numquam ipsam reiciendis.</div>
                    </div>
                    <div class="blog-post" id="blog2">
                        <a href="#"><img src="/img/blog2.png" alt="Blog Image"></a>
                        <a href="#"><h2 class="blog-title">Blog Post Title 2</h2></a>
                        <div class="blog-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi, tenetur numquam ipsam reiciendis.</div>
                    </div>
                    <div class="blog-post" id="blog3">
                        <a href="#"><img src="/img/blog3.png" alt="Blog Image"></a>
                        <a href="#"><h2 class="blog-title">Blog Post Title 3</h2></a>
                        <div class="blog-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi, tenetur numquam ipsam reiciendis.</div>
                    </div>
                </div>
            </div> <!-- end container -->
        </div> <!-- end blog-section -->

        @include('partials.footer')

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/vendor/slick/slick.js') }}"></script>
        <script src="{{ asset('js/pages/home.js') }}"></script>
    </body>
</html>
