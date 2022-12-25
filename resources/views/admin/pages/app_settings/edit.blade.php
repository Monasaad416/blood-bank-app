@extends('admin.layout.layout')
@section('header-title')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="text-capitalize d-inline">edit application settings</h2>
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
        {!! Form::model( $settings ,[
                'route' => ['settings.update'],
                'method' => 'post',
            ])
        !!}

            <div class="card-body">
                <div class="form-group">
                    {{-- {!!Form::hidden('id', $settings->id)!!} --}}

                    {!!Form::label('name', 'Notification setting text:')!!}
                    {!!Form::text('notification_setting_text', $settings->notification_setting_text,[
                        'class' => 'form-control',
                    ])!!}

                    {!!Form::label('name', 'About app:')!!}
                    {!!Form::text('about_app', $settings->about_app,[
                        'class' => 'form-control',
                    ])!!}

                    {!!Form::label('name', 'Phone:')!!}
                    {!!Form::text('phone', $settings->phone,[
                        'class' => 'form-control',
                    ])!!}

                    {!!Form::label('name', 'Emai:')!!}
                    {!!Form::text('email', $settings->email,[
                        'class' => 'form-control',
                    ])!!}

                    {!!Form::label('name', 'Facebook:')!!}
                    {!!Form::text('fb_url', $settings->fb_url,[
                        'class' => 'form-control',
                    ])!!}

                    {!!Form::label('name', 'Twitter:')!!}
                    {!!Form::text('tw_url', $settings->tw_url,[
                        'class' => 'form-control',
                    ])!!}

                    {!!Form::label('name', 'Instagrsm:')!!}
                    {!!Form::text('insta_url', $settings->insta_url,[
                        'class' => 'form-control',
                    ])!!}

                    {!!Form::label('name', 'Whats-app:')!!}
                    {!!Form::text('whatsapp_url', $settings->whatsapp_url,[
                        'class' => 'form-control',
                    ])!!}
                </div>
                <div class="form-group">
                    {!!Form::submit('update setting',[
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

