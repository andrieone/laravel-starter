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
    @include("backend._includes.alert")
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

        $(function() {
            // enable or disabled filtering server side
            var serverSide = true;
            @hasSection( 'extend-datatable' )
                @yield( 'extend-datatable' )
            @endif

            $("[data-col=action]").attr("rowspan", 2).addClass("text-center align-middle actionDatatables");
            var column = [];
            // COLUMN SEARCH
            $('#datatable thead tr').clone(true).appendTo('#datatable thead');
            $('#datatable thead tr:eq(1) th').each(function (i) {
                var id = $(this).data("col");
                if( id !== "action" ){
                    column.push({data: id, name: id})
                }

                var title = $(this).text();
                var attr = $(this).attr('rowspan');
                var select = $(this).data('select');
                if (typeof attr !== typeof undefined && attr !== false) {
                    $(this).remove();
                }
                var placeholder = "@lang('label.search') " + title;
                if( id === "id" ){
                    placeholder = '';
                }

                if(select != null){
                    var html = '<select class="form-control datatable-search-'+i+'" id="search_'+id+'">';

                    html += '<option value="">'+'-'+'</option>';

                    for(var key in select){
                        var value = select[key];
                        html += '<option value="'+key+'">'+value+'</option>'
                    }

                    html += '</select>';
                    $(this).html(html);

                    $('select', this).on('change', function(){
                        console.log(this.value);
                        if(table.column(i).search() !== this.value){
                            table.column(i).order('desc').search(this.value).draw();
                        }
                    });
                }else{
                    $(this).html('<input class="form-control" type="text" placeholder="' + placeholder + '" />');

                    $('input', this).on('keyup change', function () {
                        if (table.column(i).search() !== this.value) {
                            table.column(i).search(this.value).draw();
                        }
                    });
                }
            });
            if( $("[data-col=action]").length ){
                column.push({data: 'action', name: 'action', orderable: false, searchable: false});
            }

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
                "processing": true,
                "responsive": true,
                "serverSide": serverSide,
                "ajax": "{{ url()->current() . "/json" }}",
                "columnDefs": [
                    {"width": "10px", "targets": 0},
                ],
                "columns": column,
                @if(App::isLocale('jp'))
                "language": {
                    "url": "{{asset('js/backend/adminlte/Japanese.json')}}"
                }
                @endif
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
                        console.log(data);
                        $('#datatable').DataTable().draw(false);
                        toastr.success('@lang('label.jsInfoDeletedData')');
                    });
                } else
                    toastr.error('@lang('label.jsSorry')');
            });
        });
    </script>
@endpush
