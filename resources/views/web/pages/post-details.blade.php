@extends('web.layout.layout',[
    'pageClass' => 'article-details'
])

@section('client-profile-tab')
    @include('web.layout.client-profile-tab')
@endsection

@section('content')
    <!--inside-article-->
    <div class="inside-article">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="#">Posts</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$post->title}}</li>
                    </ol>
                </nav>
            </div>
            <div class="article-image">
                <img src="{{url('uploads/'. $post->image)}}">
            </div>
            <div class="article-title col-12">
                <div class="h-text col-6">
                    <h4>{{$post->title}}</h4>
                </div>
                <div class="icon col-6">
                    <button type="button"><i class="{{$post->getMyFavouritePosts() ? 'fas' : 'far'}} fa-heart" id="{{$post->id}}" data-id="{{$post->id}}"></i></button>
                </div>
            </div>

            <!--text-->
            <div class="text">
                <p>
                    {{$post->content}}
                </p>
            </div>

            <!--articles-->
            <div class="articles">
                <div class="title">
                    <div class="head-text">
                        <h2>Related Posts</h2>
                    </div>
                </div>
                <div class="view">
                    <div class="row">
                        <!-- Set up your HTML -->
                        <div class="owl-carousel articles-carousel">
                            @foreach ($relatedPosts as $relatedPost )
                                <div class="card">
                                    <div class="photo">
                                        <img src="{{url('uploads/'. $relatedPost->image)}}" class="card-img-top" alt="...">
                                        <a href="{{route('post.details', ['id'=> $relatedPost->id])}}" class="click">Read More</a>
                                    </div>
                                    <a href="#" class="favourite">
                                        <i class="{{$relatedPost->getMyFavouritePosts() ? 'fas' : 'far'}} fa-heart" id="{{$relatedPost->id}}" data-id="{{$relatedPost->id}}"></i>
                                    </a>

                                    <div class="card-body">
                                        <h5 class="card-title">{{$relatedPost->title}}</h5>
                                        <p class="card-text">
                                            {{Str::of($relatedPost->content)->words(20 , '')}}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

