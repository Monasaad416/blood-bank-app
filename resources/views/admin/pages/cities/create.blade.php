
@extends('admin.layout.layout')

@section('header-title')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h2 class="text-capitalize d-inline">add governorate</h2>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active">Add Governorate</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        @inject('model', 'App\Models\City')

                        @include('inc.errors')
                        @php
                            $governorates = App\Models\Governorate::pluck('name', 'id');
                        @endphp
                        {!! Form::model($model,[
                            'route' => 'governorates.store',
                            ])
                        !!}

                            <div class="card-body">
                                <div class="form-group">
                                    {!!Form::label('name', 'Name:')!!}
                                    {!!Form::text('name', null,[
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter city name...'
                                    ])!!}

                                    {!!Form::label('governorate', 'Governorate:')!!}
                                    {!! Form::select('governorate_id', $governorates, null ,
                                    ['class' => 'form-control my-3',
                                    'id'=> '',
                                    'placeholder' => 'Select Governorate...',
                                    ])
                                    !!}

                                </div>
                                <div class="form-group">
                                    {!!Form::submit('Save',[
                                        'class' =>'btn btn-primary btn-flat'
                                    ])!!}
                                </div>
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

