@extends('layout')

@section('title', 'Checkout')

@section('extra-css')
    <link rel="stylesheet" href="/vendor/icon_outline/css/style.css">
@endsection

@section('content')
    <div class="checkout-page">
        <div class="container">
            @if (session()->has('success_message'))
                <div class="spacer"></div>
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="spacer"></div>
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="checkout-section">
                <div>
                    <h1 class="checkout-heading"><i class="nc-icon nc-lock"></i> {{__('frontend.checkout.title')}}</h1>
                    <form action="{{ route('checkout.store') }}" method="POST" id="payment-form">
                        {{ csrf_field() }}
                        <h2 class="checkout-title"><span>1</span>{{__('frontend.checkout.delivery.title')}}</h2>

                        <div class="form-group">
                            <label for="email">{{__('frontend.checkout.delivery.email')}}</label>
                            @if (auth()->user())
                                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                            @else
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name">{{__('frontend.checkout.delivery.name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">{{__('frontend.checkout.delivery.phone')}}</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="address">{{__('frontend.checkout.delivery.address')}}</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                        </div>

                        <div class="half-form">
                            <div class="form-group">
                                <label for="city">{{__('frontend.checkout.delivery.city')}}</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="province">{{__('frontend.checkout.delivery.province')}}</label>
                                <input type="text" class="form-control" id="province" name="province" value="{{ old('province') }}" required>
                            </div>
                        </div> <!-- end half-form -->

                        <div class="spacer"></div>

                        <h2 class="checkout-title"><span>2</span>{{__('frontend.checkout.payment.title')}}</h2>

                        <div class="payment-methods">
                            <label class="payment-method pay-cash" for="pay-cash">
                                <input type="radio" name="payment_method" id="pay-cash" value="cash" {{old('payment_method')=='cash'?'checked':''}}/>
                                {{__('frontend.checkout.payment.cash')}}
                                <div>
                                    {!! setting('payment-methods.cash_description') !!}
                                </div>
                            </label>

                            <label class="payment-method pay-bank" for="pay-bank">
                                <input type="radio" name="payment_method" id="pay-bank" value="bank" {{old('payment_method')=='bank'?'checked':''}}/>   {{__('frontend.checkout.payment.transfer')}}
                                <div>
                                    {!! setting('payment-methods.transfer_description') !!}
                                </div>
                            </label>
                        </div>

                        <div class="spacer"></div>

                        <button type="submit" id="complete-order" class="button-primary full-width">{{__('frontend.checkout.complete')}}</button>
                    </form>
                </div>



                <div class="checkout-table-container">
                    <h2 class="your-order checkout-heading stylish-heading"><i class="nc-icon nc-cart-simple"></i> {{__('frontend.checkout.your_order')}}</h2>

                    <div class="checkout-totals">
                        <div class="checkout-totals-left">
                            {{__('frontend.cart.subTotal')}} <br>
                            @if (session()->has('coupon'))
                                Discount ({{ session()->get('coupon')['name'] }}) :
                                <br>
                                <hr>
                                New Subtotal <br>
                            @endif
                            <span class="checkout-totals-total">{{__('frontend.cart.total')}}</span>
                        </div>

                        <div class="checkout-totals-right">
                            {{ priceFormat(Cart::subtotal()) }} <br>
                            @if (session()->has('coupon'))
                                -{{ priceFormat($discount) }} <br>
                                <hr>
                                {{ priceFormat($newSubtotal) }} <br>
                            @endif
                            <span class="checkout-totals-total">{{ priceFormat($newTotal) }}</span>

                        </div>
                    </div> <!-- end checkout-totals -->
                    <div class="checkout-table">
                        @foreach (Cart::content() as $item)
                            <div class="checkout-table-row">
                                <div class="checkout-table-row-left">
                                    <img src="{{ productImage($item->model->image) }}" alt="item" class="checkout-table-img">
                                    <div class="checkout-item-details">
                                        <div class="checkout-table-item">{{ $item->model->name }}</div>
                                        <div class="checkout-table-price">{{ priceFormat($item->model->price) }}</div>
                                    </div>
                                </div> <!-- end checkout-table -->

                                <div class="checkout-table-row-right">
                                    <div class="checkout-table-quantity">{{ $item->qty }}</div>
                                </div>
                            </div> <!-- end checkout-table-row -->
                        @endforeach
                    </div> <!-- end checkout-table -->

                </div>

            </div> <!-- end checkout-section -->
        </div>
    </div>

@endsection

@section('extra-js')
    <script>
    </script>
@endsection
