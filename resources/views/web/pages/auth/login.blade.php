@extends('web.layout.layout',[
    'pageClass' =>'signin-account'
])

@section('client-profile-tab')
    @include('web.layout.client-profile-tab')
@endsection

@section('content')
    <!--form-->
    <div class="form">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Login</li>
                    </ol>
                </nav>
            </div>
            <div class="signin-form">
                @inject('model', 'App\Models\Client')

                @include('inc.errors')

                {!! Form::model($model,[
                    'route' => 'client.login',
                    'method' => 'post',
                    ])
                !!}

                    <div class="card-body">
                        <div class="text-center">
                            <a class="navbar-brand" href="{{route('web.home')}}">
                                <img src="{{asset('web-layout/assets/imgs/logo-ltr.png')}}" class="d-inline-block align-top" alt="">
                            </a>
                        </div>

                        <div class="form-group">
                            {!!Form::text('phone', null ,[
                                'class' => 'form-control mb-4',
                                'placeholder' => ' Enter your phone'
                            ])!!}

                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Enter your password">

                        </div>
                        <style>
                            .signin{
                                width: 100%;
                                font-size: 18px;
                                padding: 10px;
                                background-color: #2d3e50;
                                color: #FFF;
                                border: none;
                                margin-top: 20px;
                                cursor: pointer;
                            }
                        </style>
                        <div class="form-group">
                            <div class="row options">
                                <div class="col-md-6 remember">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Remmember Me</label>
                                    </div>
                                </div>
                                <div class="col-md-6 forgot">
                                    <img src="{{url('web-layout/assets/imgs/complain.png')}}">
                                    <a href="{{ route('client.password.email') }}">Forgot Password?</a>
                                </div>
                                @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button class="signin">Login</button>
                                </div>

                                <div class="col-6">
                                    <button class="signin">
                                       <a href="{{route('client.register')}}" style="text-decoration: none; color: #fff">Register</a>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function () {
            $('select[name="governorate_id"]').on('change', function () {
                var governorate_id = $(this).val();
                if (governorate_id) {
                    $.ajax({
                        url: "{{ URL::to('/web/cities') }}/" + governorate_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="city_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="city_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endpush
