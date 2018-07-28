@extends('layout')

@section('title', $product->name)

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('vendor/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/slick/slick-theme.css') }}">
@endsection

@section('content')

    <div class="breadcrumbs">
        <div class="breadcrumbs-container container">
            <div>
                <a href="/">{{__('frontend.breadcrumb.home')}}</a>
                <i class="fa fa-chevron-right breadcrumb-separator"></i>
                <span><a href="{{ route('shop.index') }}">Shop</a></span>
                <i class="fa fa-chevron-right breadcrumb-separator"></i>
                <span>{{ $product->name }}</span>
            </div>
        </div>
    </div> <!-- end breadcrumbs -->
    <div class="container">
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="product-section container">
        <div>
            <div class="product-section-images">
                <div class="product-vertical-slider">
                    @if ($product->images)
                        @foreach (json_decode($product->images, true) as $image)
                            <div class="product-section-thumbnail">
                                <img src="{{ productImage($image) }}" alt="product">
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="product-section-image">
                    <img src="{{ productImage($product->image) }}" alt="product" class="active" id="currentImage">
                </div>
            </div>
        </div>
        <div class="product-section-information">
            <h2 class="product-brand"><a href="{{route('shop.brand', $product->brand->slug)}}">{{$product->brand->name}}</a></h2>
            <h1 class="product-name">{{ $product->name }}</h1>
            <div class="price">
                @if(!empty($product->regular_price))
                    <span class="product-regular-price">{{ priceFormat($product->regular_price) }}</span>
                @endif
                <span class="product-price">{{ priceFormat($product->price) }}</span>
            </div>


            <form class="cart-form" action="{{ route('cart.store') }}" method="POST">
                {{ csrf_field() }}

                @if($product->variants->count()>0)
                    <div class="form-group">
                        <label>{{__('frontend.product.variants')}}</label>
                        <div class="product-variants">
                            @foreach($product->variants as $key => $variant)
                                <label for="sku_{{$variant->id}}" class="product-variant" data-price="{{$variant->getPrice($product->price)}}" data-price-text="{{priceFormat($variant->getPrice($product->price))}}">
                                    <input name="sku_id" id="sku_{{$variant->id}}" value="{{$variant->id}}" {{$key==0?'checked':''}} type="radio"/>
                                    <img src="{{productImage($variant->image)}}" width="65" height="65"/>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label>{{__('frontend.product.quantity')}}:</label>
                    <input class="quantity-input" name="quantity" value="1"/>
                </div>
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="name" value="{{ $product->name }}">
                <input type="hidden" name="price" value="{{ $product->price }}">
                <button type="submit" class="button button-green button-cart">Add to Cart</button>
            </form>
        </div>
    </div> <!-- end product-section -->

    <div class="container">
        <ul class="features-navigation-bar">
            <li class="text-center">
                <a class="scrollToAnchor" href="#productFeatures">View Product Features<span class="hidden-xs hidden-sm hidden-md"> and Specifications</span></a>
            </li>

            <li class="text-center">
                <a class="scrollToAnchor" href="#productDescr">See Product Description</a>
            </li>

            <li class="text-center">
                <a class="scrollToAnchor" href="#ratings-and-reviews">Read Customer Rating + Reviews</a>
            </li>
        </ul>
    </div>

    @if(!empty($mightAlsoLike))
        @include('partials.shop.might-like')
    @endif


    @if(!empty($similar))
        @include('partials.shop.similar')
    @endif

    <div class="container">
        <hr/>
        <div class="product-details">
            <div>
                <h3 id="productFeatures">{{__('frontend.product.features')}} </h3>
                <div class="product-features">{!! $product->description !!}</div>

                <h3 id="productDescr">{{__('frontend.product.description')}} </h3>
                <div class="product-features">{!! $product->details !!}</div>
            </div>
            <div>
                <h3>{{__('frontend.product.specifications')}} </h3>

                <div class="product-specifications">
                    @foreach($product->properties as $productProperty)
                        <div class="specification">
                            <strong>{{$productProperty->property->name}}:</strong> {{$productProperty->value}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <hr/>
        <h3 id="ratings-and-reviews">{{__('frontend.product.rating_and_reviews')}} </h3>
        <div class="fb-comments" data-href="{{request()->fullUrl()}}" data-width="100%" data-numposts="40"></div>
    </div>
@endsection

@section('extra-js')
    <script src="{{ asset('vendor/slick/slick.js') }}"></script>
    <script src="{{ asset('js/pages/product.js') }}"></script>
    <script>
        (function(){
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

        })();
    </script>

@endsection
