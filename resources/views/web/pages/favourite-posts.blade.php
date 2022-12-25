@extends('web.layout.layout')

@section('client-profile-tab')
    @include('web.layout.client-profile-tab')
@endsection
@section('content')

    <!--articles-->
    <div class="articles">
        <div class="view">
            <div class="container">
                <div class="row">
                    <!-- Set up your HTML -->
                    <div class="owl-carousel articles-carousel">
                        @foreach ($favPosts as $post)
                            <div class="card">
                                <div class="photo">
                                    <img src="{{url('uploads/'. $post->image)}}" class="card-img-top" height="220px" alt="...">
                                    <a href="{{route('post.details', ['id'=> $post->id] )}}"  class="click">More Details</a>
                                </div>
                                <a href="#" class="favourite">

                                    <i class="{{$post->getMyFavouritePosts() ? 'fas' : 'far'}} fa-heart" id="{{$post->id}}" data-id="{{$post->id}}"></i>
                                </a>

                                <div class="card-body">
                                    <h5 class="card-title">{{$post->title}}</h5>
                                    <p class="card-text">
                                        {{Str::of($post->content)->words(20 , ' >>>')}}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@push('scripts')
    <script>
        $(function(){
            $('.fa-heart').click(function(e){
                e.preventDefault();
                var post_id  = $(this).data('id');
                console.log(post_id);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("/web/toggle-post-favourite") }}/"  + post_id,
                    type: "post",
                    data:{post_id : post_id},
                    success: function (data) {
                        $('#' + post_id).toggleClass('far fas');

                    },
                });



            })
        })
    </script>
@endpush
