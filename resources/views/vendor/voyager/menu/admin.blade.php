<ol class="dd-list">

@foreach ($items->sortBy('order') as $item)
    <li class="dd-item {{count($item->children)>3?'collapsed':''}}" data-id="{{ $item->id }}" data-order="{{ $item->order }}">
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
                data-is-mega="{{ $item->is_mega }}"
                data-mega-option="{{ htmlspecialchars($item->mega_option) }}"
            >
                <i class="voyager-edit"></i> {{ __('voyager::generic.edit') }}
            </div>
            <div class="btn btn-sm btn-success pull-right add-child" data-id="{{ $item->id }}">
                <i class="voyager-plus"></i> {{ __('voyager.generic.add_child') }}
            </div>
            @if(count($item->children)>3)
                <div class="btn btn-sm btn-warning pull-right toggle-child" data-id="{{ $item->id }}" style="margin-right: 10px">
                    <i class="voyager-resize-full"></i> {{ __('voyager.menu_builder.toggle_show') }}
                </div>
            @endif
        </div>
        <div class="dd-handle">
            @if($options->isModelTranslatable)
                @include('voyager::multilingual.input-hidden', [
                    'isModelTranslatable' => true,
                    '_field_name'         => 'title'.$item->id,
                    '_field_trans'        => json_encode($item->getTranslationsOf('title'))
                ])
            @endif
            <span>{{ $item->title }}</span> <small class="url">{{ $item->link() }}</small> @if(count($item->children)>0)| {{count($item->children)}} child(s) @endif
        </div>
        @if(!$item->children->isEmpty())
            @include('voyager::menu.admin', ['items' => $item->children])
        @endif
    </li>

@endforeach

</ol>
