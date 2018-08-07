@extends('layout')

@section('title', !empty($childCategory)?$childCategory->getTranslatedAttribute('name'): __('frontend.sale'))

@section('description',!empty($childCategory) && !empty($childCategory->getTranslatedAttribute('meta_description'))?$childCategory->getTranslatedAttribute('meta_description'):'')
@section('keywords',!empty($childCategory) && !empty($childCategory->getTranslatedAttribute('meta_keywords'))?$childCategory->getTranslatedAttribute('meta_keywords'):'')

@section('content')
    <div class="products-section container">
        @include('partials.shop.sale_sidebar')
        <div class="shop-products">
            <div class="breadcrumbs">
                <div class="breadcrumbs-container container">
                    <div>
                        <a href="/">{{__('frontend.breadcrumb.home')}}</a>
                        <i class="fa fa-chevron-right breadcrumb-separator"></i>

                        @if(empty($childCategory))
                            <span>{{__('frontend.sale')}}</span>
                        @else
                            <a href="{{route('shop.sale')}}">{{__('frontend.sale')}}</a>
                        @endif

                        @if(!empty($childCategory))
                            <i class="fa fa-chevron-right breadcrumb-separator"></i>
                            <span>{{$childCategory->getTranslatedAttribute('name')}}</span>
                        @endif
                    </div>
                </div>
            </div> <!-- end breadcrumbs -->
            <div class="products-header">
                <h1 class="stylish-heading">
                    {{ !empty($childCategory)? $childCategory->getTranslatedAttribute('name') .' ('.__('frontend.sale').')' :__('frontend.sale')}}
                </h1>
                @include('partials.shop.sorts')
            </div>

            <div class="shop-pagination">
                <span class="total-items">{{__('pagination.total', ['total' => $products->total()])}}</span>
                {{ $products->appends(request()->input())->links('partials.shop.pagination') }}
            </div>

            <div class="products product-4-columns text-center">
                @forelse ($products as $product)
                    @include('partials.products.list_product')
                @empty
                    <div style="text-align: left">No items found</div>
                @endforelse
            </div> <!-- end products -->

            <div class="shop-pagination">
                {{ $products->appends(request()->input())->links('partials.shop.pagination')}}
            </div>
        </div>
    </div>

@endsection

@section('extra-js')
    <script src="{{ asset('js/pages/category.js') }}"></script>
@endsection
