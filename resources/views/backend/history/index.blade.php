@extends('layouts.backend')

@section('content')
    <!-- Content Header (Page header) -->
    @breadcrumbs()
    @slot('page_title')
        {{$page_title}}
    @endslot
    @endbreadcrumbs
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{--Header--}}
                    <div class="card-header">
                        <div class="row mb-2">
                            <div class="col-sm-12 col-sm-6">
                                <h3 class="card-title">@lang('label.list')</h3>
                            </div>
                            {{--<div class="col-sm-12 col-sm-6">--}}
                            {{--    <a href="{{route('admin.admins.create')}}" class="btn btn-info float-sm-right">@lang('label.createNew')</a>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- .card-body -->
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
                                            <th rowspan="2" class="text-center align-middle">@lang('label.action')</th>
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
            // input fields in datatable
            $('#history thead tr').clone(true).appendTo('#history thead');
            $('#history thead tr:eq(1) th').each(function (i) {
                let title = $(this).text();
                let attr = $(this).attr('rowspan');
                if (typeof attr !== typeof undefined && attr !== false) {
                    $(this).remove();
                }
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

            // datatable setting
            let table = $('#history').DataTable({
                "order": [[0, "desc"]],
                "processing": true,
                "serverSide": true,
                "orderCellsTop": true,
                "fixedHeader": true,
                "paging": true,
                "lengthChange": true,
                "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "@lang('label.all')"]],
                "searching": true,
                "ordering": true,
                "info": true,
                "scrollX": true,
                "autoWidth": true,
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
                "language": {
                    "url": "{{asset('js/backend/adminlte/Japanese.json')}}"
                }
            });
        });

        // delete button in datatable for initiation is in controllers
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

        //side nav menu for current page
        $('li#menu-login-histories').find('a').addClass('active');
    </script>
@endsection
