@extends('admin.layout.layout')
@section('header-title')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h2 class="text-capitalize d-inline">edit slider</h2>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active">Edit Slider</li>
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



                        @include('inc.errors')
           
                        {!! Form::model($slider,[
                            'route' => ['sliders.update',$slider->id],
                            'files' =>true,
                            ])
                        !!}
                         {{ method_field('PATCH')}}

                      
                         <div class="card-body">
                            <div class="form-group">
                                {!!Form::text('title', null,[
                                    'class' => 'form-control',
                                ])!!}
                            </div>

                            <div class="form-group">
                                {!!Form::text('text', null,[
                                    'class' => 'form-control',
                                ])!!}
                            </div>


                            <div class="form-group">
                                {!!Form::text('button', null,[
                                    'class' => 'form-control',
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

