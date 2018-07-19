<table class="table properties">
    @foreach($productAttributes as $attribute)
        <tr class="panel-heading">
            <td width="200">
                <h3>
                    {{ $attribute->attribute->name }}
                </h3>
            </td>
            <td>
                @foreach($attribute->details as $productAttributeDetail)
                    <a class="btn btn-default">{{$productAttributeDetail->attributeValue->value}} <span style="color: red">x</span></a>
                @endforeach
            </td>
            <td class="text-center" width="50">
                <i class="voyager-trash"
                   data-id="{{ $attribute->id }}"></i>
            </td>
        </tr>
    @endforeach
</table>
<div class="no-padding-left-right" style="margin-top:10px;">
    <div class="panel-heading new-attribute">
        <hr>
        <h3 class="panel-title"><i class="voyager-plus"></i> {{ __('voyager.products.properties.new') }}</h3>
    </div>
    <div class="panel-body no-padding-left-right">
        <form action="{{ route('admin.postProductAttribute') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="product_id" value="{{isset($dataTypeContent->id)?$dataTypeContent->id:''}}">
            <div class="col-md-6">
                <label for="display_name">{{ __('voyager.products.attribute.name') }}</label>
                <select class="form-control attribute_select attribute_select_new" name="name"  required="required">
                    @foreach($attributeNames as $attributeName)
                        <option value="{{ $attributeName->name }}">{{ $attributeName->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="key">{{ __('voyager.products.attribute.value') }}</label>
                <select type="text" class="form-control attribute_select_value" name="value[]" placeholder="{{ __('voyager.products.attribute.value_help') }}" required="required"></select>
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
