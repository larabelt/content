@php
    $page = $page ?? new \Belt\Content\Page();
@endphp

<div class="page">

    @foreach($page->sections as $section)
        @include($section->template_view, ['section' => $section])
    @endforeach

</div>