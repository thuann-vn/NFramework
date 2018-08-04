@extends('layout')

@section('title', $department->getTranslatedAttribute('name'))
@section('description',!empty($department->getTranslatedAttribute('meta_description'))?$department->getTranslatedAttribute('meta_description'):$department->getTranslatedAttribute('description'))
@section('keywords',!empty($department->getTranslatedAttribute('meta_keywords'))?$department->getTranslatedAttribute('meta_keywords'):'')

@section('content')
    <div class="products-section container">
        @include('partials.shop.department_sidebar')
        <div>
            @if(!empty($department->image))
                <div class="products-banner">
                    <img src="{{productImage($department->image)}}" title="{{$department->getTranslatedAttribute('name')}}" alt="{{$department->getTranslatedAttribute('name')}}"/>
                </div>
            @endif

            @if(!empty($featuredCategories))
                <div class="featured-categories">
                    @foreach ($featuredCategories as $category)
                        <a href="{{ route('shop.category', ['category' => $category->slug, 'parent'=>!empty($category->parent)?$category->parent->slug:'']) }}">
                            <img src="{{productImage($category->image)}}"/>

                            <h3>{{$category->getTranslatedAttribute('name')}}</h3>
                        </a>
                    @endforeach
                </div>
            @endif

            @if(!empty($department->content))
                <div class="department-content">
                    {!! $department->content !!}
                </div>
            @endif
            <div class="products-header">
                <h1 class="stylish-heading">{{ $department->getTranslatedAttribute('name') }}</h1>

                <form action="{{request()->fullUrl()}}" method="get" class="sort-form">
                    <button type="button" class="button mobile-filter-toggle" id="mobileSidebarToggle">{{__('frontend.category.filter')}}</button>
                    <strong>{{__('frontend.category.sort')}}: </strong>
                    <select name="sort" id="searchSortDropdown" class="form-control">
                        <option value="featured" {{$sort=='featured'?'selected':''}}>{{__('frontend.category.sorts.featured')}}</option>
                        <option value="best_seller" {{$sort=='best_seller'?'selected':''}}>{{__('frontend.category.sorts.best_sellers')}}</option>
                        <option value="newest" {{$sort=='newest'?'selected':''}}>{{__('frontend.category.sorts.newest')}}</option>
                        <option value="low_high" {{$sort=='low_high'?'selected':''}}>{{__('frontend.category.sorts.low_to_high')}}</option>
                        <option value="high_low" {{$sort=='high_low'?'selected':''}}>{{__('frontend.category.sorts.high_to_low')}}</option>
                    </select>
                </form>
            </div>

            <div class="products text-center">
                @forelse ($products as $product)
                   @include('partials.products.list_product')
                @empty
                    <div style="text-align: left">No items found</div>
                @endforelse
            </div> <!-- end products -->

            {{ $products->appends(request()->input())->links() }}
        </div>
    </div>

@endsection
