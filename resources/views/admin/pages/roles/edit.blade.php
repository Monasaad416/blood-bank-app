@extends('admin.layout.layout')
@section('header-title')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h2 class="text-capitalize d-inline">edit role</h2>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active">edit role</li>
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
                            $permissions = Spatie\Permission\Models\Permission::all();
                        @endphp

                        {!! Form::model($role,[
                            'route' => ['roles.update',$role->id],
                            'method' => 'PATCH',
                            ])
                        !!}

                            <div class="card-body">
                                <div class="form-group">
                                    {!!Form::label('name', 'Name:')!!}
                                    {!!Form::text('name', null,[
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter role name...'
                                    ])!!}

                                </div>

                                <div class="form-group">
                                    {!!Form::label('name', 'Select Permissions:')!!}
                                    <div class="my-1">
                                        {!!Form::label( 'all', "Select All",[
                                            'class' => 'mx-1'
                                        ] )!!}
                                        {!!Form::checkbox( "all", "checkedAll",false,[
                                            'id' => 'checkedAll',
                                        ])!!}

                                    </div>
                                    {!!Form::hidden('id', $role->id)!!}
                                    @foreach ($permissions as $permission)
                                        <div class="my-1">
                                            {!!Form::label( 'label', $permission->name ,[
                                                'class' => 'font-weight-light mx-1',
                                            ])!!}

                                            {!!Form::checkbox( "permission[]", $permission->id ,in_array($permission->id, $rolePermissions) ? true : false,[
                                                'class' => 'checkSingle',
                                            ])!!}

                                        </div>
                                    @endforeach
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


@push('scripts')
    <script>
    $(document).ready(function() {
        $("#checkedAll").change(function() {
            if (this.checked) {
                $(".checkSingle").each(function() {
                    this.checked=true;
                });
            } else {
                $(".checkSingle").each(function() {
                    this.checked=false;
                });
            }
        });

        $(".checkSingle").click(function () {
            if ($(this).is(":checked")) {
                var isAllChecked = 0;

                $(".checkSingle").each(function() {
                    if (!this.checked)
                        isAllChecked = 1;
                });

                if (isAllChecked == 0) {
                    $("#checkedAll").prop("checked", true);
                }
            }
            else {
                $("#checkedAll").prop("checked", false);
            }
        });
    });
    </script>
@endpush


