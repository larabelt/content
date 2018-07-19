@php
    $block = $block ?? new \Belt\Content\Block();
@endphp

<div class="block">

    @include($section->subtype_view, ['block' => $block])

</div>