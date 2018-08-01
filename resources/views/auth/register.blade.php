@extends('layout')

@section('title', 'Sign Up for an Account')

@section('content')
<div class="container">
    <div class="auth-pages">
        <div>
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
            <h2>{{__('frontend.account.register')}}</h2>
            <div class="spacer"></div>

            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="{{__('frontend.account.name')}}" required autofocus>

                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{__('frontend.account.email')}}" required>

                <input id="password" type="password" class="form-control" name="password" placeholder="Password" placeholder="{{__('frontend.account.password')}}" required>

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{__('frontend.account.confirm_password')}}"
                    required>

                <div class="login-container">
                    <button type="submit" class="auth-button">{{__('frontend.account.create_account')}}</button>
                    <div class="already-have-container">
                        <p><strong>{{__('frontend.account.already_have_an_account')}}</strong></p>
                        <a href="{{ route('login') }}">{{__('frontend.account.login')}}</a>
                    </div>
                </div>

            </form>
        </div>

        <div class="auth-right">
            <h2>{{__('frontend.account.register')}}</h2>
            <div class="spacer"></div>
            {!!__('frontend.account.register_description')!!}
        </div>
    </div> <!-- end auth-pages -->
</div>
@endsection
