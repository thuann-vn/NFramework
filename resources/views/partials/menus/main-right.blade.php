<ul>
    @guest
        <li><a href="{{ route('register') }}">Sign Up</a></li>
        <li><a href="{{ route('login') }}">Login</a></li>
    @else
        <li class="my-account dropdown">
            <a class="dropdown-toggle" href="/my-account">
                <span class="my-account-message">
                    Hello, Sign In
                </span>
                <span class="my-account-link">
                    My Account
                </span>
            </a>
            <div class="dropdown-menu my-account-wrap">
                <ul>
                    <li class="header-login"><a href="{{ route('login') }}">Sign in</a></li>
                    <li class="header-sign-up">
                        NEW CUSTOMER?
                        <a href="{{ route('register') }}">Create an account</a>
                    </li>
                    <li><a href="#">My account</a></li>
                    <li><a href="#">Track My Orders</a></li>
                    <li><a href="#">My Favorites</a></li>
                    <li><a href="#">My Address Book</a></li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                            Logout
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
        <a href="">
            <span class="ebalo-icon wish-list-icon"></span>
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
