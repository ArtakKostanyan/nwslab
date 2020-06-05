@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="container">

    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif

            <a href="{{ route('video.create') }}" class="btn btn-primary">Create New Video</a>
        <table class="table table-striped">
            <thead>
            <tr>

                <td>Name</td>
                <td>Description</td>
                <td>Embed</td>
                <td>Images</td>

            </tr>
            </thead>
            <tbody>
            @foreach($videos as $video)
                <tr>

                    <td>{{$video->name}}</td>
                    <td>{{$video->desc}}</td>
                    <td>{{$video->embed}}</td>
                    <td>
                        <div class="flex">
                        @foreach($video->images  as $image )


                            <img style="max-width: 50px;" src="{{ asset('storage/'.$image->url) }} " alt="">

                        @endforeach
                        </div>
                    </td>

                    <td><a href="{{ route('video.edit', $video->id) }}" class="btn btn-primary">Edit</a></td>
                    <td>
                        <form action="{{route('video.destroy',$video->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>

        </div>
@endsection
