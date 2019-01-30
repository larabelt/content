@extends('belt-core::layouts.web.main')

@section('meta-title', $page->meta_title)
@section('meta-description', $page->meta_description)
@section('meta-keywords', $page->meta_keywords)

@section('main')
    @include($page->subtype_view)
@endsection

@section('page-scripts')

@endsection