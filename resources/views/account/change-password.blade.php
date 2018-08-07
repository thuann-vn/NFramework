@extends('layout')

@section('title', __('frontend.account.change_password'))

@section('content')
    <div class="my-account-section container">
        @include('partials.account.sidebar')

        <div class="my-account-content">
            <div class="my-account-title">
                <span class="manage-your-account-icon"></span> {{__('frontend.account.change_password_title')}}
            </div>

            @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @elseif(session()->has('error_message'))
                <div class="alert alert-danger">
                    {{ session()->get('error_message') }}
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
                <form method="POST" action="{{ route('update-password') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="password">{{__('frontend.account.old_password')}}</label>
                        <input type="password" class="form-control" id="password" name="password" value="" placeholder="" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="new_password">{{__('frontend.account.new_password')}}</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" value="" placeholder="" required>
                    </div>


                    <div class="form-group">
                        <label for="new_password">{{__('frontend.account.new_password_confirmation')}}</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" value="" placeholder="" required>
                    </div>

                    <div class="login-container">
                        <button type="submit" class="button button-green button-small">{{__('frontend.account.change_password')}}</button>
                    </div>

                </form>
            </div>
        </div>
    </div> <!-- end cart-section -->
@endsection

@section('extra-js')
@endsection
