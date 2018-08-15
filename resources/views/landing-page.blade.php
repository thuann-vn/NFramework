@extends('layout')

@section('title', isVietnamese()?setting('site.description_vi'):setting('site.description'))

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('vendor/slick/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/slick/slick-theme.min.css') }}">
@endsection

@section('content')
    @include('partials.promo-information')
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
            <h2 class="section-title">{{__('frontend.home.categories')}}</h2>

            <div class="categories text-center">
                @foreach ($featuredCategories as $category)
                    <div class="category">
                        <a href="{{ route('shop.category', ['category'=>!empty($category->parent)?$category->slug:'', 'parent'=>!empty($category->parent)?$category->parent->slug:$category->slug]) }}"><img src="{{ productImage($category->image, 'medium') }}" alt="category"></a>
                        <a class="category-name" href="{{ route('shop.brand', $category->slug) }}">
                            {{$category->name}}
                        </a>
                    </div>
                @endforeach
            </div> <!-- end categories -->
        </div> <!-- end container -->
    </div> <!-- end categories-section -->

    <div class="featured-section">
        <div class="container">
            <h2 class="section-title">{{__('frontend.home.recommendations')}}</h2>

            <div class="products text-center">
                @foreach ($products as $product)
                    @include('partials.products.product')
                @endforeach
            </div> <!-- end products -->
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
            <h2 class="section-title">{{__('frontend.home.brands')}}</h2>

            <div class="brand-grid">
                @foreach ($brands as $brand)
                    <div class="brand">
                        <a href="{{ route('shop.brand', $brand->slug) }}">
                            <img src="{{ productImage($brand->logo, 'medium') }}" alt="brand">
                        </a>
                    </div>
                @endforeach
            </div>

            <a class="brand-banner" href="{{setting('home.banner_4_link')}}">
                <img src="{{Voyager::image(setting('home.banner_4'))}}" alt="{{$brand->name}}">
            </a>
        </div> <!-- end container -->
    </div> <!-- end brand-section -->

    <div class="footer-section">
        <div class="container">
            {!! isVietnamese()?setting('home.footer_content_vi'): setting('home.footer_content') !!}
        </div> <!-- end container -->
    </div> <!-- end blog-section -->
@endsection

@section('extra-js')
    <script src="{{ asset('vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('js/pages/home.js') }}"></script>
@endsection
