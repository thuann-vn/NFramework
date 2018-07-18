<ul>
    @guest
        <li class="my-account dropdown">
            <a class="dropdown-toggle" href="/my-account">
                <span class="my-account-message">
                    {{__('frontend.header.hello_sign_in')}}
                </span>
                <span class="my-account-link">
                    {{__('frontend.account.my')}}
                </span>
            </a>
            <div class="dropdown-menu my-account-wrap">
                <ul>
                    <li class="header-login"><a href="{{ route('login') }}">{{__('frontend.account.sign_in')}}</a></li>
                    <li class="header-sign-up">
                        {{__('frontend.header.new?')}}
                        <a href="{{ route('register') }}"> {{__('frontend.header.create_account')}}</a>
                    </li>
                </ul>
            </div>
        </li>
    @else
        <li class="my-account dropdown">
            <a class="dropdown-toggle" href="/my-account">
                <span class="my-account-message">
                    {{__('frontend.header.hello', ['name'=>auth()->user()->name])}}
                </span>
                <span class="my-account-link">
                    {{__('frontend.account.my')}}
                </span>
            </a>
            <div class="dropdown-menu my-account-wrap">
                <ul>
                    <li><a href="{{route('voyager.profile')}}">{{__('frontend.account.my')}}</a></li>
                    <li><a href="#">{{__('frontend.account.track_order')}}</a></li>
                    <li><a href="#">{{__('frontend.account.favorites')}}</a></li>
                    <li><a href="#">{{__('frontend.account.address_book')}}</a></li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                            {{__('frontend.account.log_out')}}
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    @endguest

    <li class="header-wishlist">
        <a href="{{route('saveForLater.index')}}">
            <span class="ebalo-icon wish-list-icon"></span>
            @if (Cart::instance('saveForLater')->count() > 0)
                <span class="wishlist-count">{{ Cart::instance('saveForLater')->count() }}</span>
            @endif
        </a>
    </li>
    <li class="header-cart">
        <a href="{{ route('cart.index') }}" class="cart-total">
            <span>
                @if (Cart::instance('default')->count() > 0)
                    <span class="cart-count">{{ Cart::instance('default')->count() }}</span>
                @endif
            </span>
        </a>
    </li>
</ul>
