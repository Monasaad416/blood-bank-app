@extends('admin.layout.layout')
@section('styles')
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css?v=3.2.0')}}">
    <!-- jquery Confirm plugin -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

@endsection


@section('header-title')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h2 class="text-capitalize d-inline">all governorates</h2>
        </div>
        @can('governorate-create')
            <div class="col-sm-6 text-right">
                <button type="button" class="btn btn-primary btn-flat">
                    <a href="{{route('governorates.create')}}" class="text-white">Add Governorate</a>
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
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                    <div class="dt-buttons btn-group flex-wrap">
                                    </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                                            <thead>
                                            <tr>
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Name</th>
                                                @can('category-edit')
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Edit</th>
                                                @endcan
                                                @can('category-delete')
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Delete</th>
                                                @endcan
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($governorates as $key=>$governorate)
                                                    <tr class="{{$key % 2 == 0 ? 'even' : 'odd'}}}">
                                                        <td>{{$loop->iteration}}</td>
                                                        <td class="dtr-control sorting_1" tabindex="0">{{$governorate->name}}</td>
                                                        @can('category-edit')
                                                            <td>
                                                                <a href="{{route("governorates.edit",$governorate->id)}}" class="btn btn-sm btn-info mx-1 edit-btn" title="Edit"><i class="fas fa-edit"></i></a>
                                                            </td>
                                                        @endcan


                                                        @can('category-delete')
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-{{$governorate->id}}">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                                <!-- Delete modal start -->
                                                                <form action="{{route('governorates.destroy',$governorate)}}" method="POST">
                                                                    <div class="modal fade" id="delete-{{$governorate->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Governorate</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Are your sure you want to delete governorate:{{$governorate->name}}?</p>

                                                                                    @csrf
                                                                                    {{method_field('delete')}}
                                                                                    <input type="hidden" value="{{$governorate->id}}" name="id">
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                        <button type="submit" name="submit" class="btn btn-danger">Delete</button>
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                <!-- Delete modal end -->

                                                            </td>
                                                        @endcan
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">ID</th>
                                                    <th rowspan="1" colspan="1">Name</th>
                                                    <th rowspan="1" colspan="1">Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



@push('scripts')
    <script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- jquery Confirm plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <script>
        $(function () {
          $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            pageLength : 20,
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        });




    </script>
@endpush
