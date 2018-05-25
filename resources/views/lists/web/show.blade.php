@foreach($list->places as $pivot)
    <div class="well well-sm">
        <p>{{ $pivot->heading }}</p>
        <p>{{ $pivot->body }}</p>
        <p>{{ $pivot->place->name }}</p>
    </div>
@endforeach
