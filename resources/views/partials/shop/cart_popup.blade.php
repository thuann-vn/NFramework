<div id="addToCartModal" class="modal fade" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <span class="modal-remove far fa-times-circle" data-dismiss="modal" aria-hidden="true"></span>
            <div class="modal-body">
                <div id="addToCartData" class="row">
                    <div class="text-center">
                        @if(!empty($skuDetail) && !empty($skuDetail->image))
                            <img src="{{productImage($skuDetail->image)}}">
                        @else
                            <img src="{{productImage($product->image)}}">
                        @endif
                    </div>
                    <div class="cart-info">
                        <i class="fas fa-check"></i>
                        <div class="item-added-headline">
                            <span class="glyphicon glyphicon-ok"></span>
                            {{__('frontend.cart.added_to_cart.item_added', ['total' =>'1'])}}
                        </div>
                        <div class="buffer-bottom-medium small gray">
                            <span>{{__('frontend.cart.added_to_cart.ready', ['count' => $count_items])}}</span> - <a class="link" href="{{route('cart.index')}}">{{__('frontend.cart.added_to_cart.view_cart')}}</a>
                        </div>
                        <div class="small brand-name">
                            <span>{{$product->brand->name}}</span>
                        </div>
                        <div class="buffer-bottom small bold black">
                            <span>{{$product->name}}</span>
                        </div>
                        <div class="buffer-bottom-medium large bold">
                            <span class="cart-price">{{priceFormat($product->price)}}</span>
                        </div>

                        <div class="buffer-bottom-medium cart-buttons">
                            <a class="button link" href="{{route('checkout.index')}}">{{__('frontend.cart.added_to_cart.check_out')}}</a> <a href="#" class="link small continue-link">{{__('frontend.cart.added_to_cart.continue_shopping')}}</a>
                        </div>

                        <div class="large bold">
                            {{__('frontend.cart.added_to_cart.total')}}: <span class="cart-price">﻿{{priceFormat($total)}}</span>
                        </div>
                    </div>
                </div>
                <div id="addToCartRelated">
                    <div>
                        <h4 class="title">{{__('frontend.cart.added_to_cart.cart_related')}}</h4>
                        <div class="products related-products">
                            @foreach ($relatedProducts as $product)
                                @include('partials.products.cart_product')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
