<div class="form-group">
  <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
    @if( $isRequired == 1 )
        <span class="label label-danger label-required">@lang('label.required')</span>
    @else
        <span class="label label-success label-required">@lang('label.optional')</span>
    @endif
    <strong class="field-title">{{ $label }}</strong>
  </div>
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
      <div class="input-group">
        <input name="icon" data-placement="bottomLeft" class="form-control icp icp-auto" value="{{ $data }}"
               type="text"/>
        <span class="input-group-addon"></span>
      </div>
    </div>
</div>
