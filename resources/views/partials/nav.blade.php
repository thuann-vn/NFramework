<header>
    @include('partials.top-information')

    <div class="sticky-header">
        <div class="top-nav container">
            <div class="top-nav-wrap">
                <div class="logo">
                    <a href="/">
                        <img src="{{Voyager::image(setting('site.logo'))}}" height="50"/>
                    </a>
                </div>
                <div class="search-form">
                    <form>
                        <input type="text" id="aa-search-input" name="keyword" class="input-lg" placeholder="{{__('frontend.header.search_placeholder')}}">
                        <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>

                <div class="top-deal">
                    <a href="#">
                        <img src="/img/best-deals.jpg"/>
                    </a>
                </div>

                <div class="top-nav-right">
                    @if (! (request()->is('checkout') || request()->is('guestCheckout')))
                        @include('partials.menus.main-right')
                    @endif
                </div>
            </div>
        </div> <!-- end top-nav -->
        <div class="main-menu">
            <div class="container">
                @if (! (request()->is('checkout') || request()->is('guestCheckout')))
                    {{ menu('main', 'partials.menus.main') }}
                @endif
            </div>
        </div>
    </div>
</header>
