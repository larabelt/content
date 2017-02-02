@php
    $block = $section->sectionable;
@endphp

<div class="section section-block {{ $section->param('class') }}">
    @include('ohio-content::section.sections._header')
    @include('ohio-content::section.sections._body')
    @include('ohio-content::block.web._show')
    @include('ohio-content::section.sections._footer')
</div>