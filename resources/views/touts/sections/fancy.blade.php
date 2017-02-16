@php
    $tout = $section->sectionable;
@endphp

<div class="section section-tout {{ $section->param('class') }}" style="background: red;">
    @include('belt-content::sections.sections._header')
    @include('belt-content::sections.sections._body')
    @include('belt-content::touts.web._show')
    @include('belt-content::sections.sections._footer')
</div>