@extends('web.layout.layout',[
    'pageClass' => 'contact-us'
])
@section('client-profile-tab')
    @include('web.layout.client-profile-tab')
@endsection
@section('content')
    <!--contact-us-->
    <div class="contact-now">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('web.home')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact Us </li>
                    </ol>
                </nav>
            </div>
            <div class="row methods">
                <div class="col-md-6">
                    <div class="call">
                        <div class="title">
                            <h4>Contact Us</h4>

                        </div>
                        <div class="content">
                            <div class="logo">
                                <img src="{{url('web-layout/assets/imgs/logo-ltr.png')}}">
                            </div>
                            <div class="details">
                                <ul>
                                    <li><span>Phone:</span> {{$settings->phone}}</li>
                                    <li><span> Email:</span> {{$settings->email}}</li>
                                </ul>
                            </div>
                            <div class="social">
                                <h4>تواصل معنا</h4>
                                <div class="icons" dir="ltr">
                                    <div class="out-icon">
                                        <a href="{{$settings->fb_url}}"><img src="{{url('web-layout/assets/imgs/001-facebook.svg')}}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="{{$settings->tw_url}}"><img src="{{url('web-layout/assets/imgs/002-twitter.svg')}}"></a>
                                    </div>

                                    <div class="out-icon">
                                        <a href="{{$settings->insta_url}}"><img src="{{url('web-layout/assets/imgs/004-instagram.svg')}}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="{{$settings->whatsapp_url}}"><img src="{{url('web-layout/assets/imgs/005-whatsapp.svg')}}"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
                        <div class="title">
                            <h4>Contact Us</h4>
                        </div>
                        <div class="fields">
                            @inject('model', 'App\Models\Message')

                            @include('inc.errors')

                            {!! Form::model($model,[
                                'route' => 'message.send',
                                'method' => 'post'
                                ])
                            !!}
                                {!!Form::text('name', null,[
                                    'class' => 'form-control',
                                    'placeholder' => 'name'
                                ])!!}
                                {!!Form::email('email', null,[
                                    'class' => 'form-control',
                                    'placeholder' => 'email'
                                ])!!}
                                {!!Form::text('phone', null,[
                                    'class' => 'form-control',
                                    'placeholder' => 'phone'
                                ])!!}
                                {!!Form::text('title', null,[
                                    'class' => 'form-control',
                                    'placeholder' => 'message title'
                                ])!!}
                                {!!Form::text('content', null,[
                                    'class' => 'form-control',
                                    'placeholder' => 'message content'
                                ])!!}

                                @auth('client-web')
                                    <button type="submit">Send</button>
                                @else
                                    <p class="text-danger">You must loggin first to send a message</p>
                                @endauth
                                {!!Form::close() !!}

                                <div class="card-body">
                                    <div class="form-group">

                                    </div>
                                    <div class="form-group">

                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
