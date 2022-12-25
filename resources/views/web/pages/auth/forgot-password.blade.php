{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}



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
                        <li class="breadcrumb-item active" aria-current="page">Forgot password</li>
                    </ol>
                </nav>
            </div>
            <div class="signin-form">

                <style>
                    .forget_pw{
                        width: 100%;
                        font-size: 18px;
                        padding: 12px;
                        background-color:#e31e25;
                        color: #FFF;
                        border: none;
                        margin-top: 20px;
                        cursor: pointer;
                    }
                </style>
            <div class="forget_pw my-4 text-font-weight-bold py-3 px-2">
                    Forgot your password? No problem  ,enter your phone and your email and you will receieve code to reset your password in your email
                </div>

                @inject('model', 'App\Models\Client')

                @include('inc.errors')

                {!! Form::model($model,[
                    'route' => 'client.password.email',
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
                                'placeholder' => 'Enter your phone'
                            ])!!}
                        </div>
                        <div class="form-group">
                            {!!Form::email('email', null,[
                                'class' => 'form-control mb-4',
                                'placeholder' => 'Enter your email'
                            ])!!}
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
                                 Code Request
                            </button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
