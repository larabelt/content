<div class="page">

    @if($page->body)
        <div class="page-body">
            {!! $page->body !!}
        </div>
    @endif

    @foreach($page->sections as $section)
        @include($section->template, ['section' => $section])
    @endforeach

</div>