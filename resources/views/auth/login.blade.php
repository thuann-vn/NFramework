@extends('layout')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="auth-pages">
        <div class="auth-left">
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
            <h2>{{__('frontend.account.return_customer')}}</h2>
            <div class="spacer"></div>

            <form action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}

                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                <input type="password" id="password" name="password" value="{{ old('password') }}" placeholder="Password" required>

                <div class="login-container">
                    <button type="submit" class="button-green">{{__('frontend.account.login_button')}}</button>
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{__('frontend.account.remember_me')}}
                    </label>
                </div>

                <div class="spacer"></div>

                <a href="{{ route('password.request') }}">
                    {{__('frontend.account.forgot_your_password')}}
                </a>

            </form>
        </div>

        <div class="auth-right">
            <h2>{{__('frontend.account.new_customer')}}</h2>
            <div class="spacer"></div>
            {!! __('frontend.account.new_customer_description') !!}
            <div class="spacer"></div>
            <a href="{{ route('guestCheckout.index') }}" class="auth-button-hollow">{{__('frontend.account.continue_as_guest')}}</a>
            <div class="spacer"></div>
            &nbsp;
            <div class="spacer"></div>
            {!! __('frontend.account.create_account_description') !!}

            <div class="spacer"></div>
            <a href="{{ route('register') }}" class="button-green">{{__('frontend.account.create_account')}}</a>

        </div>
    </div>
</div>
@endsection
