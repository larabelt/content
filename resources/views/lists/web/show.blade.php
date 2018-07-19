@extends('belt-core::layouts.web.main')

@section('meta-title', $list->meta_title)
@section('meta-description', $list->meta_description)
@section('meta-keywords', $list->meta_keywords)

@section('main')

    <div class="container">
        @include($list->subtype_view)
    </div>

@endsection