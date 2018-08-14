<div class="product">
    <a href="{{ route('shop.show', $product->slug) }}">
        <img src="{{Voyager::image($product->thumbnail('small', 'image'))}}" alt="product">
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
</div>
