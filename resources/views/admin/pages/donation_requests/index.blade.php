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
                <h2 class="text-capitalize d-inline">all donation requests</h2>
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
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Patient Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">age</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Blood Type</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">No. of Bags</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Hospital</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">City</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Patient Phone</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Client</th>
                                                @can('donation-request-show')
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Show</th>
                                                @endcan
                                                @can('donation-request-delete')
                                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Delete</th>
                                                @endcan
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($donationRequests as $key=>$donationRreqest)
                                                    <tr class="{{$key % 2 == 0 ? 'even' : 'odd'}}}">
                                                        <td>{{$loop->iteration}}</td>
                                                        <td class="dtr-control sorting_1" tabindex="0">{{$donationRreqest->patient_name}}</td>
                                                        <td class="dtr-control sorting_1" tabindex="0">{{$donationRreqest->patient_age}}</td>
                                                        <td class="dtr-control sorting_1" tabindex="0">{{$donationRreqest->bloodType->name}}</td>
                                                        <td class="dtr-control sorting_1" tabindex="0">{{$donationRreqest->bags_num}}</td>
                                                        <td class="dtr-control sorting_1" tabindex="0">{{$donationRreqest->hospital_name}}</td>
                                                        <td class="dtr-control sorting_1" tabindex="0">{{$donationRreqest->city->name}}</td>
                                                        <td class="dtr-control sorting_1" tabindex="0">{{$donationRreqest->patient_phone}}</td>
                                                        <td class="dtr-control sorting_1" tabindex="0">{{$donationRreqest->client->name}}</td>
                                                        @can('donation-request-show')
                                                        <td>
                                                            <a href="{{route("donation-requests.show",$donationRreqest->id)}}" class="btn btn-sm btn-secondary mx-1" title="Show"><i class="fas fa-eye"></i></a>
                                                        </td>
                                                        @endcan
                                                        @can('donation-request-delete')
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-{{$donationRreqest->id}}">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                                <!-- Delete modal start -->
                                                                <form action="{{route('donation-requests.destroy',$donationRreqest->id)}}" method="POST">
                                                                    <div class="modal fade" id="delete-{{$donationRreqest->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Donation Request</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Are your sure you want to delete donationRreqest:{{$donationRreqest->name}}?</p>

                                                                                    @csrf
                                                                                    {{method_field('delete')}}
                                                                                    <input type="hidden" value="{{$donationRreqest->id}}" name="id">
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
                                                    <th rowspan="1" colspan="1">Patient Name</th>
                                                    <th rowspan="1" colspan="1">age</th>
                                                    <th rowspan="1" colspan="1">Blood Type</th>
                                                    <th rowspan="1" colspan="1">No. of Bags</th>
                                                    <th rowspan="1" colspan="1">Hospital</th>
                                                    <th rowspan="1" colspan="1">City</th>
                                                    <th rowspan="1" colspan="1">Patient Phone</th>
                                                    <th rowspan="1" colspan="1">Client</th>
                                                    @can('client-show')
                                                        <th rowspan="1" colspan="1">Show</th>
                                                    @endcan
                                                    @can('client-delete')
                                                        <th rowspan="1" colspan="1">Delete</th>
                                                    @endcan
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