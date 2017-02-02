<div class="well well-sm">
    <img class="img-responsive" src="{{ $tout->image->src }}"/>
    <p><strong>{{ $tout->name }}</strong></p>
    <p>{!! $tout->body !!}</p>
    <p><a class="btn btn-primary" href="{{ $tout->btn_url }}">{{ $tout->btn_text }}</a></p>
</div>