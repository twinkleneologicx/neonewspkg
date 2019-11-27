@extends('news::layout.app')
@section('content')
{{-- {{dd($data)}} --}}
<div class="row" style="overflow-x:hidden; margin:3% 0;">
    <div class="col-md-1"></div>
    <div class="col-md-11">
        <h3>{{$data->name}}</h3>
    </div>
</div>
@if (count($data->descnews))
@foreach ($data->descnews as $item)
<div class="row" style="overflow-x:hidden; margin:0; margin-top: 35px; object-fit:cover;">
    <div class="col-md-1"></div>
    <div class="col-md-4"><img src="{{\Storage::url($item->image)}}"
            style="min-width:300px; max-width:300px; min-height:250px; max-height:250px; object-fit:cover;" alt="">
    </div>
    <div class="col-md-6">
        <h4>{{$item->heading}}</h4>
        <p>{!! $item->description !!}</p>
    </div>
    <div class="col-md-1"></div>
</div>
@endforeach
@else
<div style="width:80%; margin:0 auto; text-align:center;">
    <p class="alert alert-danger">No news</p>
</div>
@endif
@endsection