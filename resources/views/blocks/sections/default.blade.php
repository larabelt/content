@php
    $block = $section->sectionable;
@endphp

@if($block)
    <div class="section section-block {{ $section->param('class') }}">
        @include('belt-content::sections.sections._heading')
        @include('belt-content::sections.sections._before')
        @include('belt-content::blocks.web.show')
        @include('belt-content::sections.sections._after')
    </div>
@else
    <p>section with empty block</p>
@endif