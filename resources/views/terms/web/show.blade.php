@extends('belt-core::layouts.web.main')

@section('meta-title', $term->meta_title)
@section('meta-description', $term->meta_description)
@section('meta-keywords', $term->meta_keywords)

@section('main')

    <div class="container">
        @include($term->template_view)
    </div>

@endsection