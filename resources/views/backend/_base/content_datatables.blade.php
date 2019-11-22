@extends("backend._base.app")

@section("content-wrapper")
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark h1title">{{$page_title}}</h1>
                </div>
                <div class="col-sm-6 text-sm">
                    @yield("breadcrumbs")
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row mb-2">
                                <div class="col-sm-6 card-title">
                                    <h3 class="card-title">@lang('label.list')</h3>
                                </div>
                                <div class="col-sm-6 card-header-link">
                                    @yield('top_buttons')
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="datatable" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="width:100%">
                                        <thead>
                                        <tr>
                                            @yield('content')
                                            <th rowspan="2" class="text-center align-middle actionDatatables">@lang('label.action')</th>
                                        </tr>
                                        </thead>
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
    <script>
        $(function () {
            var column = [];
            // COLUMN SEARCH
            $('#datatable thead tr').clone(true).appendTo('#datatable thead');
            $('#datatable thead tr:eq(1) th').each(function (i) {
                if( $(this).attr("id") ){
                    var id = $(this).attr("id");
                    column.push({data: id, name: id})
                }

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
            column.push({data: 'action', name: 'action', orderable: false, searchable: false});

            // DATATABLE SETUP
            let table = $('#datatable').DataTable({
                "order": [[0, "desc"]],
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
                "serverSide": true,
                "processing": true,
                "responsive": true,
                "ajax": "{{ url()->current() . "/json" }}",
                "columnDefs": [
                    {"width": "10px", "targets": 0},
                ],
                "columns": column,
                "language": {
                    "url": "{{asset('js/backend/adminlte/Japanese.json')}}"
                }
            });


            // DELETE
            $('#datatable').on('click', '.deleteData[data-remote]', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let url = $(this).data('remote');
                // CONFIRMATION
                if (confirm('@lang('label.jsConfirmDeleteData')')) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {method: 'DELETE', submit: true}
                    }).always(function (data) {
                        $('#datatable').DataTable().draw(false);
                        toastr.success('@lang('label.jsInfoDeletedData')');
                    });
                } else
                    toastr.error('@lang('label.jsSorry')');
            });

        });
    </script>
@endpush
