<div id="form-group--{{ $name }}" class="row form-group">
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
        @if( !empty($required) && empty($value) )
            <span class="bg-danger label-required">@lang('label.required')</span>
        @else
            <span class="bg-success label-required">@lang('label.optional')</span>
        @endif
        <strong class="field-title">{{ $label  }}</strong>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-content">
        <div class="field-group clearfix @error($name) is-invalid @enderror">
            <input type="file"
                   id="input-{{ $name }}"
                   name="{{ $name }}"
                   accept="image/gif,image/jpeg,image/jpg,image/png"
                   class="@error($name) is-invalid @enderror"
                  {{ !empty($required) && empty($value) ? 'required' : '' }} >

            @if(!empty($value))
                <div id="image-preview-{{$name}}" class="image-preview">
                    <img src="{{ asset($value) }}" class="img-thumbnail">
                </div>
            @endif
        </div>
    </div>
</div>
