@php
    $block = $section->sectionable;
@endphp

<div class="section section-block {{ $section->param('class') }}">
    @include('belt-content::sections.sections._header')
    @include('belt-content::sections.sections._body')
    @include('belt-content::blocks.web.show')
    @include('belt-content::sections.sections._footer')
</div>