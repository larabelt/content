@php
    $listItem = $listItem ?? new \Belt\Content\ListItem();
@endphp

<div class="well well-sm">
    @foreach($listItem->params as $param)
        <p><strong>{{ $param->key }}</strong> {{ $param->value }}</p>
    @endforeach
</div>