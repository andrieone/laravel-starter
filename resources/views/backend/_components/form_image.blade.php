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

        <input name="{{ $name }}" type="file" accept="image/gif,image/jpeg,image/jpg,image/png" class="{{ isset( $class ) ? $class : '' }}"
        data-prompt-position="bottomLeft:0,11">

        <input type="hidden" name="{{ $name }}_check" value="{{ !empty($image) ? "filled" : "empty" }}">
        <input type="hidden" name="delete_check" value="false">

        <div class="image-upload-label" style="margin-top:25px">
            <span>{{(!isset($max_upload))?__('label.uploadImageInstruction'):"Please upload an image file (maximum size of 10MB)"}}</span>
        </div>

        <div class="image-preview-area">
            <div id="thumbnail_image_preview" class="image-preview">
                @if (!empty($image))
                    @if (isset($deletable) && $deletable)
                        <p class="delete-image-preview show" data-filename="{{ $image }}"><i class="fa fa-window-close"></i></p>
                    @endif
                    <img src="{{ asset($image) }}" data-placeholder="{{ asset('img/no-image/no-image.png') }}" alt=""
                        data-toggle="modal" data-target="#imgpreview">
                @else
                    <img src="{{ asset('img/no-image/no-image.png') }}" alt=""
                        data-placeholder="{{ asset('img/no-image/no-image.png') }}">
                @endif
            </div>
        </div>

        {{ $slot }}

    </div>
</div>
