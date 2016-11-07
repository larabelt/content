@extends('ohio-core::layouts.admin.main2')

@section('scripts-body-close')
    @parent
    <script src="/js/ohio.js"></script>
@endsection

@section('main')

    <div id="content-vue">
        <router-view></router-view>
    </div>

@stop