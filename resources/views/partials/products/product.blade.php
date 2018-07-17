<div class="product">
    <a href="{{ route('shop.show', $product->slug) }}">
        <img src="{{ productImage($product->image) }}" alt="product">
    </a>

    @if(!empty($product->brand))
        <a href="{{route('shop.brand', $product->brand->slug)}}">{{$product->brand->name}}</a>
    @endif
    <a href="{{ route('shop.show', $product->slug) }}">
        <div class="product-name">{{ $product->name }}</div>
    </a>
    <div class="product-price">{{ $product->presentPrice() }}</div>
</div>
