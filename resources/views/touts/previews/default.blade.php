@php
    $tout = $section->morphParam('touts', new \Belt\Content\Tout());
    $attachment = $tout->attachment ?: new \Belt\Clip\Attachment();
    $btn = $tout->attachment ?: new \Belt\Clip\Attachment();
@endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            @if($attachment->is_image)
                @include('belt-clip::attachments.previews.thumbnail')
            @endif
        </div>
        <div class="col-md-5 col-md-offset-1">
            <div><h3>{{ $tout->name }}</h3></div>
            <div>{!! $tout->body !!}</div>
            <div><a class="btn btn-default" href="{{ $tout->btn_url }}">{{ $tout->btn_text }}</a></div>
        </div>
    </div>
</div>