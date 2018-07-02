@php
    $list = $list ?? $owner ?? new \Belt\Content\Lyst();
@endphp

<div class="list">
    @foreach($list->items as $listItem)
        @include('belt-content::list_items.web.show')
    @endforeach
</div>