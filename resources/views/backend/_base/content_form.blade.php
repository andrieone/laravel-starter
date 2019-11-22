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
                                    @if ($page_type == "create")
                                        <h3 class="card-title">@lang('label.add')</h3>
                                    @else
                                        <h3 class="card-title">@lang('label.edit')</h3>
                                    @endif
                                </div>
                                <div class="col-sm-6 card-header-link">
                                    @yield('top_buttons')
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    @yield('content')
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
    <script src="{{asset('plugins/parsley/parsley.min.js')}}"></script>
    <script src="{{asset('plugins/parsley/i18n/ja.js')}}"></script>
    <script>
        $(function () {
            // init: show tooltip on hover
            $('[data-toggle="tooltip"]').tooltip({
                container: 'body'
            });

            // show password field only after 'change password' is clicked
            $('#reset-button').click(function (e) {
                $('#reset-field').removeClass('d-none');
                $('#show-password-check').removeClass('d-none');
                // to always uncheck the checkbox after button click
                $('#show-password').prop('checked', false);
            });

            // toggle password in plaintext if checkbox is selected
            $("#show-password").click(function () {
                $(this).is(":checked") ? $("#id-password").prop("type", "text") : $("#id-password").prop("type", "password");
            });

            $('[data-parsley]').parsley({
                uiEnabled: true,
                errorClass: 'is-invalid',
                successClass: 'is-valid'
            })
        });
    </script>
@endpush
