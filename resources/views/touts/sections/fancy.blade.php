@php
    $tout = $section->sectionable;
@endphp

<div class="section section-tout {{ $section->param('class') }}" style="background: red;">
    @include('belt-content::sections.sections._heading')
    @include('belt-content::sections.sections._before')
    @include('belt-content::touts.web.show')
    @include('belt-content::sections.sections._after')
</div>