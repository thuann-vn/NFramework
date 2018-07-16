<ul>
    @foreach($items as $menu_item)
        @php
            dd($menu_item->children)
        @endphp
        <li>
            <a href="{{ $menu_item->link() }}">
                {{ $menu_item->title }}
            </a>

            @if(!empty($menu_item->children))
                <div class="mega-menu">
                    <div class="mega-menu-title">{{$menu_item->title}}</div>
                    <div class="mega-menu-wrap">
                        @foreach($menu_item->children as $child)
                            <div class="mega-menu-col">

                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </li>
    @endforeach
</ul>
