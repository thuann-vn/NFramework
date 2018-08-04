@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.$dataType->display_name_plural)


@section('css')
    <style>
        table td{
            vertical-align: middle !important;
        }

        table .parent td{
            font-weight: bold;
        }

        .toggle{
            display: inline-block;
            padding: 4px 8px;
            border: 1px solid #eee;
            border-radius: 2px;
            color: #333;
        }
        table .child .child-tree{
            display: block;
            height: 100%;
            border-left: 1px dashed #ccc;
            width: 1px;
            position: absolute;
            top: 0;
            left: 50%;
        }

        table .child .child-tree:before{
            content: '';
            width: 30px;
            border-top: 1px dashed #ccc;
            position: absolute;
            top: 50%;
            left: 50%;
            display: block;
        }
        table tbody .child:last-child .child-tree{
            height: 50%;
        }
        table tbody .child:last-child .child-tree:before{
            top: 100%
        }
    </style>
@stop

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="{{ $dataType->icon }}"></i> {{ $dataType->display_name_plural }}
        </h1>
        @can('add',app($dataType->model_name))
            <a href="{{ route('voyager.'.$dataType->slug.'.create') }}" class="btn btn-success btn-add-new">
                <i class="voyager-plus"></i> <span>{{ __('voyager::generic.add_new') }}</span>
            </a>
        @endcan
        @can('delete',app($dataType->model_name))
            @include('voyager::partials.bulk-delete')
        @endcan
        @can('edit',app($dataType->model_name))
            @if(isset($dataType->order_column) && isset($dataType->order_display_column))
                <a href="{{ route('voyager.'.$dataType->slug.'.order') }}" class="btn btn-primary">
                    <i class="voyager-list"></i> <span>{{ __('voyager::bread.order') }}</span>
                </a>
            @endif
        @endcan
        @include('voyager::multilingual.language-selector')
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    @can('delete',app($dataType->model_name))
                                        <th>
                                            <input type="checkbox" class="select_all">
                                        </th>
                                    @endcan
                                    @foreach($dataType->browseRows as $row)
                                        <th>
                                            @if ($isServerSide)
                                                <a href="{{ $row->sortByUrl() }}">
                                                    @endif
                                                    {{ $row->display_name }}
                                                    @if ($isServerSide)
                                                        @if ($row->isCurrentSortField())
                                                            @if (!isset($_GET['sort_order']) || $_GET['sort_order'] == 'asc')
                                                                <i class="voyager-angle-up pull-right"></i>
                                                            @else
                                                                <i class="voyager-angle-down pull-right"></i>
                                                            @endif
                                                        @endif
                                                </a>
                                            @endif
                                        </th>
                                    @endforeach
                                    <th class="actions text-right">{{ __('voyager::generic.actions') }}</th>
                                </tr>
                                </thead>
                                @foreach($dataTypeContent as $data)
                                    <tbody class="category-list">
                                    <tr class="parent">
                                        <td style="text-align: center">
                                            @if($data->children->count()>0)
                                                <a class="toggle"><i class="voyager-angle-down"> </i></a>
                                            @endif
                                        </td>
                                        @can('delete',app($dataType->model_name))
                                            <td>
                                                <input type="checkbox" name="row_id" id="checkbox_{{ $data->getKey() }}"
                                                       value="{{ $data->getKey() }}">
                                            </td>
                                        @endcan
                                        @foreach($dataType->browseRows as $row)
                                            <td>
                                                <?php $options = json_decode($row->details); ?>
                                                @if($row->type == 'image')
                                                    <img
                                                        src="@if( !filter_var($data->{$row->field}, FILTER_VALIDATE_URL)){{ Voyager::image( $data->{$row->field} ) }}@else{{ $data->{$row->field} }}@endif"
                                                        style="width:100px">
                                                @elseif($row->type == 'relationship')
                                                    @include('voyager::formfields.relationship', ['view' => 'browse'])
                                                @elseif($row->type == 'select_multiple')
                                                    @if(property_exists($options, 'relationship'))

                                                        @foreach($data->{$row->field} as $item)
                                                            @if($item->{$row->field . '_page_slug'})
                                                                <a href="{{ $item->{$row->field . '_page_slug'} }}">{{ $item->{$row->field} }}</a>@if(!$loop->last)
                                                                    , @endif
                                                            @else
                                                                {{ $item->{$row->field} }}
                                                            @endif
                                                        @endforeach

                                                        {{-- $data->{$row->field}->implode($options->relationship->label, ', ') --}}
                                                    @elseif(property_exists($options, 'options'))
                                                        @foreach($data->{$row->field} as $item)
                                                            {{ $options->options->{$item} . (!$loop->last ? ', ' : '') }}
                                                        @endforeach
                                                    @endif

                                                @elseif($row->type == 'select_dropdown' && property_exists($options, 'options'))

                                                    @if($data->{$row->field . '_page_slug'})
                                                        <a href="{{ $data->{$row->field . '_page_slug'} }}">{!! $options->options->{$data->{$row->field}} !!}</a>
                                                    @else
                                                        {!! $options->options->{$data->{$row->field}} or '' !!}
                                                    @endif


                                                @elseif($row->type == 'select_dropdown' && $data->{$row->field . '_page_slug'})
                                                    <a href="{{ $data->{$row->field . '_page_slug'} }}">{{ $data->{$row->field} }}</a>
                                                @elseif($row->type == 'date' || $row->type == 'timestamp')
                                                    {{ $options && property_exists($options, 'format') ? \Carbon\Carbon::parse($data->{$row->field})->formatLocalized($options->format) : $data->{$row->field} }}
                                                @elseif($row->type == 'checkbox')
                                                    @if($options && property_exists($options, 'on') && property_exists($options, 'off'))
                                                        @if($data->{$row->field})
                                                            <span class="label label-info">{{ $options->on }}</span>
                                                        @else
                                                            <span class="label label-primary">{{ $options->off }}</span>
                                                        @endif
                                                    @else
                                                        {{ $data->{$row->field} }}
                                                    @endif
                                                @elseif($row->type == 'color')
                                                    <span class="badge badge-lg"
                                                          style="background-color: {{ $data->{$row->field} }}">{{ $data->{$row->field} }}</span>
                                                @elseif($row->type == 'text')
                                                    @include('voyager::multilingual.input-hidden-bread-browse')
                                                    <div
                                                        class="readmore">{{ mb_strlen( $data->{$row->field} ) > 200 ? mb_substr($data->{$row->field}, 0, 200) . ' ...' : $data->{$row->field} }}</div>
                                                @elseif($row->type == 'text_area')
                                                    @include('voyager::multilingual.input-hidden-bread-browse')
                                                    <div
                                                        class="readmore">{{ mb_strlen( $data->{$row->field} ) > 200 ? mb_substr($data->{$row->field}, 0, 200) . ' ...' : $data->{$row->field} }}</div>
                                                @elseif($row->type == 'file' && !empty($data->{$row->field}) )
                                                    @include('voyager::multilingual.input-hidden-bread-browse')
                                                    @if(json_decode($data->{$row->field}))
                                                        @foreach(json_decode($data->{$row->field}) as $file)
                                                            <a href="{{ Storage::disk(config('voyager.storage.disk'))->url($file->download_link) ?: '' }}"
                                                               target="_blank">
                                                                {{ $file->original_name ?: '' }}
                                                            </a>
                                                            <br/>
                                                        @endforeach
                                                    @else
                                                        <a href="{{ Storage::disk(config('voyager.storage.disk'))->url($data->{$row->field}) }}"
                                                           target="_blank">
                                                            Download
                                                        </a>
                                                    @endif
                                                @elseif($row->type == 'rich_text_box')
                                                    @include('voyager::multilingual.input-hidden-bread-browse')
                                                    <div
                                                        class="readmore">{{ mb_strlen( strip_tags($data->{$row->field}, '<b><i><u>') ) > 200 ? mb_substr(strip_tags($data->{$row->field}, '<b><i><u>'), 0, 200) . ' ...' : strip_tags($data->{$row->field}, '<b><i><u>') }}</div>
                                                @elseif($row->type == 'coordinates')
                                                    @include('voyager::partials.coordinates-static-image')
                                                @elseif($row->type == 'multiple_images')
                                                    @php $images = json_decode($data->{$row->field}); @endphp
                                                    @if($images)
                                                        @php $images = array_slice($images, 0, 3); @endphp
                                                        @foreach($images as $image)
                                                            <img
                                                                src="@if( !filter_var($image, FILTER_VALIDATE_URL)){{ Voyager::image( $image ) }}@else{{ $image }}@endif"
                                                                style="width:50px">
                                                        @endforeach
                                                    @endif
                                                @else
                                                    @include('voyager::multilingual.input-hidden-bread-browse')
                                                    <span>{{ $data->{$row->field} }}</span>
                                                @endif
                                            </td>
                                        @endforeach
                                        <td class="no-sort no-click" id="bread-actions">
                                            @foreach(Voyager::actions() as $action)
                                                @include('voyager::bread.partials.actions', ['action' => $action])
                                            @endforeach
                                        </td>
                                    </tr>
                                    @foreach($data->children as $child)
                                        <tr class="child">
                                            <td style="position: relative"><span class="child-tree"></span></td>
                                            @can('delete',app($dataType->model_name))
                                                <td>
                                                    <input type="checkbox" name="row_id" id="checkbox_{{ $child->id }}"
                                                           value="{{ $child->id }}">
                                                </td>
                                            @endcan
                                            @foreach($dataType->browseRows as $row)
                                                <td>
                                                    <?php $options = json_decode($row->details); ?>
                                                    @if($row->type == 'image')
                                                        <img
                                                            src="@if( !filter_var($child->{$row->field}, FILTER_VALIDATE_URL)){{ Voyager::image( $child->{$row->field} ) }}@else{{ $child->{$row->field} }}@endif"
                                                            style="width:100px">
                                                        @elseif($row->type == 'relationship')
                                                            @include('voyager::formfields.relationship', ['view' => 'browse'])
                                                        @elseif($row->type == 'select_multiple')
                                                        @if(property_exists($options, 'relationship'))

                                                            @foreach($child->{$row->field} as $item)
                                                                @if($item->{$row->field . '_page_slug'})
                                                                    <a href="{{ $item->{$row->field . '_page_slug'} }}">{{ $item->{$row->field} }}</a>@if(!$loop->last)
                                                                        , @endif
                                                                @else
                                                                    {{ $item->{$row->field} }}
                                                                @endif
                                                            @endforeach

                                                        @elseif(property_exists($options, 'options'))
                                                            @foreach($child->{$row->field} as $item)
                                                                {{ $options->options->{$item} . (!$loop->last ? ', ' : '') }}
                                                            @endforeach
                                                        @endif

                                                    @elseif($row->type == 'select_dropdown' && property_exists($options, 'options'))

                                                        @if($child->{$row->field . '_page_slug'})
                                                            <a href="{{ $child->{$row->field . '_page_slug'} }}">{!! $options->options->{$child->{$row->field}} !!}</a>
                                                        @else
                                                            {!! $options->options->{$child->{$row->field}} or '' !!}
                                                        @endif


                                                    @elseif($row->type == 'select_dropdown' && $child->{$row->field . '_page_slug'})
                                                        <a href="{{ $child->{$row->field . '_page_slug'} }}">{{ $child->{$row->field} }}</a>
                                                    @elseif($row->type == 'date' || $row->type == 'timestamp')
                                                        {{ $options && property_exists($options, 'format') ? \Carbon\Carbon::parse($child->{$row->field})->formatLocalized($options->format) : $child->{$row->field} }}
                                                    @elseif($row->type == 'checkbox')
                                                        @if($options && property_exists($options, 'on') && property_exists($options, 'off'))
                                                            @if($child->{$row->field})
                                                                <span class="label label-info">{{ $options->on }}</span>
                                                            @else
                                                                <span
                                                                    class="label label-primary">{{ $options->off }}</span>
                                                            @endif
                                                        @else
                                                            {{ $child->{$row->field} }}
                                                        @endif
                                                    @elseif($row->type == 'color')
                                                        <span class="badge badge-lg"
                                                              style="background-color: {{ $child->{$row->field} }}">{{ $child->{$row->field} }}</span>
                                                    @elseif($row->type == 'text')
                                                        @include('voyager::multilingual.input-hidden-bread-browse', ['data'=> $child])
                                                        <div
                                                            class="readmore">{{ mb_strlen( $child->{$row->field} ) > 200 ? mb_substr($child->{$row->field}, 0, 200) . ' ...' : $child->{$row->field} }}</div>
                                                    @elseif($row->type == 'text_area')
                                                        @include('voyager::multilingual.input-hidden-bread-browse', ['data'=> $child])
                                                        <div
                                                            class="readmore">{{ mb_strlen( $child->{$row->field} ) > 200 ? mb_substr($child->{$row->field}, 0, 200) . ' ...' : $child->{$row->field} }}</div>
                                                    @elseif($row->type == 'file' && !empty($child->{$row->field}) )
                                                        @include('voyager::multilingual.input-hidden-bread-browse', ['data'=> $child])
                                                        @if(json_decode($child->{$row->field}))
                                                            @foreach(json_decode($child->{$row->field}) as $file)
                                                                <a href="{{ Storage::disk(config('voyager.storage.disk'))->url($file->download_link) ?: '' }}"
                                                                   target="_blank">
                                                                    {{ $file->original_name ?: '' }}
                                                                </a>
                                                                <br/>
                                                            @endforeach
                                                        @else
                                                            <a href="{{ Storage::disk(config('voyager.storage.disk'))->url($child->{$row->field}) }}"
                                                               target="_blank">
                                                                Download
                                                            </a>
                                                        @endif
                                                    @elseif($row->type == 'rich_text_box')
                                                        @include('voyager::multilingual.input-hidden-bread-browse', ['data'=> $child])
                                                        <div
                                                            class="readmore">{{ mb_strlen( strip_tags($child->{$row->field}, '<b><i><u>') ) > 200 ? mb_substr(strip_tags($child->{$row->field}, '<b><i><u>'), 0, 200) . ' ...' : strip_tags($child->{$row->field}, '<b><i><u>') }}</div>
                                                    @elseif($row->type == 'coordinates')
                                                        @include('voyager::partials.coordinates-static-image')
                                                    @elseif($row->type == 'multiple_images')
                                                        @php $images = json_decode($child->{$row->field}); @endphp
                                                        @if($images)
                                                            @php $images = array_slice($images, 0, 3); @endphp
                                                            @foreach($images as $image)
                                                                <img
                                                                    src="@if( !filter_var($image, FILTER_VALIDATE_URL)){{ Voyager::image( $image ) }}@else{{ $image }}@endif"
                                                                    style="width:50px">
                                                            @endforeach
                                                        @endif
                                                    @else
                                                        @include('voyager::multilingual.input-hidden-bread-browse', ['data'=> $child])
                                                        <span>{{ $child->{$row->field} }}</span>
                                                    @endif
                                                </td>
                                            @endforeach

                                            <td class="no-sort no-click" id="bread-actions">
                                                @foreach(Voyager::actions() as $action)
                                                    @include('voyager::bread.partials.actions', ['action' => $action, 'data'=>$child])
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="{{ __('voyager::generic.close') }}"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i
                            class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }} {{ strtolower($dataType->display_name_singular) }}
                        ?</h4>
                </div>
                <div class="modal-footer">
                    <form action="#" id="delete_form" method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="{{ __('voyager::generic.delete_confirm') }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right"
                            data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('css')
    @if(!$dataType->server_side && config('dashboard.data_tables.responsive'))
        <link rel="stylesheet" href="{{ voyager_asset('lib/css/responsive.dataTables.min.css') }}">
    @endif
