@extends('layout')

@section('title', 'Products')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')
    <div class="products-section container">
        @include('partials.shop.category_sidebar')

        <div>
            @if(!empty($category->content))
                <div class="department-content">
                    {!! $category->content !!}
                </div>
            @endif
            <div class="products-header">
                <h1 class="stylish-heading">{{ $category->name }}</h1>
                <div>
                    <strong>Price: </strong>
                    <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'low_high']) }}">Low to High</a> |
                    <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'high_low']) }}">High to Low</a>
                </div>
            </div>

            <div class="products product-4-columns text-center">
                @forelse ($products as $product)
                    @include('partials.products.product')
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
    <script src="{{ asset('js/pages/category.js') }}"></script>
@endsection
