@extends('layout')

@section('title', 'Travel center')

@section('content')
    <div class="travel-center">
        <div class="travel-center-heading">
            @if(empty(setting('travel-center.banner')))
                <img src="/img/travel_center.png" title="travel center" alt="travel center">
            @else
                <img src="{{productImage(setting('travel-center.banner'))}}" title="travel center" alt="travel center">
            @endif
        </div>
        <div class="travel-center-nav">
            <div class="container">
                <ul>
                    <li>
                        <a class="scrollToAnchor" href="#guidesAndLists" data-offset="150">{{__('frontend.travel_center.guides_and_lists')}}</a>
                    </li>
                    <li>
                        <a class="scrollToAnchor" href="#featuredCategories" data-offset="150">{{__('frontend.travel_center.featured_categories')}}</a>
                    </li>
                    <li>
                        <a class="scrollToAnchor" href="#featuredBrands" data-offset="150">{{__('frontend.travel_center.featured_brands')}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container">
            <div id="guidesAndLists"></div>
            <div class="travel-center-header-con">
               <div> {!! __('frontend.travel_center.guides_and_lists_heading') !!}</div>
            </div>

            <div class="travel-posts">
                @foreach($posts as $post)
                    <div class="post">
                        <a class="post-image" href="{{route('travel_center.show', $post->slug)}}" title="{{$post->getTranslatedAttribute('title')}}">
                            <img src="{{productImage($post->image)}}" height="265"/>
                        </a>
                        <a class="post-title" href="{{route('travel_center.show', $post->slug)}}" title="{{$post->getTranslatedAttribute('title')}}">{{$post->getTranslatedAttribute('title')}}</a>
                        <p class="post-excerpt">{{$post->getTranslatedAttribute('excerpt')}}</p>
                    </div>
                @endforeach
            </div>
            <div id="featuredCategories"></div>
            <div class="travel-center-header-con">
                <div>{!! __('frontend.travel_center.featured_categories_heading') !!}</div>
            </div>

            <div class="travel-center-categories">
                @foreach($categories as $category)
                    <div class="featured-category">
                        <a class="featured-category-image" href="{{route('shop.category', $category->slug)}}" title="{{$category->getTranslatedAttribute('name')}}">
                            <img src="{{productImage($category->image)}}" height="265"/>
                        </a>
                        <a class="featured-category-name" href="{{route('travel_center.show', $category->slug)}}" title="{{$category->getTranslatedAttribute('name')}}">{{$category->getTranslatedAttribute('name')}}</a>
                    </div>
                @endforeach
            </div>

            <div id="featuredBrands"></div>
            <div class="travel-center-header-con">
                <div>
                    {!! __('frontend.travel_center.featured_brands_heading') !!}
                </div>
            </div>

            <div class="travel-center-brands">
                @foreach($brands as $brand)
                    <div class="featured-brand">
                        <a class="featured-brand-image" href="{{route('shop.brand', $brand->slug)}}" title="{{$brand->getTranslatedAttribute('name')}}">
                            <img src="{{productImage($brand->logo)}}" alt="{{$brand->getTranslatedAttribute('name')}}"/>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection