@extends('layout')

@section('title', $post->getTranslatedAttribute('title'))

@section('content')
    <div class="travel-center-post">
        <div class="container">
            <h1 class="stylish-heading">{{$post->getTranslatedAttribute('title')}}</h1>
            <div class="post-meta gray"></div>
            <div class="post-content">
                {!! $post->getTranslatedAttribute('body') !!}
            </div>
        </div>
    </div>
@endsection