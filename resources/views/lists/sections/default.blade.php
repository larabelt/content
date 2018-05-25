@php
    $itinerary = $section->morphParam('intineraries');
@endphp

@if($itinerary)
    <div class="section section-itinerary {{ $section->param('class') }}">
        @include('belt-content::sections.sections._heading')
        @include('belt-content::sections.sections._before')
        @include('belt-spot::itineraries.web.show')
        @include('belt-content::sections.sections._after')
    </div>
@else
    <p>section with empty itinerary</p>
@endif