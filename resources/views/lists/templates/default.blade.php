@php
    $list = $list ?? $owner ?? new \Belt\Spot\List();
@endphp

<div class="list">

    @foreach($list->sections as $section)
        @include($section->template_view, ['section' => $section])
    @endforeach

</div>