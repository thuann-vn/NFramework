@extends('layout')

@section('title', 'Products')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')
    <div class="products-section container">
        <div class="sidebar">
            <h3>{{__('frontend.department.featured')}}</h3>
            <ul>
                @foreach ($featuredCategories as $category)
                    <li class="{{ setActiveCategory($category->slug) }}"><a href="{{ route('shop.category', ['category' => $category->slug,'parent'=>$category->parent->slug]) }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>

            @foreach ($categories as $category)
                <h3>{{$category->name}}</h3>
                <ul>
                    @foreach ($category->children as $childCategory)
                        <li class="{{ setActiveCategory($childCategory->slug) }}"><a href="{{ route('shop.category', ['category' => $childCategory->slug, 'parent'=>!empty($childCategory->parent)?$childCategory->parent->slug:'']) }}">{{ $childCategory->name }}</a></li>
                    @endforeach
                </ul>
            @endforeach


            <h3>{{__('frontend.department.brands')}}</h3>
            <ul>
                @foreach ($brands as $brand)
                    <li class="{{ setActiveCategory($brand->slug) }}"><a href="{{ route('shop.brand', ['brand' => $brand->slug]) }}">{{ $brand->name }}</a></li>
                @endforeach
            </ul>
        </div> <!-- end sidebar -->
        <div>
            @if(!empty($department->image))
                <div class="products-banner">
                    <img src="{{productImage($department->image)}}" title="{{$department->name}}" alt="{{$department->name}}"/>
                </div>
            @endif

            @if(!empty($featuredCategories))
                <div class="featured-categories">
                    @foreach ($featuredCategories as $category)
                        <a href="{{route('shop.category', ['category'=>$category->slug,'parent'=>$category->parent->slug])}}">
                            <img src="{{productImage($category->image)}}"/>

                            <h3>{{$category->name}}</h3>
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
                <h1 class="stylish-heading">{{ $department->name }}</h1>
                <div>
                    <strong>Price: </strong>
                    <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'low_high']) }}">Low to High</a> |
                    <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'high_low']) }}">High to Low</a>
                </div>
            </div>

            <div class="products text-center">
                @forelse ($products as $product)
                    <div class="product">
                        <a href="{{ route('shop.show', $product->slug) }}"><img src="{{ productImage($product->image) }}" alt="product"></a>
                        <a href="{{ route('shop.show', $product->slug) }}"><div class="product-name">{{ $product->name }}</div></a>
                        <div class="product-price">{{ $product->presentPrice() }}</div>
                    </div>
                @empty
                    <div style="text-align: left">No items found</div>
                @endforelse
            </div> <!-- end products -->

            <div class="spacer"></div>
            {{ $products->appends(request()->input())->links() }}
        </div>
    </div>

@endsection

@section('extra-js')
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
@endsection
