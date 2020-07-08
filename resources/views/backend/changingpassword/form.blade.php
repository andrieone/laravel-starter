

    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fas fa-tachometer-alt"></i> @lang('label.dashboard')</a></li>
    
        <li class="breadcrumb-item active">@lang('label.changing_password')</li>
    </ol>


    
  
        <div id="form-group-current-password" class="row form-group">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                <span class="bg-danger label-required">@lang('label.required')</span>
                <i class="fa fa-question-circle tooltip-img" data-toggle="tooltip" data-placement="right" title="@lang('label.explain_current_password')"></i>
                <strong class="field-title">@lang('label.current_password')</strong>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                <input type="password" id="input-current-password" name="current_password" class="form-control @error('password') is-invalid @enderror" required data-parsley-minlength="8"/>
            </div>
        </div>

        <div id="form-group-new-password" class="row form-group">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                <span class="bg-danger label-required">@lang('label.required')</span>
                <i class="fa fa-question-circle tooltip-img" data-toggle="tooltip" data-placement="right" title="@lang('label.choosePasswordLength')"></i>
                <strong class="field-title">@lang('label.new_password')</strong>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                <input type="password" id="input-new-password" name="new_password" class="form-control @error('password') is-invalid @enderror" required data-parsley-minlength="8"/>
            </div>
        </div>

        <div id="form-group-new-password-confirm" class="row form-group">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                <span class="bg-danger label-required">@lang('label.required')</span>
                <strong class="field-title">@lang('label.new_password_confirm')</strong>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                <input type="password" id="input-new-password-confirm" name="new_password_confirm" class="form-control @error('password') is-invalid @enderror" required data-parsley-minlength="8"/>
            </div>
        </div>
        
    
