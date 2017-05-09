@extends('belt-core::layouts.web.main')

@section('meta-title', $post->meta_title)
@section('meta-description', $post->meta_description)
@section('meta-keywords', $post->meta_keywords)

@section('main')

    <div class="container">
        @include($post->template_view)
    </div>

@endsection