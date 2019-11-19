@extends('layouts.backend')

@section('content')
    <!-- Content Header (Page header) -->
    @component('backend._components._breadcrumbs')
        @slot('page_title')
            {{$page_title}}
        @endslot
    @endcomponent
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{ Form::open(array('route' => $form_action, 'method' => 'POST', 'files' => false, 'id' => 'admin-form')) }}
                        {{ $page_type == 'create' ? '' : method_field('PUT') }}
                        <div class="card-body">

                            <div id="form-display_name" class="row form-group">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                    <span class="bg-danger label-required">@lang('label.required')</span>
                                    <strong class="field-title">@lang('label.name')</strong>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                                    {{ Form::text('display_name', $item->display_name, array('placeholder' => '', 'class' => 'form-control')) }}
                                </div>
                            </div>

                            <div id="form-email" class="row form-group">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                    <span class="bg-danger label-required">@lang('label.required')</span>
                                    <strong class="field-title">@lang('label.email')</strong>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                                    {{ Form::text('email', $item->email, array('placeholder' => 'tarou@tarou.com', 'class' => 'form-control')) }}
                                </div>
                            </div>

                            @if ($page_type == "create")
                                <div id="form-password" class="row form-group">
                                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                        <span class="bg-danger label-required">@lang('label.required')</span>
                                        <i class="fa fa-question-circle tooltip-img" data-toggle="tooltip" data-placement="right" title="@lang('label.choosePasswordLength')"></i>
                                        <strong class="field-title">@lang('label.password')</strong>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                                        {{ Form::password('password', array('placeholder' => ' ', 'class' => 'form-control')) }}
                                    </div>
                                </div>
                                {{-- case of update --}}
                            @else
                                <div id="form-password" class="row form-group">
                                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                        <span class="bg-danger label-required">@lang('label.required')</span>
                                        <i class="fa fa-question-circle tooltip-img" data-toggle="tooltip" data-placement="right" title="@lang('label.updatePasswordSentence')"></i>
                                        <strong class="field-title">@lang('label.password')</strong>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1 col-content">
                                        <button type="button" name="reset" id="reset-button" class="btn btn-info">@lang('label.change')</button>
                                    </div>
                                    <div id="reset-field" class="col-xs-10 col-sm-10 col-md-8 col-lg-9 col-content d-none">
                                        {{ Form::password('password', array('id' => 'password', 'placeholder' => __('label.newPassword'), 'class' => 'form-control')) }}
                                        <label for="show-password">
                                            <input id="show-password" type="checkbox" name="show-password" value="1">
                                            <span>@lang('label.showPassword')</span>
                                        </label>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-info">
                                <i class="fas fa-save"></i> {{ $page_type == 'create' ? __('label.register') : __('label.update')  }}
                            </button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Main content -->
@endsection

@section('js')
    <script>
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

        // init: side menu for current page
        $('li#admins').addClass('menu-open');
        $('.menu-open a').addClass('active');
        $('li#admins').find('.nav-treeview').find('#list_admin a').removeClass('active');
    </script>
@endsection
