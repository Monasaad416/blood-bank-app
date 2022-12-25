@extends('web.layout.layout',[
    'pageClass' => 'create'
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
                    <li class="breadcrumb-item"><a href="{{route('web.home')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
                </ol>
            </nav>
        </div>

        <div class="account-form">
            @inject('model', 'App\Models\Client')

            @include('inc.errors')
            @php
                $governorates = App\Models\Governorate::pluck('name', 'id');
                $cities = [];//get it from ajax
                $bloodTypes = App\Models\BloodType::pluck('name', 'id');
            @endphp
            {!! Form::model($model,[
                'route' => 'client.store',
                ])
            !!}

        <div class="card-body">
            <div class="text-center">
                <a class="navbar-brand" href="{{route('web.home')}}">
                    <img src="{{asset('web-layout/assets/imgs/logo-ltr.png')}}" class="d-inline-block align-top" alt="">
                </a>
            </div>

            <div class="form-group">
            {!!Form::text('name', null,[
                'class' => 'form-control mb-4',
                'placeholder' => 'Enter your name'
            ])!!}

            {!!Form::email('email', null,[
                'class' => 'form-control mb-4',
                'placeholder' => 'Enter your email'
            ])!!}

            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">

            <input type="password" class="form-control" id="exampleInputPassword1" name="password_confirmation" placeholder="Password Confirmation">

            {!!Form::date('date_of_birth', \Carbon\Carbon::now(),[
                'class' => 'form-control mb-4',
                'placeholder' => 'Data od birth'
            ])!!}

            {!! Form::select('governorate_id', $governorates, null ,
                ['class' => 'form-control mb-4',
                    'id' => 'governorate_id',
                    'placeholder' => 'Select governorate',
                ])
            !!}


            {!! Form::select('city_id', $cities, null ,
                ['class' => 'form-control mb-4',
                'placeholder' => 'Select city',
                'id' => 'city_id',
                ])
            !!}

            {!! Form::select('blood_type_id', $bloodTypes, null ,
            ['class' => 'form-control mb-4',
            'placeholder' => 'Select blood type',
            ])
            !!}

            {!!Form::text('phone', null ,[
                'class' => 'form-control mb-4',
                'placeholder' => ' Enter your phone'
            ])!!}
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
                <button class="signin">Register</button>
            </div>
        </div>
        {!! Form::close() !!}
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
