<div class="campaignurl hide">
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
            <input class="form-control image-campaign" name="{{ !empty($name)?$name:''}}" data-value="{{ !empty($name)?$name:''}}" type="file" accept="image/gif, image/jpeg,image/jpg,image/png" id="inputIMG-{{$number}}" data-id="{{$number}}">
            @if(!empty($name))
                <input type="hidden" name="delete[{{$name}}]" id="del-{{$number}}" disabled>
            @endif
            <span class="image-upload-label">@lang('label.uploadImageInstruction')</span>
            <div class="image-preview-area">
                <div id="thumbnail_image_preview" class="image-preview">
                    {{-- <img id="img-{{$number}}" class="img-preview" src="{{ !empty($img)?asset($img):asset('img/no-image/no-image.png')}}" alt="" data-toggle="modal" data-target="#imgpreview"> --}}
                    @if ($img != 'img/no-image/no-image.png')
                        <img id="img-{{$number}}" class="img-preview" src="{{ asset($img) }}" alt="" data-toggle="modal" data-target="#imgpreview">
                    @else
                        <img id="img-{{$number}}" class="img-preview" src="{{ asset('img/no-image/no-image.png') }}">
                    @endif
                </div>
                {{-- only news has main image, add css class "show" --}}
                    <p class="delete-image-preview {{ !empty($img)?!($img=='img/no-image/no-image.png')?'show':'':''}}"  data-id="{{$number}}" id="closeIMG-{{$number}}" >
                        <i class="fa fa-window-close"></i>
                    </p>
                {{-- delete flag for already uploaded image in the server --}}
            </div>
            {{ $slot }}
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
            @if( $isRequired == 1 )
                <span class="label label-danger label-required">@lang('label.required')</span>
            @else
                <span class="label label-success label-required">@lang('label.optional')</span>
            @endif
            <strong class="field-title">URL {{$number+1}}</strong>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
            <input placeholder="Enter Destionation URL" id="input-{{$number}}"  class="form-control input-url " data-prompt-position="bottomLeft:0,11" data-value="{{ !empty($name)?$name:''}}" name="{{ !empty($name)?$name:''}}" {{ empty($name)?'disabled':''}} value="{{ !empty($urlImages)?$urlImages:''}}" type="text">
        </div>
    </div>
</div>
