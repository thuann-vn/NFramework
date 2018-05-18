<!-- form start -->
<form role="form"
      class="form-edit-add"
      action="@if(isset($dataTypeContent->id)){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->id) }}@else{{ route('voyager.'.$dataType->slug.'.store') }}@endif"
      method="POST" enctype="multipart/form-data" name="product_form" id="product_form">

    <!-- PUT Method if we are editing -->
@if(isset($dataTypeContent->id))
    {{ method_field("PUT") }}
@endif

<!-- CSRF TOKEN -->
    {{ csrf_field() }}

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-9">
            <!-- ### TITLE ### -->
            <div class="panel">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="voyager-character"></i> {{ __('voyager.product.name') }}
                        <span class="panel-desc"> {{ __('voyager.product.name_sub') }}</span>
                    </h3>
                    <div class="panel-actions">
                        <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        @include('voyager::multilingual.input-hidden', [
                            '_field_name'  => 'name',
                            '_field_trans' => get_field_translations($dataTypeContent, 'name')
                        ])
                        <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('voyager.product.name') }}" value="@if(isset($dataTypeContent->name)){{ $dataTypeContent->name }}@endif">
                    </div>
                    <div class="form-group">
                        <label for="details">{{ __('voyager.product.details') }}</label>
                        @include('voyager::multilingual.input-hidden', [
                            '_field_name'  => 'details',
                            '_field_trans' => get_field_translations($dataTypeContent, 'details')
                        ])
                        <textarea class="form-control" name="details">@if(isset($dataTypeContent->details)){{ $dataTypeContent->details }}@endif</textarea>
                    </div>
                </div>
            </div>


            <!-- ### CONTENT ### -->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ __('voyager.product.content') }}</h3>
                    <div class="panel-actions">
                        <a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
                    </div>
                </div>
                @include('voyager::multilingual.input-hidden', [
                    '_field_name'  => 'description',
                    '_field_trans' => get_field_translations($dataTypeContent, 'description')
                ])
                @php
                    $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};
                    $row = $dataTypeRows->where('field', 'description')->first();
                @endphp

                <div class="panel-body">
                    {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                </div>
            </div><!-- .panel -->

            <!-- ### IMAGES ### -->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="icon wb-search"></i> {{ __('voyager.product.images') }}</h3>
                    <div class="panel-actions">
                        <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                    </div>
                </div>
                <div class="panel-body">
                    @if(isset($dataTypeContent->images))
                        <?php $images = json_decode($dataTypeContent->images); ?>
                        @if($images != null)
                            @foreach($images as $image)
                                <img src="{{ Voyager::image( $image ) }}" style="width:200px; height:auto; clear:both; padding:2px; border:1px solid #ddd; margin-bottom:10px;" />
                            @endforeach
                        @endif
                    @endif
                    <input type="file" name="images[]" multiple="multiple">
                </div>
            </div>

            <!-- ### SEO CONTENT ### -->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="icon wb-search"></i> {{ __('voyager.product.seo_content') }}</h3>
                    <div class="panel-actions">
                        <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="seo_title">{{ __('voyager.product.seo_title') }}</label>
                        @include('voyager::multilingual.input-hidden', [
                            '_field_name'  => 'seo_title',
                            '_field_trans' => get_field_translations($dataTypeContent, 'seo_title')
                        ])
                        <input type="text" class="form-control" name="seo_title" placeholder="SEO Title" value="@if(isset($dataTypeContent->seo_title)){{ $dataTypeContent->seo_title }}@endif">
                    </div>
                    <div class="form-group">
                        <label for="meta_keywords">{{ __('voyager.product.meta_keywords') }}</label>
                        @include('voyager::multilingual.input-hidden', [
                            '_field_name'  => 'meta_keywords',
                            '_field_trans' => get_field_translations($dataTypeContent, 'meta_keywords')
                        ])
                        <textarea class="form-control" name="meta_keywords">@if(isset($dataTypeContent->meta_keywords)){{ $dataTypeContent->meta_keywords }}@endif</textarea>
                    </div>
                    <div class="form-group">
                        <label for="meta_description">{{ __('voyager.product.meta_description') }}</label>
                        @include('voyager::multilingual.input-hidden', [
                            '_field_name'  => 'meta_description',
                            '_field_trans' => get_field_translations($dataTypeContent, 'meta_description')
                        ])
                        <textarea class="form-control" name="meta_description">@if(isset($dataTypeContent->meta_description)){{ $dataTypeContent->meta_description }}@endif</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <!-- ### STATUS ### -->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="voyager-character"></i> {{ __('voyager.product.status') }}
                    </h3>
                    <div class="panel-actions">
                        <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <input type="checkbox" name="featured" class="toggleswitch"
                               data-on="Yes" {!! isset($dataTypeContent->featured) && $dataTypeContent->featured ? 'checked="checked"' : '' !!}
                               data-off="No">
                        <label for="featured">{{ __('voyager::generic.featured') }}</label>
                    </div>
                    <div class="form-group">
                        <label for="slug">{{ __('voyager.product.slug') }}</label>
                        @include('voyager::multilingual.input-hidden', [
                            '_field_name'  => 'slug',
                            '_field_trans' => get_field_translations($dataTypeContent, 'slug')
                        ])
                        <input type="text" class="form-control" id="slug" name="slug"
                               placeholder="slug"
                               {{!! isFieldSlugAutoGenerator($dataType, $dataTypeContent, "slug") !!}}
                               value="@if(isset($dataTypeContent->slug)){{ $dataTypeContent->slug }}@endif">
                    </div>
                    <div class="form-group">
                        <label for="status">{{ __('voyager.product.status') }}</label>
                        <select class="form-control" name="status">
                            <option value="PUBLISHED"@if(isset($dataTypeContent->status) && $dataTypeContent->status == 'PUBLISHED') selected="selected"@endif>{{ __('voyager::post.status_published') }}</option>
                            <option value="DRAFT"@if(isset($dataTypeContent->status) && $dataTypeContent->status == 'DRAFT') selected="selected"@endif>{{ __('voyager::post.status_draft') }}</option>
                            <option value="PENDING"@if(isset($dataTypeContent->status) && $dataTypeContent->status == 'PENDING') selected="selected"@endif>{{ __('voyager::post.status_pending') }}</option>
                        </select>
                    </div>
                </div>
            </div>


            <!-- ### PRICE ### -->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="voyager-character"></i> {{ __('voyager.product.price') }}
                    </h3>
                    <div class="panel-actions">
                        <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="price" id="price" value="@if(isset($dataTypeContent->price)){{ $dataTypeContent->price }}@endif"></input>
                    </div>
                    <div class="form-group">
                        <label for="regular_price">{{ __('voyager.product.regular_price') }}</label>
                        <input type="text" class="form-control" name="regular_price" id="regular_price" value="@if(isset($dataTypeContent->regular_price)){{ $dataTypeContent->regular_price }}@endif"></input>
                    </div>
                </div>
            </div>

            <!-- ### CATEGORY AND GROUP ### -->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="voyager-character"></i> {{ __('voyager.product.category') }}
                    </h3>
                    <div class="panel-actions">
                        <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>{{ __('voyager.product.Categories') }}</label>

                        <ul style="list-style-type: none; padding-left: 0">
                            @foreach ($allCategories as $category)
                                <li>
                                    <label>
                                        <input value="{{ $category->id }}" type="checkbox" name="category[]" style="margin-right: 5px;" {{ $categoriesForProduct->contains($category) ? 'checked' : '' }}>{{ $category->name }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div> <!-- end form-group -->
                </div>
            </div>


            <!-- ### IMAGE ### -->
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="icon wb-image"></i> {{ __('voyager.product.image') }}</h3>
                    <div class="panel-actions">
                        <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                    </div>
                </div>
                <div class="panel-body">
                    @if(isset($dataTypeContent->image))
                        <img src="{{ filter_var($dataTypeContent->image, FILTER_VALIDATE_URL) ? $dataTypeContent->image : Voyager::image( $dataTypeContent->image ) }}" style="width:100%" />
                    @endif
                    <input type="file" name="image">
                </div>
            </div>
        </div>
    </div>
</form>