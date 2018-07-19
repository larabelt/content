@php
    $post = $post ?? $owner ?? new \Belt\Content\Post();
@endphp

<div class="post">

    @foreach($post->sections as $section)
        @include($section->subtype_view, ['section' => $section])
    @endforeach

</div>