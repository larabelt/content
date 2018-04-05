@foreach($section->params as $param)
    <h6>{{ $param->key }}</h6>
    <div>{!! $param->value  !!}</div>
@endforeach