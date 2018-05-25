@php
    $list = $section->morphParam('intineraries');
@endphp

@if($list)
    <div class="section section-list {{ $section->param('class') }}">
        @include('belt-content::sections.sections._heading')
        @include('belt-content::sections.sections._before')
        @include('belt-spot::lists.web.show')
        @include('belt-content::sections.sections._after')
    </div>
@else
    <p>section with empty list</p>
@endif