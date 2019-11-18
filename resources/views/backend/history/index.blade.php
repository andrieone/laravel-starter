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
                <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="history" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="history" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>@lang('label.admins_id')</th>
                                            <th>@lang('label.activity')</th>
                                            <th>@lang('label.detail')</th>
                                            <th>@lang('label.ip')</th>
                                            <th>@lang('label.last_access')</th>
                                            <th>@lang('label.action')</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>@lang('label.admins_id')</th>
                                            <th>@lang('label.activity')</th>
                                            <th>@lang('label.detail')</th>
                                            <th>@lang('label.ip')</th>
                                            <th>@lang('label.last_access')</th>
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
            $('#history thead tr').clone(true).appendTo('#history thead');
            $('#history thead tr:eq(1) th').each(function (i) {
                let title = $(this).text();

                if (title == "Action") {
                    $(this).html("");
                } else {
                    $(this).html('<input class="form-control" type="text" placeholder="@lang('label.search') ' + title + '" />');
                }

                $('input', this).on('keyup change', function () {
                    if (table.column(i).search() !== this.value) {
                        table.column(i).search(this.value).draw();
                    }
                });
            });

            let table = $('#history').DataTable({
                "processing": true,
                "serverSide": true,
                "orderCellsTop": true,
                "fixedHeader": true,
                "paging": true,
                "lengthChange": true,
                "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
                "searching": true,
                "ordering": true,
                "info": true,
                "scrollX": true,
                "autoWidth": false,
                "ajax": 'history/json',
                "columnDefs": [
                    {"width": "10px", "targets": 0},
                ],
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'admins_id', name: 'admins_id'},
                    {data: 'activity', name: 'activity'},
                    {data: 'detail', name: 'detail'},
                    {data: 'ip', name: 'ip'},
                    {data: 'last_access', name: 'last_access'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
            });
        });

        $('#history').on('click', '.deleteHistory[data-remote]', function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let url = $(this).data('remote');
            // confirm then
            if (confirm('@lang('label.jsConfirmDeleteData')')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {method: 'DELETE', submit: true}
                }).always(function (data) {
                    $('#history').DataTable().draw(false);
                    toastr.success('@lang('label.jsInfoDeletedData')');
                });
            } else
                toastr.error('@lang('label.jsSorry')');
        });
    </script>
@endsection
