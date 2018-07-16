<header>
    @include('partials.top-information')
    <div class="top-nav container">
        <div class="top-nav-wrap">
            <div class="logo">
                <a href="/">
                    <img src="{{Voyager::image(setting('site.logo'))}}" height="60"/>
                </a>
            </div>
            <div class="search-form">
                <form>
                    <input type="text" name="keyword" class="input-lg" placeholder="Search">
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
    @include('partials.promo-information')
</header>
