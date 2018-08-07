@extends('layout')

@section('title', __('frontend.account.your_orders'))

@section('content')
    <div class="my-account-section container">
        @include('partials.account.sidebar')

        <div class="my-account-content">
            <div class="my-account-title">
                <span class="your-orders-icon"></span> {{__('frontend.account.your_orders')}}
            </div>

            <table class="my-orders">
                <tr>
                    <th>{{__('frontend.account.orders.shipping_address')}}</th>
                    <th>{{__('frontend.account.orders.details')}}</th>
                    <th width="100">{{__('frontend.account.orders.total')}}</th>
                    <th width="100">{{__('frontend.account.orders.status')}}</th>
                </tr>
                @foreach($user->orders as $order)
                    <tr>
                        <td>
                            <strong>{{__('frontend.account.orders.ship_to')}}: </strong> {{$order->billing_name}} <br/>
                            <strong>{{__('frontend.account.orders.phone')}}: </strong> {{$order->billing_phone}} <br/>
                            <strong>{{__('frontend.account.orders.email')}}: </strong> {{$order->billing_email}} <br/>
                            <strong>{{__('frontend.account.orders.address')}}: </strong> {{$order->billing_address}}, {{$order->billing_province}}, {{$order->billing_city}} <br/>
                        </td>
                        <td>
                                @foreach($order->products as $product)
                                <div class="order-detail">
                                    <img src="{{productImage($product->image)}}" width="32" height="32"/>
                                    <a href="{{route('shop.show', $product->slug)}}" target="_blank">
                                        {{$product->name}}
                                    </a>
                                    <span>{{priceFormat($product->price)}} x {{$product->pivot->quantity}}</span>
                                </div>
                                @endforeach
                        </td>
                        <td><strong>{{priceFormat($order->billing_total)}}</strong></td>
                        <td style="text-align: center">
                            @if($order->shipped)
                                <span class="label label-success">{{__('frontend.account.orders.shipped')}}</span>
                            @else
                                <span class="label label-danger">{{__('frontend.account.orders.pending')}}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div> <!-- end cart-section -->
@endsection

@section('extra-js')
@endsection
