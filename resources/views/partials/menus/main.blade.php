<ul class="main-menu-wrap">
    @foreach($items as $menu_item)
        @php
           $childs = getChildMenuItems($menu_item->id);
        @endphp
        <li class="{{count($childs)>0?'has-child':''}}">
            <a href="{{ $menu_item->link() }}" {{!empty($menu_item->color)?'style=color:'. $menu_item->color :''}}>
                {{ $menu_item->title }}
                <span></span>
            </a>

            @if(count($childs)>0)
                @php
                    if(!empty($menu_item->mega_option)){
                        $megaOption = json_decode($menu_item->mega_option);
                    }
                @endphp
                @if($menu_item->is_mega)
                    <div class="mega-menu">
                        <div class="mega-menu-title">{{!empty($menu_item->title)?$menu_item->title:$menu_item->title}}</div>
                        <div class="mega-menu-wrap">
                            @foreach(getChildMenuItems($menu_item->id) as $column)
                                <div class="mega-menu-col">
                                    @foreach(getChildMenuItems($column->id) as $columSection)
                                        @php
                                            if(!empty($columSection->mega_option)){
                                                $columnOption = json_decode($columSection->mega_option);
                                            }
                                        @endphp

                                        @if(empty($columnOption) || !isset($columnOption->hide_title))
                                            <p class="mega-menu-section-title">{{!empty($columSection->title)?$columSection->title:$columSection->title}}</p>
                                        @endif
                                        <ul>
                                            @foreach(getChildMenuItems($columSection->id) as $megaItem)
                                                <li><a href="{{$megaItem->url}}" title="{{!empty($megaItem->title)?$megaItem->title:$megaItem->title}}">{{!empty($megaItem->title)?$megaItem->title:$megaItem->title}}</a></li>
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
                        $megaOption=null;
                    @endphp
                @else
                    <ul>
                        @foreach(getChildMenuItems($menu_item->id) as $child)
                            <li>
                                <a href="{{$child->url}}" title="{{!empty($child->title)?$child->title:$child->title}}">{{!empty($child->title)?$child->title:$child->title}}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            @endif
        </li>
    @endforeach
</ul>
