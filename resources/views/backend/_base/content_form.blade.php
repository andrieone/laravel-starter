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

@push('css')
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endpush

@push('scripts')
    <script src="{{asset('plugins/parsley/parsley.min.js')}}"></script>
    <script src="{{asset('plugins/parsley/i18n/ja.js')}}"></script>
    <script src="{{asset('plugins/summernote/summernote.js')}}"></script>
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
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
                $("#input-password").prop("type", "password");
                $("#input-password").val('');
            });

            // toggle password in plaintext if checkbox is selected
            $("#show-password").click(function () {
                $(this).is(":checked") ? $("#input-password").prop("type", "text") : $("#input-password").prop("type", "password");
            });

            $('[data-parsley]').parsley({
                uiEnabled: true,
                errorClass: 'is-invalid',
                successClass: 'is-valid'
            })

            $('.text-editor').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['table', 'link', 'hr']],
                    ['misc', ['fullscreen', 'codeview', 'undo', 'redo']]
                ],
                height: 200
            });

            $('.input-datepicker').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'YYYY-M-D'
                }
            });

            $("body").on('change', '.input-image', function() {
                input = this;
                var img = $(input).closest('.field-group').find('img');
                var input_remove = $(input).closest('.field-group').find('.input-remove-image');
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        img.attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                } else {
                    img.attr('src', img.data('default'));
                    input_remove.val('false');
                }
            });

            $('body').on('click', '.remove-image', function(){
                var img = $(this).closest('.field-group').find('img');

                $(this).closest('.field-group').find('.input-image').val('');
                $(this).closest('.image-preview').find('.input-remove-image').val( 'true' );
                img.attr('src', img.data('empty'));
            })
        });
    </script>
@endpush
