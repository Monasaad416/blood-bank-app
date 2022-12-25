@extends('admin.layout.layout')
@section('header-title')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h2 class="text-capitalize d-inline">add slider</h2>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active">Add Slider</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection


@section('header-title')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h2 class="text-capitalize d-inline">all sliders</h2>
        </div>
        @can('post-create')
            <div class="col-sm-6 text-right">
                <button type="button" class="btn btn-primary btn-flat">
                    <a href="{{route('sliders.create')}}" class="text-white">Add Slider</a>
                </button>
            </div>
        @endcan
        </div>
    </div><!-- /.container-fluid -->
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        @inject('model', 'App\Models\Slider')

                        @include('inc.errors')

                        {!! Form::model($model,[
                            'route' => 'sliders.store',
                            'files' =>true,
                            ])
                        !!}

                            <div class="card-body">
                                <div class="form-group">
                                    {!!Form::text('title', null,[
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Slider Title...'
                                    ])!!}
                                </div>

                                <div class="form-group">
                                    {!!Form::text('text', null,[
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Slider Text...'
                                    ])!!}
                                </div>


                                <div class="form-group">
                                    {!!Form::text('button', null,[
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Slider Button Text...'
                                    ])!!}
                                </div>


                                
                                <div class="form-group">
                                    {!!Form::file('image')!!}
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

