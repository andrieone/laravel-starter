@extends('layouts.backend')

@section('content-page-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{$page_title}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">@lang('label.dashboard')</a></li>
                        <li class="breadcrumb-item active">{{$page_title}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    @yield('content-page-header')
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{--<div class="card-header">--}}
                    {{--    <h3 class="card-title">DataTable with default features</h3>--}}
                    {{--</div>--}}
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="superadmin" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>@lang('label.name')</th>
                                            <th>@lang('label.email')</th>
                                            <th>@lang('label.created_at')</th>
                                            <th>@lang('label.update_at')</th>
                                            <th>@lang('label.action')</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>@lang('label.name')</th>
                                            <th>@lang('label.email')</th>
                                            <th>@lang('label.created_at')</th>
                                            <th>@lang('label.update_at')</th>
                                            <th>@lang('label.action')</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('js')
    <script>
        $(function () {
            $('#superadmin thead tr').clone(true).appendTo( '#superadmin thead' );
            $('#superadmin thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();

                if(title == "Action"){
                    $(this).html("");
                } else {
                    $(this).html( '<input class="form-control" type="text" placeholder="Search '+title+'" />' );
                }

                $( 'input', this ).on( 'keyup change', function () {
                    if ( table.column(i).search() !== this.value ) {
                        table.column(i).search( this.value ).draw();
                    }
                } );
            } );

            var table = $('#superadmin').DataTable({
                "processing": true,
                "serverSide": true,
                "orderCellsTop": true,
                "fixedHeader": true,
                "paging": true,
                "lengthChange": true,
                "lengthMenu": [ [25, 50, 100, -1], [25, 50, 100, "All"] ],
                "searching": true,
                "ordering": true,
                "info": true,
                "scrollX": true,
                "autoWidth": false,
                "ajax": 'superadmin/json',
                "columnDefs": [
                    { "width": "10px", "targets": 0 },
                ],
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'display_name', name: 'display_name'},
                    {data: 'email', name: 'email'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
            });
        });

        $(function () {
            @if ($message = Session::get('success'))
            toastr.success('{{ $message }}');
            @endif
            @if ($errors->any())
            toastr.error('@foreach ($errors->all() as $error)' +
                '<p>{{ $error }}</p>' +
                '@endforeach');
            @endif
        });
    </script>
@endsection
