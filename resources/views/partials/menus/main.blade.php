<ul>
    @foreach($items as $menu_item)
        <li>
            <a href="{{ $menu_item->link() }}">
                {{ $menu_item->title }}
            </a>

            @if(!empty($menu_item->children))
                @php
                    if(!empty($menu_item->mega_option)){
                        $megaOption = json_decode($menu_item->mega_option);
                    }
                @endphp
                <div class="mega-menu">
                    <div class="mega-menu-title">{{$menu_item->title}}</div>
                    <div class="mega-menu-wrap">
                        @foreach($menu_item->children as $child)
                            <div class="mega-menu-col">
                            </div>
                        @endforeach
                        @if(!empty($megaOption))
                            <div class="mega-menu-image">
                                <img src="{{$megaOption->img}}"/>
                            </div>
                        @endif
                    </div>
                </div>

                @php
                    $megaOption =null;
                @endphp
            @endif
        </li>
    @endforeach
</ul>
