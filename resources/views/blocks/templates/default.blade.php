@php
    $block = $block ?? new \Belt\Content\Block();
@endphp

<div class="block">

    @include($section->template_view, ['block' => $block])

</div>