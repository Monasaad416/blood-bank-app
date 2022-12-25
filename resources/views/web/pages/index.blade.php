@extends('web.layout.layout')

@section('client-profile-tab')
    @include('web.layout.client-profile-tab')
@endsection

@section('content')
    <!--intro-->
    <div class="intro">
        <div id="slider" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#slider" data-slide-to="0" class="active"></li>
                <li data-target="#slider" data-slide-to="1"></li>
                <li data-target="#slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item carousel-1 active">
                    <div class="container info">
                        <div class="col-lg-5">
                            <h3>Blood bank moving forward to better health1</h3>
                            <p>
                                    There is a proven fact from a long time ago that the readable content of a page will not distract the reader from focusing on the.
                            </p>
                            <a href="#">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-2">

                    <div class="container info">
                        <div class="col-lg-5">
                            <h3>Blood bank moving forward to better health2</h3>
                            <p>
                                    There is a proven fact from a long time ago that the readable content of a page will not distract the reader from focusing on the.
                            </p>
                            <a href="#">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-3">

                    <div class="container info">
                        <div class="col-lg-5">
                            <h3>Blood bank moving forward to better health3</h3>
                            <p>
                                    There is a proven fact from a long time ago that the readable content of a page will not distract the reader from focusing on the.
                            </p>
                            <a href="#">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--about-->
    <div class="about">
        <div class="container">
            <div class="col-lg-6 text-center">
                <p>
                    <span>Blood Bank</span>{{$settings->about_app}}
                </p>
            </div>
        </div>
    </div>

    <!--articles-->
    <div class="articles">
        <div class="container title">
            <div class="head-text">
                <h2>Posts</h2>
            </div>
        </div>
        <div class="view">
            <div class="container">
                <div class="row">
                    <!-- Set up your HTML -->
                    <div class="owl-carousel articles-carousel">
                        @foreach ($posts as $post)
                            <div class="card">
                                <div class="photo">
                                    <img src="{{url('uploads/'. $post->image)}}" class="card-img-top" height="220px" alt="...">
                                    <a href="{{route('post.details', ['id'=> $post->id] )}}"  class="click">Read More</a>
                                </div>
                                <a href="#" class="favourite">
                                    <i class="{{$post->getMyFavouritePosts() ? 'fas' : 'far'}} fa-heart" id="{{$post->id}}" data-id="{{$post->id}}"></i>
                                </a>

                                <div class="card-body">
                                    <h5 class="card-title">{{$post->title}}</h5>
                                    <p class="card-text">
                                        {{Str::of($post->content)->words(20 , '')}}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>


    @auth('client-web')
        <!--requests-->
        <div class="requests">
            <div class="container">
                <div class="head-text">
                    <h2>Donation Requests</h2>
                </div>
            </div>
            <div class="content">
                <div class="container">
                    <form class="row filter" method="GET" action="{{route('donation.requests')}}">
                        <div class="col-md-5 blood">
                            <div class="form-group">
                                <div class="inside-select">
                                    <select class="form-control" name="blood_type_id" id="exampleFormControlSelect1">
                                        <option selected disabled>Select blood type</option>
                                        @foreach ($bloodTypes as $bloodType)
                                            <option value="{{$bloodType->id}}">{{$bloodType->name}}</option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 city">
                            <div class="form-group">
                                <div class="inside-select">
                                    <select class="form-control" name="city_id" id="exampleFormControlSelect1">
                                        <option selected disabled>Select city</option>
                                        @foreach ($cities as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 search">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <div class="patients">
                        @foreach ($donationRequests as $donationReq)
                            <div class="details">
                                <div class="blood-type">
                                    <h2 dir="ltr">{{$donationReq->bloodType->name}}</h2>
                                </div>
                                <ul>
                                    <li><span>Patient Name:</span>{{$donationReq->patient_name}}</li>
                                    <li><span>Hospital Name:</span>{{$donationReq->hospital_name}}</li>
                                    <li><span>City:</span> {{$donationReq->city->name}}</li>
                                </ul>
                                <a href="{{route('donation.request.details',$donationReq->id)}}">Details</a>
                            </div>
                        @endforeach

                    </div>
                    <div class="more">
                        <a href="{{route('donation.requests')}}">More Requests</a>
                    </div>
                </div>
            </div>
        </div>
    @endauth

    <!--contact-->
    <div class="contact">
        <div class="container">
            <div class="col-md-7">
                <div class="title">
                    <h3>Contact Us</h3>
                </div>
                <p class="text">If you have any question dont hesitate to contact us</p>
                <div class="row whatsapp">
                    <a href="#">
                        <img src="{{url('web-layout/assets/imgs/whats.png')}}">
                        <p dir="ltr">{{$settings->phone}}</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!--app-->
    <div class="app">
        <div class="container">
            <div class="row">
                <div class="info col-md-6">
                    <h3>Blood Bank</h3>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    </p>
                    <div class="download">
                        <h4> Download Now</h4>
                        <div class="row stores">
                            <div class="col-sm-6">
                                <a href="#">
                                    <img src="{{url('web-layout/assets/imgs/google.png')}}">
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="#">
                                    <img src="{{url('web-layout/assets/imgs/ios.png')}}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="screens col-md-6">
                    <img src="{{url('web-layout/assets/imgs/App.png')}}">
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')

@endpush




{{--
<!doctype html>
<html lang="en">
    @include('web.layout.head')
    <body>
        @include('web.layout.navbar')

        <!--intro-->
        <div class="intro">
            <div id="slider" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#slider" data-slide-to="0" class="active"></li>
                    <li data-target="#slider" data-slide-to="1"></li>
                    <li data-target="#slider" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    @foreach ($sliders as $key=>$slider)
                    <style>
                        .carousel-item{
                            background-image: url({{url('uploads/'. $slider->image)}});
                        }

                    </style>
                    <div class="carousel-item carousel-{{$key}} {{$key == 0 ? 'active' : ''}}">

                        <div class="container info">
                            <div class="col-lg-5">
                                <h3>{{$slider->title}}</h3>
                                <p>
                                    {{$slider->text}}
                                </p>
                                <a href="#">{{$slider->button}}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>

        <!--about-->
        <div class="about">
            <div class="container">
                <div class="col-lg-6 text-center">
                    <p>
                        <span>Blood Bank</span> {{$settings->about_app}}
                    </p>
                </div>
            </div>
        </div>

    <!--articles-->
    <div class="articles">
        <div class="container title">
            <div class="head-text">
                <h2>Posts</h2>
            </div>
        </div>
        <div class="view">
            <div class="container">
                <div class="row">
                    <!-- Set up your HTML -->
                    <div class="owl-carousel articles-carousel">
                        @foreach ($posts as $post)
                            <div class="card">
                                <div class="photo">
                                    <img src="{{url('uploads/'. $post->image)}}" class="card-img-top" height="220px" alt="...">
                                    <a href="{{route('post.details', ['id'=> $post->id] )}}"  class="click">المزيد</a>
                                </div>
                                <a href="#" class="favourite">
                                    <i class="{{$post->getMyFavouritePosts() ? 'fas' : 'far'}} fa-heart" id="{{$post->id}}" data-id="{{$post->id}}"></i>
                                </a>

                                <div class="card-body">
                                    <h5 class="card-title">{{$post->title}}</h5>
                                    <p class="card-text">
                                        {{Str::of($post->content)->words(20 , '')}}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>


    @auth('client-web')
        <!--requests-->
        <div class="requests">
            <div class="container">
                <div class="head-text">
                    <h2>Donation Requests</h2>
                </div>
            </div>
            <div class="content">
                <div class="container">
                    <form class="row filter" method="GET" action="{{route('donation.requests')}}">
                        <div class="col-md-5 blood">
                            <div class="form-group">
                                <div class="inside-select">
                                    <select class="form-control" name="blood_type_id" id="exampleFormControlSelect1">
                                        <option selected disabled>Select blood type</option>
                                        @foreach ($bloodTypes as $bloodType)
                                            <option value="{{$bloodType->id}}">{{$bloodType->name}}</option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 city">
                            <div class="form-group">
                                <div class="inside-select">
                                    <select class="form-control" name="city_id" id="exampleFormControlSelect1">
                                        <option selected disabled>Select city</option>
                                        @foreach ($cities as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 search">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <div class="patients">
                        @foreach ($donationRequests as $donationReq)
                            <div class="details">
                                <div class="blood-type">
                                    <h2 dir="ltr">{{$donationReq->bloodType->name}}</h2>
                                </div>
                                <ul>
                                    <li><span> Patient name:</span>{{$donationReq->patient_name}}</li>
                                    <li><span>Hospital name:</span>{{$donationReq->hospital_name}}</li>
                                    <li><span>City:</span> {{$donationReq->city->name}}</li>
                                </ul>
                                <a href="{{route('donation.request.details',$donationReq->id)}}">التفاصيل</a>
                            </div>
                        @endforeach

                    </div>
                    <div class="more">
                        <a href="{{route('donation.requests')}}">More Requests</a>
                    </div>
                </div>
            </div>
        </div>
    @endauth

        <!--contact-->
        <div class="contact">
            <div class="container">
                <div class="col-md-7">
                    <div class="title">
                        <h3>Contact Us</h3>
                    </div>
                    <p class="text">Call us if you have any question</p>
                    <div class="row whatsapp">
                        <a href="#">
                            <img src="{{url('web-layout/assets/imgs/whats.png')}}">
                            <p dir="ltr">{{$settings->phone}}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    <!--app-->
    <div class="app">
        <div class="container">
            <div class="row">
                <div class="info col-md-6">
                    <h3>Blood Bank</h3>
                    <p>
                       Lorem Ipsum is simply dummy text of the printing and typesetting industry
                    </p>
                    <div class="download">
                        <h4>Download Now</h4>
                        <div class="row stores">
                            <div class="col-sm-6">
                                <a href="#">
                                    <img src="{{url('web-layout/assets/imgs/google.png')}}">
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="#">
                                    <img src="{{url('web-layout/assets/imgs/ios.png')}}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="screens col-md-6">
                    <img src="{{url('web-layout/assets/imgs/App.png')}}">
                </div>
            </div>
        </div>
    </div>
        <!--footer-->
        @include('web.layout.footer')

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        @include('web.layout.footer_scripts')
    </body>
</html> --}}
