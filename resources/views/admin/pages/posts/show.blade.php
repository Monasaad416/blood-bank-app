@extends('admin.layout.layout')
@section('header-title')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h2 class="text-capitalize d-inline">post details</h2>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active">post details</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">{{$post->title}}</h3>
                </div>
                <div class="row">
                    <div class="text-center my-3">
                        <img class="w-75" src="{{url('uploads/'.$post->image)}}"
                    </div>
                    <div>
                        <div class="card-body">
                            {{$post->content}}
                        </div>
                        <div class="card-footer">
                            <span class="text-muted my-2"> written by: {{request()->user()->name}}</span>
                            <br>
                            <span class="text-muted my-2"> created at: {{$post->created_at}}</h>
                        </div>

                    </div>

                </div>


              </div>
            </div>
            <div class="col-2"></div>
        </div>
    </section>
@endsection

