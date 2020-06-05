@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div  class="col-md-8">


                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif

                <form method="post" action="{{ route('video.update',$video->id) }}" id="upload" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Video Name</label>
                        <input type="text"  name="name" value="{{$video->name}}" class="form-control" id="name" placeholder="Video name">
                    </div>

                    <div class="form-group">
                        <label for="desc">Description</label>
                        <textarea  placeholder="" name="desc"  class="form-control" id="desc" rows="3">{{$video->desc}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="embed">Tags</label>
                        <textarea name="embed" class="form-control" id="embed" rows="3">{{$video->embed}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="tag">Example select</label>
                        <select multiple="multiple" name="tag[]"  id="tag" class="form-control" >
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}" selected>{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Images</label>
                        <input type="file" class="form-control" name="file[]" id="image" multiple  >
                    </div>

                    <div class="form-group">
                        <div class="flex">
                        @foreach($video->images  as $image )

                                <img style="max-width: 50px;" src="{{ asset('storage/'.$image->url) }} " alt="">

                        @endforeach
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>

        jQuery( document ).ready(function($) {
            $('#tag').select2({});

        });
    </script>


@endpush
