<ol class="dd-list">

@foreach ($items->sortBy('order') as $item)
    <li class="dd-item" data-id="{{ $item->id }}" data-order="{{ $item->order }}">
        <div class="pull-right item_actions">
            <div class="btn btn-sm btn-danger pull-right delete" data-id="{{ $item->id }}">
                <i class="voyager-trash"></i> {{ __('voyager::generic.delete') }}
            </div>
            <div class="btn btn-sm btn-primary pull-right edit"
                data-id="{{ $item->id }}"
                data-title="{{ $item->title }}"
                data-url="{{ $item->url }}"
                data-target="{{ $item->target }}"
                data-icon_class="{{ $item->icon_class }}"
                data-color="{{ $item->color }}"
                data-route="{{ $item->route }}"
                data-parameters="{{ htmlspecialchars(json_encode($item->parameters)) }}"
                data-mega-option="{{ htmlspecialchars($item->mega_option) }}"
            >
                <i class="voyager-edit"></i> {{ __('voyager::generic.edit') }}
            </div>
        </div>
        <div class="dd-handle">
            @if($options->isModelTranslatable)
                @include('voyager::multilingual.input-hidden', [
                    'isModelTranslatable' => true,
                    '_field_name'         => 'title'.$item->id,
                    '_field_trans'        => htmlspecialchars(json_encode($item->getTranslationsOf('title')))
                ])
            @endif
            <span>{{ $item->title }}</span> <small class="url">{{ $item->link() }}</small>
        </div>
        @if(!$item->children->isEmpty())
            @include('voyager::menu.admin', ['items' => $item->children])
        @endif
    </li>

@endforeach

</ol>
