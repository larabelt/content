@php
    $page = $page ?? new \Belt\Content\Page();
@endphp

<div class="page">

    @foreach($page->sections as $section)
        @include($section->subtype_view, ['section' => $section])
    @endforeach

</div>