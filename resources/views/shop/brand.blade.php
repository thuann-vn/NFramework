@extends('layout')

@section('title', $brand->getTranslatedAttribute('name'))
@section('description',!empty($brand->getTranslatedAttribute('meta_description'))?$brand->getTranslatedAttribute('meta_description'):$brand->getTranslatedAttribute('description'))
@section('keywords',!empty($brand->getTranslatedAttribute('meta_keywords'))?$brand->getTranslatedAttribute('meta_keywords'):'')

@section('title', 'Products')

@section('content')
    <div class="products-section container">
        @include('partials.shop.brand_sidebar')
        <div class="shop-products">
            <div class="breadcrumbs">
                <div class="breadcrumbs-container container">
                    <div>
                        <a href="/">{{__('frontend.breadcrumb.home')}}</a>
                        <i class="fa fa-chevron-right breadcrumb-separator"></i>

                        @if(empty($childCategory))
                            <span>{{$brand->getTranslatedAttribute('name')}}</span>
                        @else
                            <a href="{{route('shop.category', $brand->slug)}}">{{$brand->getTranslatedAttribute('name')}}</a>
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
                    {{ !empty($childCategory)? $childCategory->getTranslatedAttribute('name') .' ('.$brand->getTranslatedAttribute('name').')' :$brand->getTranslatedAttribute('name') }}
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
