
<h3><i class="voyager-tag"></i> {{ __('voyager.product.properties.title') }} <small>{{ __('voyager.product.properties.text') }}</small></h3>
<div class="panel" style="margin-top:10px;">
    <div class="panel-heading new-setting">
        <hr>
        <h3 class="panel-title"><i class="voyager-plus"></i> {{ __('voyager.products.properties.new') }}</h3>
    </div>
    <div class="panel-body">
        <form action="{{ route('voyager.settings.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="col-md-3">
                <label for="display_name">{{ __('voyager::generic.name') }}</label>
                <input type="text" class="form-control" name="display_name" placeholder="{{ __('voyager::settings.help_name') }}" required="required">
            </div>
            <div class="col-md-3">
                <label for="key">{{ __('voyager::generic.key') }}</label>
                <input type="text" class="form-control" name="key" placeholder="{{ __('voyager::settings.help_key') }}" required="required">
            </div>
            <div class="col-md-3">
                <label for="group">{{ __('voyager::settings.group') }}</label>
                <select class="form-control group_select group_select_new" name="group">
                    @foreach($property_groups as $group)
                        <option value="{{ $group }}">{{ $group }}</option>
                    @endforeach
                </select>
            </div>
            <div style="clear:both"></div>
            <button type="submit" class="btn btn-primary pull-right new-setting-btn">
                <i class="voyager-plus"></i> {{ __('voyager.products.properties.add_new') }}
            </button>
            <div style="clear:both"></div>
        </form>
    </div>
</div>