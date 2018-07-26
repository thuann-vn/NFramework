<div class="container">
    <div>
        <h2 class="product-section-title">{{__('frontend.product.related_products')}}</h2>
        <div class="products related-products">
            @foreach ($mightAlsoLike as $product)
                @include('partials.products.product')
            @endforeach
        </div>
    </div>
</div>
