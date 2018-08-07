@extends('layout')

@section('title', 'My Account')

@section('content')
    <div class="my-account-section container">
        @include('partials.account.sidebar')

        <div class="my-account-content">
            <div class="welcome-panel">
                <h1>{{__('frontend.account.welcome_message', ['join_date' => $user->created_at,'name' => $user->name])}}</h1>
            </div>

            <table class="summary-table">
                <tr>
                    <td rowspan="3" class="total-money">
                        {{priceFormat($user->orders->sum('total'))}}
                    </td>
                    <td class="total-orders">
                        {{__('frontend.account.total_orders')}} <span class="total-float">{{$user->orders->count()}}</span>
                    </td>
                </tr>
                <tr>
                    <td class="total-pending-order">
                        {{__('frontend.account.total_pending_orders')}}   <span class="total-float">{{$user->orders->where('status',0)->count()}}</span>
                    </td>
                </tr>
                <tr>
                    <td class="total-completed-orders">
                        {{__('frontend.account.total_completed_orders')}}  <span class="total-float">{{$user->orders->where('status',1)->count()}}</span>
                    </td>
                </tr>
            </table>
        </div>
    </div> <!-- end cart-section -->
@endsection

@section('extra-js')
@endsection
