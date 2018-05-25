@php
    $itinerary = $itinerary ?? $owner ?? new \Belt\Spot\Itinerary();
@endphp

<div class="itinerary">

    @foreach($itinerary->sections as $section)
        @include($section->template_view, ['section' => $section])
    @endforeach

</div>