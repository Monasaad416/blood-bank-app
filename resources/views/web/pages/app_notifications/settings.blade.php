@extends('web.layout.layout',[
    'pageClass' => 'create'
])

@section('client-profile-tab')
    @include('web.layout.client-profile-tab')
@endsection

@section('content')
<!--form-->
<div class="request">
    <div class="container">
        <div class="path">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('web.home')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">تعديل إعدادات الإشعارات</li>
                </ol>
            </nav>
        </div>

        <div class="">
            @inject('model', 'App\Models\Client')

            @include('inc.errors')
            @php
                $bloodTypes = App\Models\BloodType::all();
                $governorates = App\Models\Governorate::all();
            @endphp
            {!! Form::model($model,[
                'route' => ['client.notifications.update' , $client->id ],
                ])
            !!}
         <style>
            .heading{
                width: 100%;
                font-size: 22px;
                padding: 12px;
                background-color: #2d3e50;
                color: #FFF;
                border: none;
                margin-top: 20px;
            }
        </style>
            <div class="card-body">
                <div class="form-group">
                    {!!Form::label('name', 'إختار فصائل الدم التي تود إشعارك بها',[
                        'class'=> 'heading my-4'
                    ])!!}
                    <div class="my-1">
                        {!!Form::label( 'all', "إختار الكل",[
                            'class' => 'mx-1'
                        ] )!!}
                        {!!Form::checkbox( "all", "checkedAll",false,[
                            'id' => 'checkedAll',
                        ])!!}

                    </div>
                    <div class="row">
                        @foreach ($bloodTypes as $bloodType)
                            <div class="col-3 ">
                                    {!!Form::checkbox( "blood_type_id[]", $bloodType->id , in_array($bloodType->id, $clientBloodTypes->pluck('id')->toArray()) ? true : false,[
                                        'class' => 'checkSingleBloodType',
                                    ])!!}

                                    {!!Form::label( 'label', $bloodType->name ,[
                                        'class' => 'font-weight-light',
                                    ])!!}

                            </div>
                        @endforeach
                    </div>
                </div>


                <div class="form-group">
                    {!!Form::label('name', 'إختار المحافظات التي تود إشعارك بها',[
                        'class'=> 'heading my-4'
                    ])!!}
                    <div class="my-1">
                        {!!Form::label( 'all', "إختار الكل",[
                            'class' => 'mx-1'
                        ] )!!}
                        {!!Form::checkbox( "all", "checkedAll",false,[
                            'id' => 'checkedAll',
                        ])!!}

                    </div>
                    <div class="row">
                        @foreach ($governorates as $governorate)
                            <div class="col-3 ">

                                    {!!Form::checkbox( "governorate_id[]", $governorate->id , in_array($governorate->id, $clientGovernorates->pluck('id')->toArray()) ? true : false,[
                                        'class' => 'checkSingleGovernorate',
                                    ])!!}

                                    {!!Form::label( 'label', $governorate->name ,[
                                        'class' => 'font-weight-light',
                                    ])!!}

                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    {!!Form::submit('حفظ إعدادات الإشعارات',[
                        'class' =>'heading',
                        'style' => 'cursor:pointer',
                    ])!!}
                </div>
            </div>

            {!! Form::close() !!}

@endsection


