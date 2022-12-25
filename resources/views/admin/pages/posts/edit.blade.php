@extends('admin.layout.layout')
@section('header-title')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h2 class="text-capitalize d-inline">edit post</h2>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active">Edit Post</li>
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
                        @php
                            $categories = App\Models\Category::pluck('name', 'id');
                        @endphp


                        {!! Form::model($post,[
                            'route' => ['posts.update',$post->id],
                            'files' =>true,
                            ])
                        !!}
                         {{ method_field('PATCH')}}

                            <div class="card-body">
                                <div class="form-group">
                                    {!!Form::label('name', 'Title:')!!}
                                    {!!Form::text('title', null,[
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter post title...'
                                    ])!!}
                                </div>
                                {!!Form::hidden('id', $post->id)!!}
                                <div class="form-group">
                                    {!!Form::label('name', 'Image:')!!}
                                    {!!Form::file('image')!!}
                                </div>
                                <div class="form-group">
                                    {!!Form::label('name', 'Content:')!!}
                                    {!!Form::text('content', null,[
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter post content...'
                                    ])!!}
                                </div>
                                <div>
                                    {!!Form::label('name', 'Category:')!!}
                                    {!! Form::select('category_id', $categories, null ,
                                    ['class' => 'form-control my-3 ',
                                    'id'=> '',
                                    'placeholder' => 'Select Category...',
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

