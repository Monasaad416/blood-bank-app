@extends('admin.layout.layout')
@section('styles')
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css?v=3.2.0')}}">
    {{-- <script defer="" referrerpolicy="origin" src="/cdn-cgi/zaraz/s.js?z=JTdCJTIyZXhlY3V0ZWQlMjIlM0ElNUIlNUQlMkMlMjJ0JTIyJTNBJTIyQWRtaW5MVEUlMjAzJTIwJTdDJTIwRGF0YVRhYmxlcyUyMiUyQyUyMnglMjIlM0EwLjA1NjQ2MDA0OTYyNjg4OTQ0JTJDJTIydyUyMiUzQTE1MzYlMkMlMjJoJTIyJTNBOTYwJTJDJTIyaiUyMiUzQTQzMyUyQyUyMmUlMjIlM0ExNTM2JTJDJTIybCUyMiUzQSUyMmh0dHBzJTNBJTJGJTJGYWRtaW5sdGUuaW8lMkZ0aGVtZXMlMkZ2MyUyRnBhZ2VzJTJGdGFibGVzJTJGZGF0YS5odG1sJTIyJTJDJTIyciUyMiUzQSUyMmh0dHBzJTNBJTJGJTJGYWRtaW5sdGUuaW8lMkZ0aGVtZXMlMkZ2MyUyRnBhZ2VzJTJGd2lkZ2V0cy5odG1sJTIyJTJDJTIyayUyMiUzQTI0JTJDJTIybiUyMiUzQSUyMlVURi04JTIyJTJDJTIybyUyMiUzQS0xODAlMkMlMjJxJTIyJTNBJTVCJTVEJTdE"></script> --}}
@endsection


@section('header-title')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h2 class="text-capitalize d-inline">all posts</h2>
        </div>
        @can('post-create')
            <div class="col-sm-6 text-right">
                <button type="button" class="btn btn-primary btn-flat">
                    <a href="{{route('posts.create')}}" class="text-white">Add Post</a>
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
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">title</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Category</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Image</th>
                                                @can('post-edit')
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Edit</th>
                                                @endcan
                                                @can('post-show')
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Show</th>
                                                @endcan
                                                @can('post-delete')
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Delete</th>
                                                @endcan
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($posts as $key=>$post)
                                                    <tr class="{{$key % 2 == 0 ? 'even' : 'odd'}}}">
                                                        <td>{{$loop->iteration}}</td>
                                                        <td class="dtr-control sorting_1" tabindex="0">{{$post->title}}</td>
                                                        <td class="dtr-control sorting_1" tabindex="0">{{$post->category->name}}</td>
                                                        <td class="dtr-control sorting_1" tabindex="0">
                                                            <img src="{{url('uploads/'.$post->image)}}" width="60px" height="60px" alt="">
                                                        </td>
                                                        @can('post-edit')
                                                            <td>
                                                                <a href="{{route("posts.edit",$post->id)}}" class="btn btn-sm btn-info mx-1 edit-btn" title="Edit"><i class="fas fa-edit"></i></a>
                                                            </td>
                                                        @endcan
                                                        @can('post-show')
                                                            <td>
                                                                <a href="{{route("posts.show",$post->id)}}" class="btn btn-sm btn-secondary mx-1" title="Show"><i class="fas fa-eye"></i></a>
                                                            </td>
                                                        @endcan
                                                        @can('post-delete')
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-{{$post->id}}">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>

                                                                <!-- Delete modal start -->
                                                                <form action="{{route('posts.destroy',$post)}}" method="POST">
                                                                    <div class="modal fade" id="delete-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Are your sure you want to delete post:<span class="text-info"> {{$post->title}} ?</span></p>
                                                                                    @csrf
                                                                                    {{method_field('delete')}}

                                                                                    <input type="hidden" value="{{$post->id}}" name="id">
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


                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
