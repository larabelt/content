<div class="section section-default row">

    @include('ohio-content::section.sections._header')
    @include('ohio-content::section.sections._body')

    @foreach($section->children as $child)
        @include($child->template_view, ['section' => $child])
    @endforeach

    @include('ohio-content::section.sections._footer')

</div>