@php
    $tout = $section->sectionable;
@endphp

<div class="section section-tout {{ $section->param('class') }}">
    @include('ohio-content::section.sections._header')
    @include('ohio-content::section.sections._body')
    @include('ohio-content::touts.web._show')
    @include('ohio-content::section.sections._footer')
</div>