@stop

@section('javascript')
    <!-- DataTables -->
    @if(!$dataType->server_side && config('dashboard.data_tables.responsive'))
        <script src="{{ voyager_asset('lib/js/dataTables.responsive.min.js') }}"></script>
    @endif
    <script>
        $(document).ready(function () {
                @if (!$dataType->server_side)
            var table = $('#dataTable').DataTable({!! json_encode(
                    array_merge([
                        "order" => [],
                        "language" => __('voyager::datatable'),
                        "columnDefs" => [['targets' => -1, 'searchable' =>  false, 'orderable' => false]],
                    ],
                    config('voyager.dashboard.data_tables', []))
                , true) !!});
            @else
            $('#search-input select').select2({
                minimumResultsForSearch: Infinity
            });
            @endif

            @if ($isModelTranslatable)
            $('.side-body').multilingual();
            //Reinitialise the multilingual features when they change tab
            $('#dataTable').on('draw.dt', function () {
                $('.side-body').data('multilingual').init();
            })
            @endif
            $('.select_all').on('click', function (e) {
                $('input[name="row_id"]').prop('checked', $(this).prop('checked'));
            });
        });


        var deleteFormAction;
        $('td').on('click', '.delete', function (e) {
            $('#delete_form')[0].action = '{{ route('voyager.'.$dataType->slug.'.destroy', ['id' => '__id']) }}'.replace('__id', $(this).data('id'));
            $('#delete_modal').modal('show');
        });
    </script>
@stop
