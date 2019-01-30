@php
    $page = $page ?? new \Belt\Content\Page();
@endphp

<div class="container">

    @include('belt-core::layouts.web.partials.jumbotron', ['paramable' => $page])

    <div class="page-header">

        @if( $heading = $page->param('heading') )
            <div>
                <h1>{!! $heading !!}</h1>
                @if( $subheading = trim($page->param('subheading')) )
                    <p class="lead">{!! $subheading !!}</p>
                @endif
            </div>
        @endif

        @if( $body = $page->param('body') )
            <div class="general-content-wrap">
                <div class="general-content">
                    {!! $body !!}
                </div>
            </div>
        @endif

        @if($formKey = $page->param('form_key'))
            <div id="contact-form" class="well well-sm">
                @if( $title = $page->param('form_title') )
                    <h1>{{ $title }}</h1>
                @endif
                <{!! $formKey !!}>{!! $page->param('form_success', 'Success!!!') !!}</{!! $formKey !!}>
            </div>
        @endif

    </div>
</div>