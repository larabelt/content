<div class="section section-width-3 col-md-3">

    @include('belt-content::sections.sections._heading')
    @include('belt-content::sections.sections._before')

    @foreach($section->children as $child)
        @include($child->template_view, ['section' => $child])
    @endforeach

    @include('belt-content::sections.sections._after')

</div>