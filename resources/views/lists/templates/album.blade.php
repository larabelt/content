@php
    $album = $list ?? $owner ?? new \Belt\Content\Lyst();
@endphp

<div class="list">

    @foreach($album->attachments as $attachment)
        @if($attachment->isImage)
            <img class="img-responsive center-attachment" src="{{ $attachment->src }}"/>
        @endif
    @endforeach

</div>