<div class="product">
    <a href="{{ route('shop.show', $product->slug) }}">
        <img src="{{ productImage($product->image) }}" alt="product">
    </a>

    @foreach($product->categories as $cat)
        <a href="{{route('shop.category', $cat->slug)}}">{{$cat->name}}</a>
    @endforeach
    <a href="{{ route('shop.show', $product->slug) }}">
        <div class="product-name">{{ $product->name }}</div>
    </a>
    <div class="product-price">{{ $product->presentPrice() }}</div>
</div>
