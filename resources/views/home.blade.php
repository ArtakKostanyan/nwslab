@extends('layouts.app')

@section('content')

    <div class="container custom-cont">

             @if(count($videos)==0)

                 Please Add Video

              @endif

            @foreach($videos  as $video )

            <a href="{{route('home.video',$video->id)}}">
            <div class="video-wrap">
                <div class="video">


                    <div class="embed">
                        <div class="iframe">
                                {!!  $video->embed !!}
                        </div>
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach($video->images as $image)
                                    <div class="swiper-slide"
                                         style="background-image:url({{ asset('storage/'.$image->url) }}) ">

                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>

                <div class="desc">

                    <h3>Name</h3>
                    <span> {{$video->name}}</span>
                    <h3>Description</h3>
                    <span> {{$video->desc}}</span>

                </div>
            </div>

            </a>
            @endforeach

    </div>



    <div class="container">
        {{ $videos->links() }}
    </div>
@endsection

@push('scripts')

    <script src="https://unpkg.com/swiper/js/swiper.min.js"></script>

    <script>

        jQuery( document ).ready(function($) {
        $('.swiper-container').each(function(index, element){
            $(this).addClass('s'+index);

            let mySwiper = new Swiper('.s'+index, {

                autoplay: {
                    delay: 1000,
                },
                loop: true,
                slidesPerView: 1,
                spaceBetween: 10,

            })
        });


        });




    </script>
@endpush
