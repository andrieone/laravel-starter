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
                            <div class="col-sm-12 col-sm-6">
                                <a href="{{route('admin.admins.create')}}" class="btn btn-info float-sm-right">@lang('label.createNew')</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="superadmin" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th class="text-center">@lang('label.name')</th>
                                            <th class="text-center">@lang('label.email')</th>
                                            <th class="text-center">@lang('label.created_at')</th>
                                            <th class="text-center">@lang('label.update_at')</th>
                                            <th rowspan="2" class="text-center align-middle actionDatatables">@lang('label.action')</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th class="text-center">@lang('label.name')</th>
                                            <th class="text-center">@lang('label.email')</th>
                                            <th class="text-center">@lang('label.created_at')</th>
                                            <th class="text-center">@lang('label.update_at')</th>
                                            <th class="text-center">@lang('label.action')</th>
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
            $('#superadmin thead tr').clone(true).appendTo('#superadmin thead');
            $('#superadmin thead tr:eq(1) th').each(function (i) {
                var title = $(this).text();
                var attr = $(this).attr('rowspan');
                if (typeof attr !== typeof undefined && attr !== false) {
                    $(this).remove();
                }
                $(this).html('<input class="form-control" type="text" placeholder="@lang('label.search') ' + title + '" />');

                $('input', this).on('keyup change', function () {
                    if (table.column(i).search() !== this.value) {
                        table.column(i).search(this.value).draw();
                    }
                });
            });

            // datatable setting
            let table = $('#superadmin').DataTable({
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
                "ajax": 'admins/json',
                "columnDefs": [
                    {"width": "10px", "targets": 0},
                ],
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'display_name', name: 'display_name'},
                    {data: 'email', name: 'email'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                "language": {
                    "url": "{{asset('js/backend/adminlte/Japanese.json')}}"
                }
            });
        });

        // delete button in datatable for initiation is in controllers
        $('#superadmin').on('click', '.deleteAdmin[data-remote]', function (e) {
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
                    $('#superadmin').DataTable().draw(false);
                    toastr.success('@lang('label.jsInfoDeletedData')');
                });
            } else
                toastr.error('@lang('label.jsSorry')');
        });

        // init: side menu for current page
        $('li#admins').addClass('menu-open');
        $('.menu-open a').addClass('active');
        $('li#admins').find('.nav-treeview').find('#create_admin a').removeClass('active');

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
