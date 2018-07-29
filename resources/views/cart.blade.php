@extends('layout')

@section('title', 'Shopping Cart')

@section('content')
    <div class="cart-section container">
        <div>
            @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (Cart::count() > 0)
                <div class="cart-wrapper">
                    <div class="cart-heading">
                        <h4>{{ Cart::count() }} item(s) in Shopping Cart</h4>
                    </div>
                    <div class="cart-content">

                        <div class="cart-table">
                            @foreach (Cart::content() as $item)
                                <div class="cart-table-row">
                                    <div class="cart-table-row-left">
                                        <a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ productImage($item->model->image) }}" alt="item" class="cart-table-img"></a>
                                        <div class="cart-item-details">
                                            <div class="cart-table-item"><a class="bold" href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a></div>

                                            <div class="cart-table-quantity">
                                                <label class="">{{__('frontend.cart.quantity')}} : </label>
                                                <select class="quantity" data-id="{{ $item->rowId }}">
                                                    @for ($i = 1; $i < 5 + 1 ; $i++)
                                                        <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="cart-table-actions">
                                                <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" class="cart-options">Remove</button>
                                                </form>
                                                <span class="separator">|</span>
                                                <form action="{{ route('cart.switchToSaveForLater', $item->rowId) }}" method="POST">
                                                    {{ csrf_field() }}

                                                    <button type="submit" class="cart-options">Save for Later</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cart-table-row-right">
                                        <div class="text-muted">{{__('frontend.cart.item_price')}}:  <strong>{{ priceFormat($item->price) }} <span>x {{$item->qty}}</span></strong></div>
                                        <hr/>
                                        <div>{{__('frontend.cart.item_total')}}:  <strong>{{ priceFormat($item->subtotal) }}</strong></div>
                                    </div>
                                </div> <!-- end cart-table-row -->
                            @endforeach

                        </div> <!-- end cart-table -->

                        @if (! session()->has('coupon'))

                            <a href="#" class="have-code">Have a Code?</a>

                            <div class="have-code-container">
                                <form action="{{ route('coupon.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="text" name="coupon_code" id="coupon_code">
                                    <button type="submit" class="button button-green">Apply</button>
                                </form>
                            </div> <!-- end have-code-container -->
                        @endif
                    </div>
                </div>
            @else

                <h3>No items in Cart!</h3>
                <div class="spacer"></div>
                <a href="{{ route('shop.index') }}" class="button">Continue Shopping</a>
                <div class="spacer"></div>

            @endif

            @if (Cart::instance('saveForLater')->count() > 0)
                <h2>{{ Cart::instance('saveForLater')->count() }} item(s) Saved For Later</h2>

                <div class="saved-for-later cart-table">
                    @foreach (Cart::instance('saveForLater')->content() as $item)
                    <div class="cart-table-row">
                        <div class="cart-table-row-left">
                            <a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ asset('img/products/'.$item->model->slug.'.jpg') }}" alt="item" class="cart-table-img"></a>
                            <div class="cart-item-details">
                                <div class="cart-table-item"><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a></div>
                                <div class="cart-table-description">{{ $item->model->details }}</div>
                            </div>
                        </div>
                        <div class="cart-table-row-right">
                            <div class="cart-table-actions">
                                <form action="{{ route('saveForLater.destroy', $item->rowId) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="cart-options">Remove</button>
                                </form>

                                <form action="{{ route('saveForLater.switchToCart', $item->rowId) }}" method="POST">
                                    {{ csrf_field() }}

                                    <button type="submit" class="cart-options">Move to Cart</button>
                                </form>
                            </div>

                            <div>{{ $item->model->presentPrice() }}</div>
                        </div>
                    </div> <!-- end cart-table-row -->
                    @endforeach
                </div> <!-- end saved-for-later -->
            @endif
        </div>

        @if(Cart::instance('default')->count()>0)
            <div class="cart-sidebar">
                <div class="cart-totals">
                    <div class="cart-totals-right">
                        <div class="text-left">
                            Subtotal <br>
                            @if (session()->has('coupon'))
                                Code ({{ session()->get('coupon')['name'] }})
                                <form action="{{ route('coupon.destroy') }}" method="POST" style="display:block">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit" style="font-size:14px;">Remove</button>
                                </form>
                                <hr>
                                New Subtotal <br>
                            @endif
                            <span class="cart-totals-total">Total</span>
                        </div>
                        <div class="cart-totals-subtotal">
                            {{ priceFormat(Cart::instance('default')->subtotal()) }} <br>
                            @if (session()->has('coupon'))
                                -{{ priceFormat($discount) }} <br>&nbsp;<br>
                                <hr>
                                {{ priceFormat($newSubtotal) }} <br>
                            @endif
                            <span class="cart-totals-total">{{ priceFormat($newTotal) }}</span>
                        </div>
                    </div>
                </div> <!-- end cart-totals -->

                <div class="cart-buttons">
                    <a href="{{ route('shop.index') }}" class="button">Continue Shopping</a>
                    <a href="{{ route('checkout.index') }}" class="button button-green">Proceed to Checkout</a>
                </div>
            </div>
        @endif
    </div> <!-- end cart-section -->

    {{--@include('partials.might-like')--}}


@endsection

@section('extra-js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        (function(){
            const classname = document.querySelectorAll('.quantity')

            Array.from(classname).forEach(function(element) {
                element.addEventListener('change', function() {
                    const id = element.getAttribute('data-id')
                    axios.patch(`/cart/${id}`, {
                        quantity: this.value
                    })
                    .then(function (response) {
                        // console.log(response);
                        window.location.href = '{{ route('cart.index') }}'
                    })
                    .catch(function (error) {
                        // console.log(error);
                        window.location.href = '{{ route('cart.index') }}'
                    });
                })
            })
        })();
    </script>
@endsection
