@extends('layout')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('vendor/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/slick/slick-theme.css') }}">
@endsection

@section('content')
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

    <div class="categories-section">
        <div class="container">
            <h1 class="text-center">Shop by Category</h1>

            <div class="categories text-center">
                @foreach ($featuredCategories as $category)
                    <div class="category">
                        <a href="{{ route('shop.show', $category->slug) }}"><img src="{{ productImage($category->image) }}" alt="category"></a>
                    </div>
                @endforeach
            </div> <!-- end categories -->
        </div> <!-- end container -->

    </div> <!-- end categories-section -->

    <div class="featured-section">
        <div class="container">
            <h1 class="text-center">Recommendations For You</h1>

            <div class="products text-center">
                @foreach ($products as $product)
                    @include('partials.products.product')
                @endforeach
            </div> <!-- end products -->

            <div class="text-center button-container">
                <a href="{{ route('shop.index') }}" class="button">View more products</a>
            </div>

        </div> <!-- end container -->

    </div> <!-- end featured-section -->



    <div class="banner-section">
        <div class="container">
            <div class="banner-grid">
                <a href="{{setting('home.banner_1_link')}}">
                    <img src="{{Voyager::image(setting('home.banner_1'))}}" alt="Home Banner">
                </a>
                <a href="{{setting('home.banner_2_link')}}">
                    <img src="{{Voyager::image(setting('home.banner_2'))}}" alt="Home Banner">
                </a>
            </div>

            <a class="wide-banner" href="{{setting('home.banner_3_link')}}">
                <img src="{{Voyager::image(setting('home.banner_3'))}}" alt="Home Banner">
            </a>
        </div> <!-- end container -->
    </div> <!-- end banner-section -->


    <div class="brand-section">
        <div class="container">
            <h2 class="section-title">Home of the Best Travel Brands</h2>

            <div class="brand-grid">
                @foreach ($brands as $brand)
                    <div class="brand">
                        <a href="{{ route('shop.brand', $brand->slug) }}"><img src="{{ Voyager::image($brand->logo) }}" alt="brand"></a>
                    </div>
                @endforeach
            </div>
        </div> <!-- end container -->
    </div> <!-- end brand-section -->

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
@endsection

@section('extra-js')
    <script src="{{ asset('vendor/slick/slick.js') }}"></script>
    <script src="{{ asset('js/pages/home.js') }}"></script>
@endsection
