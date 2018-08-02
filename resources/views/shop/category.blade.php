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
                <form action="{{request()->fullUrl()}}" method="get" class="sort-form">
                    <strong>{{__('frontend.category.sort')}}: </strong>
                    <select name="sort" id="searchSortDropdown" class="form-control">
                        <option value="featured" {{$sort=='featured'?'selected':''}}>{{__('frontend.category.sorts.featured')}}</option>
                        <option value="best_seller" {{$sort=='best_seller'?'selected':''}}>{{__('frontend.category.sorts.best_sellers')}}</option>
                        <option value="newest" {{$sort=='newest'?'selected':''}}>{{__('frontend.category.sorts.newest')}}</option>
                        <option value="low_high" {{$sort=='low_high'?'selected':''}}>{{__('frontend.category.sorts.low_to_high')}}</option>
                        <option value="high_low" {{$sort=='high_low'?'selected':''}}>{{__('frontend.category.sorts.high_to_low')}}</option>
                        {{--<option value="top_rated" {{$sort=='top_rated'?'selected':''}}>{{__('frontend.category.sorts.top_rated')}}</option>--}}
                    </select>
                </form>
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

            <div class="spacer"></div>
            <div class="shop-pagination">
                {{ $products->appends(request()->input())->links('partials.shop.pagination')}}
            </div>
        </div>
    </div>

@endsection

@section('extra-js')
    <script src="{{ asset('js/pages/category.js') }}"></script>
@endsection
