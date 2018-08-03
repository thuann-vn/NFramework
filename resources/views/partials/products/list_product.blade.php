<div class="product">
    <a href="{{ route('shop.show', $product->slug) }}">
        <img src="{{ productImage($product->image) }}" alt="product">
    </a>
    <div class="product-info">
        @if(!empty($product->brand))
            <a class="product-brand" href="{{ route('shop.show', $product->slug) }}">{{$product->brand->getTranslatedAttribute('name')}}</a>
        @endif
        <a href="{{ route('shop.show', $product->slug) }}">
            <div class="product-name">{{ $product->getTranslatedAttribute('name') }}</div>
        </a>
        @if(!empty($product->regular_price))
            <div class="product-regular-price">{{ priceFormat($product->regular_price)}}</div>
        @endif
        <div class="product-price">{{ priceFormat($product->price) }}</div>
    </div>
    <div class="product-buttons">
        @if(isInCart($product->id))
            <span class="cart-button">
            <span class="cart-icon"></span>
        </span>
        @else
            @if($product->variants->count()>0)
                <a href="{{route('shop.show', $product->slug)}}" class="cart-button add-to-cart" data-id="{{$product->id}}">
                    <span class="cart-icon empty"></span>
                </a>
            @else
                <a href="javascript:;" class="cart-button add-to-cart not-added" data-id="{{$product->id}}">
                    <span class="cart-icon empty"></span>
                </a>
            @endif
        @endif

        @if(isInWishlist($product->id))
            <span class="wishlist-button" data-id="{{$product->id}}">
                <span class="cart-icon heart"></span>
            </span>
        @else
            <a href="{{route('saveForLater.store', ['id'=>$product->id])}}" class="wishlist-button add-to-wishlist">
                <span class="cart-icon heart empty"></span>
            </a>
        @endif
    </div>
</div>
