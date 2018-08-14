@foreach($items as $menu_item)
    <div class="footer-menu">
        <h4>{{$menu_item->title}}</h4>

        <ul>
            @foreach(getChildMenuItems($menu_item->id) as $child)
                <li><a href="{{ $child->link() }}">{{ $child->title }}</a></li>
            @endforeach
        </ul>
    </div>
@endforeach
