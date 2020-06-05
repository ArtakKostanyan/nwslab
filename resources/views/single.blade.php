@extends('layouts.app')

@section('content')

    <div class="container flex">

        <div class="iframe" style="max-width: 70%;width: 100%;margin-right: 15px">
            {!! $video->embed !!}

            <div>
                <h3>About Video</h3>
                {{ $video->desc }}
            </div>
        </div>


        <div class="card"
             style="max-width: 30%;
             width: 100%;">

            <div class="card-body">

                <div class="card-title">Last vidoes</div>
                <div class="flex-clm">
                    @foreach($lastVideos as $last)

                        <div class="iframe">
                            {!!   $last->embed !!}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
