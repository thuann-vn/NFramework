<div class="sidebar filter-sidebar">
    <header class="mobile-slide-panel-header">
        <button class="button mobile-slide-panel-close"><i class="fas fa-chevron-left"></i> {{__('frontend.back')}}</button>
    </header>

    <form type="hidden" method="get" id="filter-form">
        @foreach($filters as $key => $filter)
            <input type="hidden" name="{{$key}}" value=""/>
        @endforeach
    </form>

    @if(!empty($currentFilters))
        <div class="filtered-list">
            <h3>{{__('frontend.category.filters')}}</h3>

            <ul>
                @foreach($currentFilters as $key => $filter)
                    @foreach($filter as $item)
                        <li>
                            <a href="#" class="remove-filter" data-target="{{$key.'_'.$item['id']}}">
                                <i class="fas fa-times-circle"></i> {{isset( $item['name'])? $item['name']: $item['value']}}
                            </a>
                        </li>
                    @endforeach
                @endforeach
            </ul>
            <a href="#" class="clear-filters">{{__('frontend.category.clear_filters')}}</a>
        </div>
    @endif

    <div class="sidebar_toggleable">
        <h3>{{__('frontend.category.children')}}</h3>
        <ul>
            @foreach ($category->children->sortBy('name') as $child)
                <li>
                    <a href="{{route('shop.category', [$category->slug, $child->slug])}}" class="filter-item {{!empty($childCategory) && $child->slug== $childCategory->slug? 'active':''}}" for="cat_{{$child->id}}">
                        {{ $child->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="sidebar_toggleable">
        <h3>{{__('frontend.department.brands')}}</h3>
        <ul>
            @foreach ($brands as $brand)
                <li>
                    <label class="filter-item" for="brand_{{$brand->id}}">
                        <span class="filter-checkbox {{in_array($brand->slug, $filters['brand'])?'checked':''}}"></span>
                        {{ $brand->name }}
                        <input type="checkbox" value="{{$brand->slug}}" {{in_array($brand->slug, $filters['brand'])?'checked':''}} name="filter_brand"
                               id="brand_{{$brand->id}}">
                    </label>
                </li>
            @endforeach
        </ul>
    </div>

    @foreach ($attributes as $attribute)
        <div class="sidebar_toggleable">
            <h3>{{__('frontend.department.attributes', ['name' => $attribute->name])}}</h3>
            <ul data-slug="{{$attribute->slug}}">
                @foreach ($attribute->values as $value)
                    <li>
                        <label class="filter-item" for="{{$attribute->slug}}_{{$value->id}}">
                            <span class="filter-checkbox {{in_array($value->slug, $filters[$attribute->slug])?'checked':''}}"></span>
                            {{ $value->value }}
                            <input type="checkbox" value="{{$value->slug}}" {{in_array($value->slug, $filters[$attribute->slug])?'checked':''}} name="filter_{{$attribute->slug}}"
                                   id="{{$attribute->slug}}_{{$value->id}}">
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div> <!-- end sidebar -->
