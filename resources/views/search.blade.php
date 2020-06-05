@extends('layouts.app')

@section('content')

@if(count($video)>0)

    <div class="container">
        <div class="row">
            <div class="col-md-6">
    @foreach($video as $item)

        {!! $item->embed !!}


        {{ $item->name }}

    @endforeach
            </div>
        </div>
    </div>
@else

    <div class="container">

        No result
    </div>
@endif
@endsection
