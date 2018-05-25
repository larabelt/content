@php
    $list = $list ?? $owner ?? new \Belt\Content\List();
@endphp

<div class="list">

    @foreach($list->sections as $section)
        @include($section->template_view, ['section' => $section])
    @endforeach

</div>