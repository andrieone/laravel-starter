<strong>@isset($label_cache)
<strong>{{ $label_cache }}</strong>
@endisset</strong>
<div class="form-group">
  <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
    @if( $isRequired == 1 )
    <span class="label label-danger label-required">
      @lang('label.required')</span>
      @else
      <span class="label label-success label-required">
        @lang('label.optional')</span>
        @endif
        <strong class="field-title">{{ $label }}</strong>
  </div>
  <div class="col-xs-12 col-sm-12  col-md-10 col-lg-8 col-content">
    {{ $slot }}
  </div>
  <div class="col-xs-12 col-sm-12  col-md-3 col-lg-2 col-content">
    <button type="button" class="btn btn-primary btn-block" id="viewdata" disabled>Clear Cache</button>
  </div>

</div>
