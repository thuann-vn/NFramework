<div class="sidebar filter-sidebar">
    <form method="get" id="filter-form">
        <div class="sidebar_toggleable">
            <h3>{{__('frontend.category.children')}}</h3>
            <ul>
                @foreach ($category->children as $child)
                    <li>
                        <label class="filter-item" for="cat_{{$child->id}}">
                            {{ $child->name }}
                            <input type="checkbox" value="{{$child->slug}}" name="filter_category" id="cat_{{$child->id}}">
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>

        @foreach ($attributes as $attribute)
            @if($attribute->values->count()>0)
                <div class="sidebar_toggleable">
                    <h3>{{__('frontend.department.attributes', ['name' => $attribute->name])}}</h3>
                    <ul data-slug="{{$attribute->slug}}">
                        @foreach ($attribute->values as $value)
                            <li>
                                <label class="filter-item" for="attr_{{$value->id}}">
                                    <span class="filter-checkbox"></span>
                                    {{ $value->value }}
                                    <input type="checkbox" value="{{$value->slug}}" name="filter_{{$attribute->slug}}"
                                           id="attr_{{$value->id}}">
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endforeach

        <div class="sidebar_toggleable">
            <h3>{{__('frontend.department.brands')}}</h3>
            <ul>
                @foreach ($brands as $brand)
                    <li>
                        <label class="filter-item" for="attr_{{$brand->id}}">
                            <span class="filter-checkbox"></span>
                            {{ $brand->name }}
                            <input type="checkbox" value="{{$brand->slug}}" name="filter_brand" id="brand_{{$brand->id}}">
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>
    </form>
</div> <!-- end sidebar -->