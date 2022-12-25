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
                    <li class="breadcrumb-item"><a href="{{route('web.home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Donation Request  </li>
                </ol>
            </nav>
        </div>

        <div class="account-form">
            @inject('model', 'App\Models\DonationRequest')

            @include('inc.errors')
            @php
                $cities = App\Models\City::pluck('name', 'id');
                $bloodTypes = App\Models\BloodType::pluck('name', 'id');
            @endphp
            {!! Form::model($model,[
                'route' => 'store.donation.request',
                ])
            !!}

        <div class="card-body">
            <div class="text-center">
                <a class="navbar-brand" href="{{route('web.home')}}">
                    <img src="{{asset('web-layout/assets/imgs/logo-ltr.png')}}" class="d-inline-block align-top" alt="">
                </a>
            </div>

            <div class="form-group">


            {!!Form::text('patient_name', null,[
                'class' => 'form-control mb-4',
                'placeholder' => 'Patient Name'
            ])!!}

            {!!Form::number('patient_age', null,[
                'class' => 'form-control mb-4',
                'min' => 0,
                'max' => 150,
                'placeholder' => 'Patient age'
            ])!!}

{{--
            {!!Form::label('blood_type', 'فصيلة الدم')!!} --}}
            {!! Form::select('blood_type_id', $bloodTypes, null ,
            ['class' => 'form-control mb-4',
            'placeholder' => 'Select blood type',
            ])
            !!}


            {{-- {!!Form::label('name', 'عدد اكياس الدم المطلوبة')!!} --}}
            {!!Form::number('bags_num', null,[
                'class' => 'form-control mb-4',
                'min' => 0,
                'max' => 100,
                'placeholder' => 'No. of bags'
            ])!!}

            {{-- {!!Form::label('name', 'إسم ال')!!} --}}
            {!!Form::text('hospital_name', null,[
                'class' => 'form-control mb-4',
                'placeholder' => 'Hospital name'
            ])!!}

            {!!Form::text('hospital_address', null,[
                'class' => 'form-control mb-4',
                'placeholder' => 'Hospital address'
            ])!!}
              {!!Form::text('lattitude', null,[
                'class' => 'form-control mb-4',

            ])!!}
              {!!Form::text('longitude', null,[
                'class' => 'form-control mb-4',

            ])!!}

            {!! Form::select('city_id', $cities, null ,
                ['class' => 'form-control mb-4',
                'placeholder' => ' Select city',
                'id' => 'city_id',
                ])
            !!}

            {!!Form::text('patient_phone', null ,[
                'class' => 'form-control mb-4',
                'placeholder' => ' Phone'
            ])!!}

            {!!Form::text('notes', null,[
                'class' => 'form-control mb-4',
                'placeholder' => 'notes'
            ])!!}

            {!!Form::hidden('client_id', request()->user()->id,[
                'class' => 'form-control mb-4',
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
                <button class="signin">Create Donation Request</button>
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
