@extends('ohio-core::layouts.admin.main')

@section('scripts-body-close')
    @parent
    <script src="/js/ohio-content.js"></script>
@endsection

@section('main')

    <div id="ohio-content">
        <router-view></router-view>
    </div>

@stop