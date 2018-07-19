@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('voyager::compass.includes.styles')


@section('css')
    <style>
        .sort-icons {
            font-size: 21px;
            color: #ccc;
            position: relative;
            cursor: pointer;
        }
        .sort-icons:hover, .voyager-trash:hover {
            color: #37474F;
        }
        .voyager-sort-desc {
            margin-right: 10px;
        }
        .voyager-sort-asc {
            top: 10px;
        }
        .page-title {
            margin-bottom: 0;
        }
        .panel-title code {
            border-radius: 30px;
            padding: 5px 10px;
            font-size: 11px;
            border: 0;
            position: relative;
            top: -2px;
        }
        .modal-open .settings  .select2-container {
            z-index: 9!important;
            width: 100%!important;
        }
        .new-property, .new-attribute {
            text-align: center;
            width: 100%;
            margin-top: 20px;
        }
        .new-property .panel-title, .new-attribute .panel-title {
            margin: 0 auto;
            display: inline-block;
            color: #999fac;
            font-weight: lighter;
            font-size: 13px;
            background: #fff;
            width: auto;
            height: auto;
            position: relative;
            padding-right: 15px;
        }
        .new-property hr , .new-attribute hr {
            margin-bottom: 0;
            position: absolute;
            top: 7px;
            width: 96%;
            margin-left: 2%;
        }
        .new-property .panel-title i, .new-attribute .panel-title i {
            position: relative;
            top: 2px;
        }
        .new-propertys-options {
            display: none;
            padding-bottom: 10px;
        }
        .new-propertys-options label {
            margin-top: 13px;
        }
        .new-propertys-options .alert {
            margin-bottom: 0;
        }
        .new-property-btn {
            margin-right: 15px;
            position: relative;
            margin-bottom: 0;
            top: 5px;
        }
        .new-property-btn i {
            position: relative;
            top: 2px;
        }
        textarea {
            min-height: 120px;
        }
        textarea.hidden{
            display:none;
        }

        .voyager .settings .nav-tabs{
            background:none;
            border-bottom:0px;
        }

        .voyager .settings .nav-tabs .active a{
            border:0px;
        }

        .select2{
            width:100% !important;
            border: 1px solid #f1f1f1;
            border-radius: 3px;
        }

        .voyager .settings input[type=file]{
            width:100%;
        }

        .voyager .settings .nav-tabs > li{
            margin-bottom:-1px !important;
        }

        .voyager .settings .nav-tabs a i{
            display: block;
            font-size: 22px;
        }

        .no-padding-left-right{
            padding-left:0px;
            padding-right:0px;
        }

        .voyager .properties .nav-tabs > li > a:hover{
            background-color:#fff !important;
        }
    </style>
@stop

@section('page_title', __('voyager.generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular)

@section('page_header')
    <div class="page-title-wrapper">
        <h1 class="page-title">
            <i class="{{ $dataType->icon }}"></i>
            {{ __('voyager.generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular }}
        </h1>
        <button form="product_form" type="submit" class="btn btn-primary save">{{ __('voyager.generic.save') }}</button>
        @include('voyager::multilingual.language-selector')
    </div>
@stop

@section('content')
    <div id="gradient_bg"></div>
    <div class="page-content compass container-fluid">
        <ul class="nav nav-tabs">
            <li @if(empty($active_tab) || (isset($active_tab) && $active_tab == 'detail')){!! 'class="active"' !!}@endif><a data-toggle="tab" href="#detail"><i class="voyager-documentation"></i> {{ __('voyager.products.detail') }}</a></li>
            <li @if($active_tab == 'properties'){!! 'class="active"' !!}@endif><a data-toggle="tab" href="#properties"><i class="voyager-tag"></i> {{ __('voyager.products.properties') }}</a></li>
            <li @if($active_tab == 'attributes'){!! 'class="active"' !!}@endif><a data-toggle="tab" href="#attributes"><i class="voyager-archive"></i> {{ __('voyager.products.attributes') }}</a></li>
        </ul>

        <div class="tab-content">
            <div id="detail" class="tab-pane fade in @if(empty($active_tab) || (isset($active_tab) && $active_tab == 'detail')){!! 'active' !!}@endif">
                @include('vendor.voyager.products.includes.detail')
            </div>

            <div id="properties" class="tab-pane fade in @if($active_tab == 'properties'){!! 'active' !!}@endif">
                @include('vendor.voyager.products.includes.properties')
            </div>

            <div id="attributes" class="tab-pane fade in @if($active_tab == 'attributes'){!! 'active' !!}@endif">
                @include('vendor.voyager.products.includes.attributes')
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager.generic.are_you_sure') }}
                    </h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager.generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{{ __('voyager.generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger"
                            id="confirm_delete">{{ __('voyager.generic.delete_confirm') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {};
        var $image;

        $('document').ready(function () {
            $('.form-group').on('click', '.remove-multi-image', function (e) {
                e.preventDefault();
                $image = $(this).siblings('img');
                params = {
                    slug: '{{ $dataType->slug }}',
                    image: $image.data('image'),
                    id: $image.data('id'),
                    field: $image.parent().data('field-name'),
                    _token: '{{ csrf_token() }}'
                }

                $('.confirm_delete_name').text($image.data('image'));
                $('#confirm_delete_modal').modal('show');
            });

            $('#confirm_delete').on('click', function () {
                $.post('{{ route('voyager.media.remove') }}', params, function (response) {
                    if (response
                        && response.data
                        && response.data.status
                        && response.data.status == 200) {

                        toastr.success(response.data.message);
                        $image.parent().fadeOut(300, function () {
                            $(this).remove();
                        })
                    } else {
                        toastr.error("Error removing image.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script src="{{asset('js/admin/product.js')}}"></script>
@stop
