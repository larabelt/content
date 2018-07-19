@php
    $page = $page ?? $owner ?? new \Belt\Content\Page();
@endphp

<div class="page">

    <div class="row">
        <div class="col-md-3">
            @if($menu = $page->param('menu'))
                @include('belt-menu::menus.web.default')
            @endif
        </div>
        <div class="col-md-9">
            @if($attachment = $page->morphParam('attachments'))
                @include('belt-content::attachments.previews.thumbnail')
            @endif
        </div>
    </div>

    <h1>{{ $page->name }}</h1>

    @if($body = $page->param('body'))
        <div>
            {!! $body !!}
        </div>
    @endif

    @if($block = $page->morphParam('blocks'))
        @include('belt-content::blocks.web.show')
    @endif

</div>