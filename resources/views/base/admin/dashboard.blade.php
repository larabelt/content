@extends('ohio-core::layouts.admin.main')

@section('heading-title', 'tmp')
@section('heading-subtitle', 'tmp')
@section('heading-active', 'tmp')

@section('scripts-body-close')
    @parent
    <script src="/js/ohio.js"></script>
@endsection

@section('main')

    <div id="content-vue">
        <router-view></router-view>
    </div>

@stop