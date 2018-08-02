@extends('layout')
@section('title', $page->getTranslatedAttribute('title'))
@section('description',!empty($page->getTranslatedAttribute('meta_description'))?$page->getTranslatedAttribute('meta_description'):$page->getTranslatedAttribute('description'))
@section('keywords',!empty($page->getTranslatedAttribute('meta_keywords'))?$page->getTranslatedAttribute('meta_keywords'):'')

@section('content')
    <div class="page-content">
        <div class="container">
            <h1 class="stylish-heading">{{$page->getTranslatedAttribute('title')}}</h1>
            <div class="post-meta gray"></div>
            <div class="post-content">
                {!! $page->getTranslatedAttribute('body') !!}
            </div>
        </div>
    </div>
@endsection