@extends('layout')

@section('title', __('frontend.account.address_add'))

@section('content')
    <div class="my-account-section container">
        @include('partials.account.sidebar')

        <div class="my-account-content">
            <div class="my-account-title">
                <span class="manage-your-account-icon"></span> {{__('frontend.account.address_add')}}
            </div>
            <p>{{__('frontend.account.address_add_description')}}</p>
            @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="edit-form">
                <form method="POST" action="{{ route('store-address') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name">{{__('frontend.address.name')}}</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                               placeholder="{{__('frontend.address.name')}}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="phone">{{__('frontend.address.phone')}}</label>
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}"
                               placeholder="{{__('frontend.address.phone')}}" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="email">{{__('frontend.address.email')}}</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                               placeholder="{{__('frontend.address.email')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="address">{{__('frontend.address.address')}}</label>
                        <input id="address" type="text" class="form-control" name="address"
                               value="{{ old('address') }}" placeholder="{{__('frontend.address.address')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="city">{{__('frontend.address.city')}}</label>
                        <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}"
                               placeholder="{{__('frontend.address.city')}}" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="name">{{__('frontend.address.province')}}</label>
                        <input id="province" type="text" class="form-control" name="province"
                               value="{{ old('province') }}" placeholder="{{__('frontend.address.province')}}" required>
                    </div>

                    <div class="login-container">
                        <button type="submit" class="button button-green">{{__('frontend.address.update')}}</button>
                    </div>

                </form>
            </div>
        </div>
    </div> <!-- end cart-section -->
@endsection
