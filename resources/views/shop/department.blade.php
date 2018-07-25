@extends('layout')

@section('title', 'Products')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')
    <div class="products-section container">
        @include('partials.shop.department_sidebar')

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
