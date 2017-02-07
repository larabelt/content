<div class="page">

    @if($page->body)
        <div class="page-body">
            {!! $page->body !!}
        </div>
    @endif

    @foreach($page->sections as $section)
        @include($section->template_view, ['section' => $section])
    @endforeach

</div>