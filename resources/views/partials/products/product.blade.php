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
            <div class="product-regular-price">{{ $product->regularPrice() }}</div>
        @endif
        <div class="product-price">{{ $product->presentPrice() }}</div>
    </div>
</div>
