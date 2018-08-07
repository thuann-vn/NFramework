<div class="help-nav-panel">
    <h2>{{__('frontend.account.title')}}</h2>

    <ul>
        <li class="has-child {{in_array(Route::currentRouteName(), ['my-account', 'edit-account', 'my-address-book', 'change-password']) ? 'active': ''}}">
            <a href="{{route('my-account')}}">
                <span class="manage-your-account-icon"></span> {{__('frontend.account.my_account')}}
            </a>

            <ul>
                <li class="{{Route::currentRouteName()=='edit-account'?'active':''}}">
                    <a href="{{route('edit-account')}}">{{__('frontend.account.edit_my_account')}}</a>
                </li>
                <li class="{{Route::currentRouteName()=='my-address-book'?'active':''}}">
                    <a href="{{route('my-address-book')}}">{{__('frontend.account.my_address_book')}}</a>
                </li>
                <li class="{{Route::currentRouteName()=='change-password'?'active':''}}">
                    <a href="{{route('change-password')}}">{{__('frontend.account.change_password')}}</a>
                </li>
            </ul>
        </li>
        <li><a><span class="your-orders-icon"></span> {{__('frontend.account.your_orders')}}</a></li>
        <li>
            <a href="{{route('cart.index')}}">
                <span class="placing-an-order-icon"></span> {{__('frontend.account.place_order')}}
            </a>
        </li>
        <li>
            <a href="{{route('saveForLater.index')}}">
                <span class="my-favorites-icon"></span> {{__('frontend.account.my_favorites')}}
            </a>
        </li>
        <li>
            <a href="{{route('contact')}}">
                <span class="contact-customer-care-icon"></span> {{__('frontend.account.contact_customer_care')}}
            </a>
        </li>
    </ul>
</div>