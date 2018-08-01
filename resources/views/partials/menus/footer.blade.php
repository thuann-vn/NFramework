@foreach($items as $menu_item)
    <div class="footer-menu">
        <h4>{{$menu_item->getTranslatedAttribute('title')}}</h4>

        <ul>
            @foreach($menu_item->children as $child)
                <li><a href="{{ $child->link() }}">{{ $child->getTranslatedAttribute('title') }}</a></li>
            @endforeach
        </ul>
    </div>
@endforeach