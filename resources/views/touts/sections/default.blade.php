@php
    $tout = $section->sectionable;
@endphp

@if($tout)
    <div class="section section-tout {{ $section->param('class') }}">
        @include('belt-content::sections.sections._heading')
        @include('belt-content::sections.sections._before')
        @include('belt-content::touts.web.show')
        @include('belt-content::sections.sections._after')
    </div>
@else
    <p>section with empty tout</p>
@endif