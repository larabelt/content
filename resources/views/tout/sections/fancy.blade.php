@php
    $tout = $section->sectionable;
@endphp

<div class="section section-tout {{ $section->param('class') }}" style="background: red;">
    @include('ohio-content::section.sections._header')
    @include('ohio-content::section.sections._body')
    @include('ohio-content::tout.web._show')
    @include('ohio-content::section.sections._footer')
</div>