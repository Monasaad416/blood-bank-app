@extends('web.layout.layout',[
    'pageClass' => 'who-are-us'
])

@section('client-profile-tab')
    @include('web.layout.client-profile-tab')
@endsection


@section('content')
        <!--inside-article-->
        <div class="about-us">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/web')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">About Us </li>
                        </ol>
                    </nav>
                </div>
                <div class="details">
                    <div class="logo">
                        <img src="{{url('web-layout/assets/imgs/logo-ltr.png')}}">
                    </div>
                    <div class="text">
                        <p>
                           Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                        </p>
                        <p>
                           Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                        </p>
                        <p>
                           Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                        </p>
                    </div>
                </div>
            </div>
        </div>
@endsection
