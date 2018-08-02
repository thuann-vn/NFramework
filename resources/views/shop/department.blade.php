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
                        <a href="{{route('shop.category', ['category'=>$category->slug,'parent'=>$category->parent->slug])}}">
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
                <div>
                    <strong>Price: </strong>
                    <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'low_high']) }}">Low to High</a> |
                    <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'high_low']) }}">High to Low</a>
                </div>
            </div>

            <div class="products text-center">
                @forelse ($products as $product)
                   @include('partials.products.list_product')
                @empty
                    <div style="text-align: left">No items found</div>
                @endforelse
            </div> <!-- end products -->

            <div class="spacer"></div>
            {{ $products->appends(request()->input())->links() }}
        </div>
    </div>

@endsection
