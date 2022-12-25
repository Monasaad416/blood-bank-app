@extends('admin.layout.layout')
@section('header-title')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h2 class="text-capitalize d-inline">edit category</h2>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active">edit category</li>
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

                    {!! Form::model($category,[
                        'route' => ['categories.update',$category->id],
                        'method' => 'PATCH',
                        ])
                    !!}

                        <div class="card-body">
                            <div class="form-group">
                                {!!Form::label('name', 'Name:')!!}
                                {!!Form::text('name', null,[
                                    'class' => 'form-control',
                                ])!!}

                                {!!Form::hidden('id', $category->id)!!}
                            </div>
                            <div class="form-group">
                                {!!Form::submit('Edit',[
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

