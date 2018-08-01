@extends('layout')

@section('title', 'Favorites')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('vendor/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/slick/slick-theme.css') }}">
@endsection

@section('content')
    <div class="favorites-section container">
        <div class="favorite-item-wrapper">
            <div class="favorite-left">
                <h1>{{__('frontend.wishlist.your_favorites')}}</h1>
            </div>
            <div class="favorite-right">
                <h1>{{__('frontend.wishlist.you_may_also_like')}}</h1>
            </div>
        </div>
        @foreach($items as $item)
            <div class="favorite-item-wrapper">
                <div class="favorite-left has-border-right">
                    <a href="{{route('shop.show', $item->model->slug)}}">
                        <img src="{{productImage($item->model->image)}}">
                    </a>
                    <a href="{{route('shop.show', $item->model->slug)}}" class="brand-name">
                        {{$item->model->brand->getTranslatedAttribute('name')}}
                    </a>

                    <a href="{{route('shop.show', $item->model->slug)}}" class="product-name">
                        {{$item->model->getTranslatedAttribute('name')}}
                    </a>

                    @if(!empty($item->model->regular_price))
                        <div class="product-regular-price">{{ priceFormat($item->model->regular_price)}}</div>
                    @endif
                    <div class="product-price">{{ priceFormat($item->model->price) }}</div>

                    <form action="{{ route('saveForLater.destroy', $item->rowId) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button type="submit" class="wishlist-remove">{{__('frontend.wishlist.remove')}}</button>
                    </form>

                    @if($item->model->variants->count()>0)
                        <a href="{{route('shop.show', $item->model->slug)}}" class="cart-button add-to-cart" data-id="{{$item->model->id}}">
                            <span class="cart-icon empty"></span>
                        </a>
                    @else
                        <a href="javascript:;" class="cart-button add-to-cart not-added" data-id="{{$item->model->id}}">
                            <span class="cart-icon empty"></span>
                        </a>
                    @endif
                </div>
                <div class="favorite-right">
                    <div class="favorite-related products">
                        @foreach(getRelatedProducts($item->model->slug) as $product)
                            @include('partials.products.list_product')
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div> <!-- end cart-section -->
@endsection

@section('extra-js')
    <script src="{{ asset('vendor/slick/slick.js') }}"></script>
    <script>
        $('.favorite-related') .slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: true,
            autoplaySpeed: 3000,
            dots: true,
        });
    </script>

@endsection
