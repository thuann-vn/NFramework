<div class="sidebar filter-sidebar department-sidebar">
    <header class="mobile-slide-panel-header">
        <button class="button mobile-slide-panel-close"><i class="fas fa-chevron-left"></i> {{__('frontend.back')}}</button>
    </header>

    <h3>{{__('frontend.department.featured')}}</h3>
    <ul>
        @foreach ($featuredCategories as $category)
            <li class="{{ setActiveCategory($category->slug) }}"><a href="{{ route('shop.category', ['category' => $category->slug,'parent'=>$category->parent->slug]) }}">{{ $category->getTranslatedAttribute('name') }}</a></li>
        @endforeach
    </ul>

    @foreach ($categories as $category)
        <h3>{{$category->getTranslatedAttribute('name')}}</h3>
        <ul>
            @foreach ($category->children as $childCategory)
                <li class="{{ setActiveCategory($childCategory->slug) }}"><a href="{{ route('shop.category', ['category' => $childCategory->slug, 'parent'=>!empty($childCategory->parent)?$childCategory->parent->slug:'']) }}">{{ $childCategory->name }}</a></li>
            @endforeach
        </ul>
    @endforeach


    @foreach ($attributes as $attribute)
        @if($attribute->values->count()>0)
            <h3>{{__('frontend.department.attributes', ['name' => $attribute->name])}}</h3>
            <ul>
                @foreach ($attribute->values as $value)
                    <li><a href="{{ route('shop.category', ['category' => $childCategory->slug, 'parent'=>!empty($childCategory->parent)?$childCategory->parent->slug:'', 'attribute' => $value->value ]) }}">{{ $value->value  }}</a></li>
                @endforeach
            </ul>
        @endif
    @endforeach

    <h3>{{__('frontend.department.brands')}}</h3>
    <ul>
        @foreach ($brands as $brand)
            <li class="{{ setActiveCategory($brand->slug) }}"><a href="{{ route('shop.brand', ['brand' => $brand->slug]) }}">{{ $brand->getTranslatedAttribute('name') }}</a></li>
        @endforeach
    </ul>
</div> <!-- end sidebar -->