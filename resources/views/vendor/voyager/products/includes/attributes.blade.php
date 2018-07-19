
<h3><i class="voyager-tag"></i> {{ __('voyager.product.properties.title') }} <small>{{ __('voyager.product.properties.text') }}</small></h3>
<div class="panel">
@foreach($productProperties as $attribute)
    <div class="panel-heading">
        <h3 class="panel-title">
            {{ $attribute->property->name }}
        </h3>
        <div class="panel-actions">
            <a href="{{ route('voyager.settings.move_up', $attribute->id) }}">
                <i class="sort-icons voyager-sort-asc"></i>
            </a>
            <a href="{{ route('voyager.settings.move_down', $attribute->id) }}">
                <i class="sort-icons voyager-sort-desc"></i>
            </a>
            <i class="voyager-trash"
               data-id="{{ $attribute->id }}"
               data-display-name="{{ $attribute->value }}"></i>
        </div>
    </div>

    <div class="panel-body no-padding-left-right">
        <div class="col-md-12 no-padding-left-right">
            <input type="text" value="{{$attribute->value}}" class="form-control" name="value" placeholder="{{ __('voyager.products.attribute.value_help') }}" required="required">
        </div>
    </div>
@endforeach
</div>
<div class="panel" style="margin-top:10px;">
    <div class="panel-heading new-attribute">
        <hr>
        <h3 class="panel-title"><i class="voyager-plus"></i> {{ __('voyager.products.properties.new') }}</h3>
    </div>
    <div class="panel-body">
        <form action="{{ route('admin.postProductProperty') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="product_id" value="{{isset($dataTypeContent->id)?$dataTypeContent->id:''}}">
            <div class="col-md-6">
                <label for="display_name">{{ __('voyager.products.attribute.name') }}</label>
                <select class="form-control attribute_select attribute_select_new" name="name"  required="required">
                    @foreach($attributeNames as $attributeName)
                        <option value="{{ $attributeName->name }}" data-type="{{ $attributeName->group }}">{{ $attributeName->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="key">{{ __('voyager.products.attribute.value') }}</label>
                <input type="text" class="form-control" name="value" placeholder="{{ __('voyager.products.attribute.value_help') }}" required="required">
            </div>
            <div style="clear:both"></div>
            <button type="submit" class="btn btn-primary pull-right new-setting-btn">
                <i class="voyager-plus"></i> {{ __('voyager.products.properties.add_new') }}
            </button>
            <div style="clear:both"></div>
        </form>
    </div>
</div>
