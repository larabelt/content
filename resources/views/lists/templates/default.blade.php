@php
    $list = $list ?? $owner ?? new \Belt\Content\Lyst();
@endphp

<div class="list">

    @foreach($list->sections as $section)
        @include($section->template_view, ['section' => $section])
    @endforeach

</div>