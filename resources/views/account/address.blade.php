@extends('layout')

@section('title', __('frontend.account.address_book'))

@section('content')
    <div class="my-account-section container">
        @include('partials.account.sidebar')

        <div class="my-account-content">
            <div class="my-account-title">
                <span class="manage-your-account-icon"></span> {{__('frontend.account.address_book')}}
            </div>
            <p>{{__('frontend.account.address_book_description')}}</p>
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

            <div class="address-book">
                @foreach($user->addressBook as $address)
                    <div class="address">
                        <strong>{{$address->name}}</strong><br/>
                        {{$address->phone}}, {{$address->email}} <br/>
                        {{$address->address}}, {{$address->province}}, {{$address->city}}<br/>

                        <a href="{{route('edit-address', $address->id)}}">{{__('frontend.address.update')}}</a> | <a class="delete-address" href="#delete">{{__('frontend.address.delete')}}</a>

                        <form action="{{route('delete-address')}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$address->id}}">
                        </form>
                    </div>
                @endforeach
            </div>
            <div class="mt-20">
                <a href="{{route('add-address')}}" class="button button-green button-small">{{__('frontend.address.create')}}</a>
            </div>
        </div>
    </div> <!-- end cart-section -->
@endsection

@section('extra-js')
    <script>
        $(document).ready(function(){
            $('.delete-address').click(function(e){
                e.preventDefault();
                $(this).next('form').submit();
            })
        })
    </script>
@endsection
