@php
    $term = $term ?? $owner ?? new \Belt\Content\Term();
@endphp

<div class="term">

    @if($term->body)
        <div class="term-body">
            {!! $term->body !!}
        </div>
    @endif

    @foreach($term->sections as $section)
        @include($section->template_view, ['section' => $section])
    @endforeach

</div>