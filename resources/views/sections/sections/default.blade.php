<div class="section section-default row">

    @include('belt-content::sections.sections._header')
    @include('belt-content::sections.sections._body')

    @foreach($section->children as $child)
        @include($child->template_view, ['section' => $child])
    @endforeach

    @include('belt-content::sections.sections._footer')

</div>