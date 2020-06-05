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

                <form method="post" action="{{ route('video.store') }}" id="upload" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Video Name</label>
                        <input type="text"  name="name" class="form-control" id="name" placeholder="Video name">
                    </div>

                    <div class="form-group">
                        <label for="desc">Description</label>
                        <textarea  name="desc" class="form-control" id="desc" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="embed">Embed</label>
                        <textarea name="embed" class="form-control" id="embed" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tag">Tags</label>

                        <select multiple="multiple" name="tag[]"  id="tag" class="form-control" >
                             @foreach($tags as $tag)
                              <option value="{{$tag->id}}">{{$tag->name}}</option>
                             @endforeach
                         </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Images</label>
                        <input type="file"  class="form-control" name="file[]" id="image" multiple  >
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
            $('#tag').select2({

                placeholder:'select tags',
                tags:false,
                multiple: true
            });

        });
    </script>


@endpush
