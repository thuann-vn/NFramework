<div class="product">
    <a href="{{ route('shop.show', $product->slug) }}">
        <img src="{{ productImage($product->image) }}" alt="product">
    </a>
    <div class="product-info">
        @if(!empty($product->brand))
            <a class="product-brand" href="{{route('shop.brand', $product->brand->slug)}}">{{$product->brand->name}}</a>
        @endif
        <a href="{{ route('shop.show', $product->slug) }}">
            <div class="product-name">{{ $product->name }}</div>
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
            <a href="javascript:;" class="cart-button add-to-cart">
                <span class="cart-icon empty"></span>
            </a>
        @endif

        @if(isInWishlist($product->id))
            <a href="javascript:;" class="wishlist-button add-to-wishlist">
                <span class="cart-icon heart"></span>
            </a>
        @else
            <span class="wishlist-button">
            <span class="cart-icon heart empty"></span>
        </span>
        @endif
    </div>
</div>
