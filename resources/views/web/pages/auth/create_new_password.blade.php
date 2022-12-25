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
                        <li class="breadcrumb-item active" aria-current="page">Create New password </li>
                    </ol>
                </nav>
            </div>
            <div class="signin-form">
                @inject('model', 'App\Models\Client')

                @include('inc.errors')

                {!! Form::model($model,[
                    'route' => 'client.password.update',
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
                            {!!Form::number('pin_code', null ,[
                                'class' => 'form-control mb-4',
                                'placeholder' => ' Enter the code '
                            ])!!}
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password_confirmation" placeholder=" Password Confirmation">
                        </div>
                    </div>
                        <style>
                            .signin{
                                width: 100%;
                                font-size: 22px;
                                padding: 12px;
                                background-color: #2d3e50;
                                color: #FFF;
                                border: none;
                                margin-top: 20px;
                                cursor: pointer;
                            }
                        </style>
                        <div class="form-group">
                            <button class="signin">
                                Update Password
                            </button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
