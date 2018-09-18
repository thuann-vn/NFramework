<li class="dd-item" data-id="{{ $block->id }}" id="block-id-{{ $block->id }}">
    <i class="glyphicon glyphicon-sort order-handle"></i>

    <div class="panel panel-bordered panel-info @if ($block->is_minimized == 1) panel-collapsed @endif">
        <div class="panel-heading">

            <h3 class="panel-title">
                <a
                        class="panel-action panel-collapse-icon voyager-angle-up"
                        data-toggle="block-collapse"
                        style="cursor:pointer"
                >
                    Developer Include
                </a>
            </h3>
            <div class="panel-actions">
                <a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
            </div>
        </div>

        <div class="panel-body" @if ($block->is_minimized == 1) style="display:none" @endif>
            <form role="form" action="{{ route('voyager.page-blocks.update', $block->id) }}" method="POST"
                  enctype="multipart/form-data">
                {{ method_field("PUT") }}
                {{ csrf_field() }}

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="well" style="padding-bottom:0; margin-bottom:10px">
                                <h5>How This Works</h5>
                                <p>Custom Controllers and their render methods can be referenced here to include as a page block, where the view is simply rendered back to the page it's called from.</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Path</label><br>
                            <input
                                    class="form-control"
                                    type="text"
                                    name="path"
                                    value="{{ $block->path }}"
                                    placeholder="Namespaced\Path\To\Controller::MethodName()"
                            >
                        </div>
                    </div>
                </div> <!-- /.row -->

                <div class="well" style="padding-bottom:0; margin-bottom:10px">
                    <div class="row">
                        <div class="col-mg-6 col-lg-4">
                            <div class="form-group">
                                <label for="cache_ttl">Cache Time</label>
                                <select name="cache_ttl" id="cache_ttl" class="form-control">
                                    <option value="0" {{ $block->cache_ttl === 0 ? 'selected="selected"' : '' }}>
                                        None / Off
                                    </option>
                                    <option value="5" {{ $block->cache_ttl === 5 ? 'selected="selected"' : '' }}>
                                        5 mins
                                    </option>
                                    <option value="30" {{ $block->cache_ttl === 30 ? 'selected="selected"' : '' }}>
                                        30 mins
                                    </option>
                                    <option value="60" {{ $block->cache_ttl === 60 ? 'selected="selected"' : '' }}>
                                        1 Hour
                                    </option>
                                    <option value="240" {{ $block->cache_ttl === 240 ? 'selected="selected"' : '' }}>
                                        4 Hours
                                    </option>
                                    <option value="1440" {{ $block->cache_ttl === 1440 ? 'selected="selected"' : '' }}>
                                        1 Day
                                    </option>
                                    <option value="10080" {{ $block->cache_ttl === 10080 ? 'selected="selected"' : '' }}>
                                        7 Days
                                    </option>
                                </select>
                            </div> <!-- /.form-group -->
                        </div> <!-- /.col -->

                        <div class="col-mg-6 col-lg-8">
                            <label>Options</label>

                            <div class="row">
                                <div class="col-md-6 col-lg-5">
                                    <div class="form-group">
                                        <input
                                                type="checkbox"
                                                name="is_hidden"
                                                id="is_hidden"
                                                data-name="is_hidden"
                                                class="toggleswitch"
                                                value="1"
                                                data-on="Yes" {{ $block->is_hidden ? 'checked="checked"' : '' }}
                                                data-off="No"
                                        />
                                        <label for="is_hidden"> &nbsp;Hide Block</label>
                                    </div> <!-- /.form-group -->
                                </div> <!-- /.col -->

                                <div class="col-md-6 col-lg-5">
                                    <div class="form-group">
                                        <input
                                                type="checkbox"
                                                name="is_delete_denied"
                                                id="is_delete_denied"
                                                data-name="is_delete_denied"
                                                class="toggleswitch"
                                                value="1"
                                                data-on="Yes"
                                                {{ $block->is_delete_denied ? 'checked="checked"' : '' }}
                                                data-off="No"
                                        />
                                        <label for="is_delete_denied"> &nbsp;Prevent Deletion</label>
                                    </div> <!-- /.form-group -->
                                </div> <!-- /.col -->
                            </div> <!-- /.row -->
                        </div> <!-- /.col -->
                    </div> <!-- /.row -->
                </div> <!-- /.well -->

                <span class="btn-group-lg">
                    <button
                            style="float:left"
                            type="submit"
                            class="btn btn-success btn-lg save"
                    >{{ __('voyager::generic.save') }} This Block</button>
                </span>
            </form>

            @if (!$block->is_delete_denied)
                <form method="POST" action="{{ route('voyager.page-blocks.destroy', $block->id) }}">
                    {{ method_field("DELETE") }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <span class="btn-group-xs">
                        <button
                                data-delete-block-btn
                                type="submit"
                                style="float:right; margin-top:22px"
                                class="btn btn-danger btn-xs delete"
                        >{{ __('voyager::generic.delete') }} This Block</button>
                    </span>
                </form>
            @endif
        </div> <!-- /.panel-body -->
    </div> <!-- /.panel -->
</li> <!-- /.dd-item -->
