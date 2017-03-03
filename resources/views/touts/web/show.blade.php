<div class="well well-sm">
    @if($tout->image)
    <img class="img-responsive" src="{{ $tout->image->src }}"/>
    @endif
    <p><strong>{{ $tout->name }}</strong></p>
    <p>{!! $tout->body !!}</p>
    <p><a class="btn btn-primary" href="{{ $tout->btn_url }}">{{ $tout->btn_text }}</a></p>
</div>