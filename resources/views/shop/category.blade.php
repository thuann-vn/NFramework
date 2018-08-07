@extends('layout')

@section('title', $category->getTranslatedAttribute('name'))
@section('description',!empty($category->getTranslatedAttribute('meta_description'))?$category->getTranslatedAttribute('meta_description'):$category->getTranslatedAttribute('description'))
@section('keywords',!empty($category->getTranslatedAttribute('meta_keywords'))?$category->getTranslatedAttribute('meta_keywords'):'')

@section('content')
    <div class="products-section container">
        @include('partials.shop.category_sidebar')
        <div class="shop-products">
            <div class="breadcrumbs">
                <div class="breadcrumbs-container container">
                    <div>
                        <a href="/">{{__('frontend.breadcrumb.home')}}</a>
                        <i class="fa fa-chevron-right breadcrumb-separator"></i>

                        @if(empty($childCategory))
                            <span>{{$category->getTranslatedAttribute('name')}}</span>
                        @else
                            <a href="{{route('shop.category', $category->slug)}}">{{$category->getTranslatedAttribute('name')}}</a>
                        @endif

                        @if(!empty($childCategory))
                            <i class="fa fa-chevron-right breadcrumb-separator"></i>
                            <span>{{$childCategory->getTranslatedAttribute('name')}}</span>
                        @endif
                    </div>
                </div>
            </div> <!-- end breadcrumbs -->

            @if(!empty($category->content))
                <div class="department-content">
                    {!! $category->content !!}
                </div>
            @endif
            <div class="products-header">
                <h1 class="stylish-heading">{{ !empty($childCategory)? $childCategory->getTranslatedAttribute('name') :$category->getTranslatedAttribute('name') }}</h1>

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
