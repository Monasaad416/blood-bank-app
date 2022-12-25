@extends('admin.layout.layout')
@section('header-title')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h2 class="text-capitalize d-inline">message details</h2>
            <h6 class="text-muted my-2">Message from {{$message->client->name}}</h>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active">show message</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection
@section('content')

    <section class="content">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body p-0">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="font-weight: bold">Client Name</td>
                                    <td>{{$message->client->name}}</td>
                                </tr>

                                <tr>
                                    <td style="font-weight: bold">Client Email</td>
                                    <td>{{$message->client->email}}</td>
                                </tr>

                                <tr>
                                    <td style="font-weight: bold">Message Title</td>
                                    <td>{{$message->title}}</td>
                                </tr>

                                <tr>
                                    <td style="font-weight: bold">Message Content</td>
                                    <td>{{$message->content}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Respond To Message</h3>
                        <div class="card-tools">
                        </div>
                        </div>
                    <div class="card-body p-0">
{{-- 
                        @inject('model', 'App\Models\Message')

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
                        {!! Form::close() !!} --}}

                    </div>
                </div>
            </div>
        </div>



    </section>
@endsection

