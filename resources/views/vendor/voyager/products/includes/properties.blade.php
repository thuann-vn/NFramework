<table class="table properties">
    @foreach($productProperties as $property)
        <tr class="panel-heading">
            <td width="200">
                <h3>
                    {{ $property->property->name }}
                </h3>
            </td>
            <td>
                <input type="text" value="{{$property->value}}" class="form-control" name="value" placeholder="{{ __('voyager.products.property.value_help') }}" required="required">
            </td>
            <td class="text-center" width="120">
                <a href="{{ route('voyager.settings.move_up', $property->id) }}">
                    <i class="sort-icons voyager-sort-asc"></i>
                </a>
                <a href="{{ route('voyager.settings.move_down', $property->id) }}">
                    <i class="sort-icons voyager-sort-desc"></i>
                </a>
                <i class="voyager-trash"
                   data-id="{{ $property->id }}"
                   data-display-name="{{ $property->value }}"></i>
            </td>
        </tr>
    @endforeach
</table>
<div class="no-padding-left-right" style="margin-top:10px;">
    <div class="panel-heading new-property">
        <hr>
        <h3 class="panel-title"><i class="voyager-plus"></i> {{ __('voyager.products.properties.new') }}</h3>
    </div>
    <div class="panel-body no-padding-left-right">
        <form action="{{ route('admin.postProductAttribute') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="product_id" value="{{isset($dataTypeContent->id)?$dataTypeContent->id:''}}">
            <div class="col-md-6">
                <label for="display_name">{{ __('voyager.products.property.name') }}</label>
                <select class="form-control property_select property_select_new" name="name"  required="required">
                    @foreach($propertyNames as $propertyName)
                        <option value="{{ $propertyName->name }}" data-type="{{ $propertyName->group }}">{{ $propertyName->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="key">{{ __('voyager.products.property.value') }}</label>
                <input type="text" class="form-control" name="value" placeholder="{{ __('voyager.products.property.value_help') }}" required="required">
            </div>
            <div style="clear:both"></div>
            <div class="col-lg-12">
                <button type="submit" class="btn btn-primary pull-right new-setting-btn">
                    <i class="voyager-plus"></i> {{ __('voyager.products.properties.add_new') }}
                </button>
            </div>
            <div style="clear:both"></div>
        </form>
    </div>
</div>
