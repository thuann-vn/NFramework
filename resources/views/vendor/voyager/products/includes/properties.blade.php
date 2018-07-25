<table class="table properties">
    @foreach($productProperties as $property)
        <tr class="panel-heading">
            <td width="200">
                <h3>
                    {{ $property->property->name }}
                </h3>
            </td>
            <td>
                <input type="text" value="{{$property->value}}" class="form-control" name="value" placeholder="{{ __('voyager.product.properties.value_help') }}" required="required">
            </td>
            <td class="text-center" width="80">
                <a href="{{route('admin.deleteProductProperty', $property->id)}}" class="delete-property">
                    <i class="voyager-trash"></i>
                </a>

                <form action="{{route('admin.deleteProductProperty', $property->id)}}" method="POST" enctype="multipart/form-data" class="hidden">
                    {{csrf_field()}}
                    {{method_field('delete')}}

                    <input type="hidden" name="product_id" value="{{$property->product_id}}">
                </form>
            </td>
        </tr>
    @endforeach
</table>
<div class="no-padding-left-right" style="margin-top:10px;">
    <div class="panel-heading new-property">
        <hr>
        <h3 class="panel-title"><i class="voyager-plus"></i> {{ __('voyager.product.properties.new') }}</h3>
    </div>
    <div class="panel-body no-padding-left-right">
        <form action="{{ route('admin.postProductProperty') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="product_id" value="{{isset($dataTypeContent->id)?$dataTypeContent->id:''}}">
            <div class="col-md-6">
                <label for="display_name">{{ __('voyager.product.properties.name') }}</label>
                <select class="form-control property_select property_select_new" name="name"  required="required" placeholder="{{ __('voyager.product.properties.select_property') }}">
                    @foreach($propertyNames as $propertyName)
                        <option value="{{ $propertyName->name }}" data-type="{{ $propertyName->group }}">{{ $propertyName->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="key">{{ __('voyager.product.properties.value') }}</label>
                <input type="text" class="form-control" name="value" placeholder="{{ __('voyager.product.properties.value_help') }}" required="required">
            </div>
            <div style="clear:both"></div>
            <div class="col-lg-12">
                <button type="submit" class="btn btn-primary pull-right new-setting-btn">
                    <i class="voyager-plus"></i> {{ __('voyager.product.properties.add_new') }}
                </button>
            </div>
            <div style="clear:both"></div>
        </form>
    </div>
</div>
