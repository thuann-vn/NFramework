<div class="row">
    <div class="col-md-6">
        <div class="heading-with-buttons">
            <h3><i class="voyager-book"></i> {{__('voyager.product.attributes.title')}}</h3>
        </div>

        <div class="alert alert-info alert-sm">
            <strong>{{__('voyager.product.attributes.title')}}:</strong>
            <p>{{__('voyager.product.attributes.description')}}</p>
        </div>

        <table class="table properties">
            @foreach($productAttributes as $attribute)
                <tr class="panel-heading">
                    <td width="100">
                        <h3>
                            {{ $attribute->attribute->name }}
                        </h3>
                    </td>
                    <td>
                        @foreach($attribute->details as $productAttributeDetail)
                            <a class="btn btn-default delete-attribute" data-id="{{$productAttributeDetail->id}}">{{$productAttributeDetail->attributeValue->value}} <span style="color: red">x</span></a>
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
                <h3 class="panel-title"><i class="voyager-plus"></i> {{ __('voyager.products.attribute.new') }}</h3>
            </div>
            <div class="panel-body no-padding-left-right">
                <form action="{{ route('admin.postProductAttribute') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="product_id" value="{{isset($dataTypeContent->id)?$dataTypeContent->id:''}}">
                    <div class="col-md-6">
                        <label for="display_name">{{ __('voyager.products.attribute.name') }}</label>
                        <select class="form-control attribute_select attribute_select_new" placeholder="{{ __('voyager.products.attribute.select_attribute') }}" name="name"  required="required">
                            @foreach($attributeNames as $attributeName)
                                <option value="{{ $attributeName->name }}">{{ $attributeName->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="key">{{ __('voyager.products.attribute.value') }}</label>
                        <select type="text" class="form-control attribute_select_value" name="value[]" placeholder="{{ __('voyager.products.attribute.select_attribute_value') }}" required="required"></select>
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
    </div>
    <div class="col-md-6">
        <div class="heading-with-buttons">
            <h3><i class="voyager-buy"></i> {{__('voyager.product.variants.title')}}</h3>

            <div class="heading-buttons">
                <button type="button" class="btn btn-danger">{{__('voyager.product.variants.delete_all')}}</button>
                <a href="{{route('admin.generateProductVariants', $dataTypeContent->id)}}" class="btn btn-primary" id="generateVariants">{{__('voyager.product.variants.generate')}}</a>
            </div>
        </div>

        <div class="alert alert-info alert-sm">
            <strong>{{__('voyager.product.variants.title')}}:</strong>
            <p>{{__('voyager.product.variants.description')}}</p>
        </div>

        <div class="collapsible">
            @forelse($productSKUs as $sku)
                <div class="collapse-head collapsed" data-toggle="collapse" data-target="#links" aria-expanded="false" aria-controls="links">
                    <h4>{{$sku->name}}</h4>
                    <i class="voyager-angle-down" style="display: inline;"></i>
                    <i class="voyager-angle-up" style="display: none;"></i>
                </div>
                <div class="collapse-content collapse" id="links" aria-expanded="false" style="height: 30px;">
                    <form method="post" class="form">
                        <div class="form-group">
                            <label class="control-label">{{__('voyager.product.variants.image')}}</label>

                        </div>
                    </form>
                </div>
            @empty
                <div class="attribute-empty">
                    <i class="voyager-plus"></i> {!! __('voyager.product.variants.empty') !!}
                </div>
            @endforelse
        </div>
    </div>
</div>
