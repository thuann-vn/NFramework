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
                            <a class="btn btn-default delete-attribute-value">{{$productAttributeDetail->attributeValue->value}} <span style="color: red">x</span></a>
                            <form action="{{route('admin.deleteProductAttributeValue', $productAttributeDetail->id)}}" method="POST" enctype="multipart/form-data" class="hidden">
                                {{csrf_field()}}
                                {{method_field('delete')}}

                                <input type="hidden" name="product_id" value="{{$attribute->product_id}}">
                            </form>
                        @endforeach
                    </td>
                    <td class="text-center" width="50">
                        <a href="{{route('admin.deleteProductAttribute', $attribute->id)}}" class="delete-attribute">
                            <i class="voyager-trash"></i>
                        </a>

                        <form action="{{route('admin.deleteProductAttribute', $attribute->id)}}" method="POST" enctype="multipart/form-data" class="hidden">
                            {{csrf_field()}}
                            {{method_field('delete')}}

                            <input type="hidden" name="product_id" value="{{$attribute->product_id}}">
                        </form>
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
                <form class="form-edit-add" action="{{ route('admin.postProductAttribute') }}" method="POST">
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
                <button type="button" class="btn btn-danger" id="deleteAllVariants">{{__('voyager.product.variants.delete_all')}}</button>
                <a href="{{route('admin.generateProductVariants', $dataTypeContent->id)}}" class="btn btn-primary" id="generateVariants">{{__('voyager.product.variants.generate')}}</a>
            </div>
        </div>

        <div class="alert alert-info alert-sm">
            <strong>{{__('voyager.product.variants.title')}}:</strong>
            <p>{{__('voyager.product.variants.description')}}</p>
        </div>

        <div class="collapsible product-variants">
            @forelse($productSKUs as $key => $sku)
                <div class="collapse-head collapsed" data-toggle="collapse" data-target="#sku{{$key}}" aria-expanded="false" aria-controls="links">
                    <h4>{{$sku->name}}</h4>
                    <i class="voyager-angle-down" style="display: inline;"></i>
                    <i class="voyager-angle-up" style="display: none;"></i>
                </div>
                <div class="collapse-content collapse" id="sku{{$key}}" aria-expanded="false">
                    <form method="post" class="form form-edit-add" action="{{route('admin.updateProductVariant', $sku->id)}}" enctype="multipart/form-data">
                        <input type="hidden" name="product_id" value="{{$sku->product_id}}">
                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}
                        <div class="form-group variant-image">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="image-picker" style="{{!empty($sku->image)?'background-image:url("' . filter_var($sku->image, FILTER_VALIDATE_URL) ? $dataTypeContent->image : Voyager::image( $sku->image ) . '")' : ''}}">
                                        <input type="file" name="image" accept="image/*">
                                        @if(!empty($sku->image))
                                            <img src="{{filter_var($sku->image, FILTER_VALIDATE_URL) ? $dataTypeContent->image : Voyager::image( $sku->image )}}">
                                        @else
                                            <img src="/img/voyager/placeholder.jpg"/>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4>{{ __('voyager.product.variants.details')}}</h4>
                                    @foreach($sku->details as $detail)
                                        <p style="color: #22A7F0"><strong>{{$detail->attributeValue->attribute->name}}</strong>: {{$detail->attributeValue->value}}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">{{ __('voyager.product.variants.name')}}</label>
                            <input class="form-control" name="name" value="{{$sku->name}}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">{{ __('voyager.product.variants.sku')}}</label>
                            <input class="form-control" name="sku" value="{{$sku->sku}}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">{{ __('voyager.product.variants.price')}}</label>
                            <input type="number" class="form-control" name="price" value="{{$sku->price}}" placeholder="{{ __('voyager.product.variants.price_placeholder')}}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('voyager.product.variants.update')}}</button>
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
