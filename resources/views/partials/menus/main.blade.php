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
                        @foreach($menu_item->children->sortBy('order') as $column)
                            <div class="mega-menu-col">
                                @foreach($column->children->sortBy('order') as $columSection)
                                    @php
                                        if(!empty($columSection->mega_option)){
                                            $columnOption = json_decode($columSection->mega_option);
                                        }
                                    @endphp

                                    @if(empty($columnOption) || !isset($columnOption->hide_title))
                                        <p class="mega-menu-section-title">{{$columSection->title}}</p>
                                    @endif
                                    <ul>
                                        @foreach($columSection->children->sortBy('order') as $megaItem)
                                            <li><a href="{{$megaItem->url}}" title="{{$megaItem->title}}">{{$megaItem->title}}</a></li>
                                        @endforeach
                                    </ul>
                                    @php
                                        $columnOption = null;
                                    @endphp
                                @endforeach
                            </div>
                        @endforeach
                        @if(!empty($megaOption))
                            <div class="mega-menu-col mega-menu-image">
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
