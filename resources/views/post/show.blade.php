@extends('layout')

@section('title', $post->getTranslatedAttribute('title'))
@section('description',!empty($post->getTranslatedAttribute('meta_description'))?$post->getTranslatedAttribute('meta_description'):$post->getTranslatedAttribute('description'))
@section('keywords',!empty($post->getTranslatedAttribute('meta_keywords'))?$post->getTranslatedAttribute('meta_keywords'):'')

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