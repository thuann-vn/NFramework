<div class="container">
    <div>
        <h2 class="product-section-title">{{__('frontend.product.similar_products')}}</h2>
        <div class="products similar-products">
            @foreach ($similar as $product)
                @include('partials.products.product')
            @endforeach
        </div>
    </div>
</div>
