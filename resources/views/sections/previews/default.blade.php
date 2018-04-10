@foreach($section->params as $param)
    @if($value = $param->value)
        <h6>{{ $param->key }}</h6>
        <div>{!! $value !!}</div>
    @endif
@endforeach