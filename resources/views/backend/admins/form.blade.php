@extends('backend._base.form')

@section('form_header')
    <section class="content-header">
        <h1>{{ $page_title or '' }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.admins.index') }}"><i class="fa fa-dashboard"></i> @lang('label.home')</a></li>
            @if(Auth::user()->admin_role_id!=1)
                <li><a href="{{ route('admin.admins.edit', Auth::user()->id) }}"><i class="fa fa-dashboard"></i> @lang('label.officeAdmin')</a></li>
            @else
                <li><a href="{{ route('admin.admins.index') }}"><i class="fa fa-dashboard"></i> @lang('label.officeAdmin')</a></li>
            @endif
            <li class="active">@if ($page_type == 'create') @lang('label.createNew') @else @lang('label.edit') @endif</li>
        </ol>
    </section>
@endsection

@section('form_header_right')
    <div class="box-header">
        <h3 class="box-title">@if ($page_type == 'create') @lang('label.createNew') @else @lang('label.edit') @endif</h3>
        @if(Auth::user()->admin_role_id == 1)
        <a class="btn btn-primary pull-right" href="{{ route('admin.admins.index') }}"><i class="far fa-angle-left"></i> @lang('label.back')</a>
        @endif
    </div>
@endsection


@section('form_content')
    {{ Form::open(array('route' => $form_action, 'method' => 'POST', 'files' => false, 'id' => 'admin-form')) }}
    {{ $page_type == 'create' ? '' : method_field('PUT') }}

    <div id="form-office" class="form-group">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
            @if( Auth::user()->admin_role_id != 2 )
                <span class="label label-danger label-required">@lang('label.required')</span>
            @endif
            <strong class="field-title">@lang('label.office')</strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
            @if(Auth::user()->admin_role_id == 1)
                {{ Form::select('office_id', $offices, !empty($item->office->id)?$item->office->id:1, array('class' => 'form-control validate[required]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
            @else
                <strong>{{ $item->office->name or 'Not set, please contact super administrator' }}</strong>
            @endif

        </div>
    </div>

    <div id="form-display_name" class="form-group">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
            <span class="label label-danger label-required">@lang('label.required')</span>
            <strong class="field-title">Name</strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
            {{ Form::text('display_name', $item->display_name, array('placeholder' => '', 'class' => 'form-control validate[required, maxSize[100]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
        </div>
    </div>

    <div id="form-email" class="form-group">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
            <span class="label label-danger label-required">@lang('label.required')</span>
            <strong class="field-title">Email Address</strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
            {{ Form::text('email', $item->email, array('placeholder' => 'yamada.tarou@wendy.com', 'class' => 'form-control validate[required, custom[email]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
        </div>
    </div>

    @if ($page_type == "create")
        <div id="form-password" class="form-group">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                <span class="label label-danger label-required">@lang('label.required')</span>
                <i class="fa fa-question-circle tooltip-img" data-toggle="tooltip"
                    data-placement="right" title="Please choose a password with a minimum length of 8 characters."></i>
                <strong class="field-title">Password</strong>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                {{ Form::password('password', array('placeholder' => ' ', 'class' => 'form-control validate[required, minSize[8], maxSize[255]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
            </div>
        </div>
        {{-- case of update --}}
    @else
        <div id="form-password" class="form-group">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                <span class="label label-danger label-required">@lang('label.required')</span>
                <i class="fa fa-question-circle tooltip-img" data-toggle="tooltip"
                    data-placement="right" title="Click change button when you wish to update your password."></i>
                <strong class="field-title">Password</strong>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1 col-content">
                <button type="button" name="reset" id="reset-button" class="btn btn-primary">Change</button>
            </div>
            <div id="reset-field" class="col-xs-10 col-sm-10 col-md-8 col-lg-9 col-content hide">
                {{ Form::password('password', array('id' => 'password', 'placeholder' => 'Enter new password to update your old password', 'class' => 'form-control validate[minSize[8], maxSize[255]]', 'style' => 'margin-top:5px')) }}
                <label for="show-password">
                    <input id="show-password" type="checkbox" name="show-password" value="1">&nbsp;
                    <span>Show password</span>
                </label>
            </div>
        </div>
    @endif



    <div id="form-button" class="form-group no-border">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top: 20px;">
            <button type="submit" name="submit" id="send" class="btn btn-primary"><i class="fal fa-save"></i> {{ $page_type == 'create' ? __('label.register') : __('label.update')  }}</button>
        </div>
    </div>
    {{ Form::close() }}
@endsection
