@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">


                <form method="post" action="{{route('tags.store')}}">

                    @csrf
                    <div class="form-group">
                        <label for="name">Tag Name</label>
                        <input type="text" name="tag" class="form-control" id="name" placeholder="Tag name">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
