@extends('layouts.app')

@section('content')



    <div class="container">

        <h1>Tags</h1>
        <ul class="ul">

            @foreach($tags as $tag)

                <li><a href="#" data-id="{{ $tag->id }}">{{$tag->name}}</a></li>
            @endforeach
        </ul>

        <div class="loading" style="display: none;text-align: center">
            Loading...
        </div>
        <div class="video" style="margin: auto;width: 30%">
            <div class="iframe"></div>

        </div>


    </div>

@endsection
@push('scripts')

    <script>


        jQuery(document).ready(function ($) {

            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });


            $('ul.ul  a').on('click', function (e) {

                e.preventDefault();
                let id = $(this).data("id")

                $.ajax({

                    type: 'POST',
                    url: '{{ route('home.showTags')}}',
                    data: {id: id},

                    beforeSend: function () {

                        $('.loading').css({

                            'display': 'block'
                        })
                    },
                    success: function (even) {

                        if (even.ok) {

                            const vidoe = $('.video .iframe');
                            vidoe.children().remove();
                            even.ok.forEach((val, ind) => {

                                if (val.length > 0) {
                                    val.forEach((v, i) => {

                                        vidoe.append(v.embed)

                                    })
                                } else {
                                     vidoe.append("<div>No Resulte</div>")
                                }
                            })


                        }

                    },
                    complete: () => {
                        $('.loading').css({

                            'display': 'none'
                        })
                    },
                    error: function (err) {
                        console.error(err)
                    }
                });
            });

        });
    </script>
@endpush
