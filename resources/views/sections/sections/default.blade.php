<div class="section section-default row">

    @include('belt-content::sections.sections._heading')
    @include('belt-content::sections.sections._before')

    @foreach($section->children as $child)
        @include($child->template_view, ['section' => $child])
    @endforeach

    @include('belt-content::sections.sections._after')

</div>