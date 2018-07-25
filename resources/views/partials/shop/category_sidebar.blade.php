<div class="sidebar">
    <form method="get">
        <div class="sidebar_toggleable">
            <h3>{{__('frontend.category.children')}}</h3>
            <ul>
                @foreach ($category->children as $child)
                    <li>
                        <label for="cat_{{$child->id}}">
                            {{ $child->name }}
                            <input type="checkbox" value="{{$child->slug}}" name="cat" id="cat_{{$child->id}}">
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="sidebar_toggleable">
            @foreach ($attributes as $attribute)
                @if($attribute->values->count()>0)
                    <h3>{{__('frontend.department.attributes', ['name' => $attribute->name])}}</h3>
                    <ul>
                        @foreach ($attribute->values as $value)
                            <li>
                                <label for="attr_{{$value->id}}">
                                    {{ $value->value }}
                                    <input type="checkbox" value="{{$value->id}}" name="attr" id="attr_{{$value->id}}">
                                </label>
                            </li>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </div>

        <div class="sidebar_toggleable">
            <h3>{{__('frontend.department.brands')}}</h3>
            <ul>
                @foreach ($brands as $brand)
                    <li class="{{ setActiveCategory($brand->slug) }}"><a href="{{ route('shop.brand', ['brand' => $brand->slug]) }}">{{ $brand->name }}</a></li>
                @endforeach
            </ul>
        </div>

    </form>
</div> <!-- end sidebar -->