@extends('layout')

@section('title', __('frontend.account.edit_my_account'))

@section('content')
    <div class="my-account-section container">
        @include('partials.account.sidebar')

        <div class="my-account-content">
            <div class="my-account-title">
                <span class="manage-your-account-icon"></span> {{__('frontend.account.edit_my_account')}}
            </div>

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
                <form method="POST" action="{{ route('update-account') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name">{{__('frontend.account.name')}}</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" placeholder="{{__('frontend.account.name')}}" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="name">{{__('frontend.account.email')}}</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" placeholder="{{__('frontend.account.email')}}" required>
                    </div>

                    <div class="login-container">
                        <button type="submit" class="button button-green button-small">{{__('frontend.account.update')}}</button>
                    </div>

                </form>
            </div>
        </div>
    </div> <!-- end cart-section -->
@endsection

@section('extra-js')
@endsection
