<div class="divBanner">
  <div style="margin-top:2.5em;">
    <h3 style="display: inline-block;font-size: 18px;margin: 0;line-height: 1;color:#444">Ads Banner</h3>
  </div>
    @php $number = 0; @endphp
    @forelse( $banners as $id => $banner )
        @php $number++ @endphp
        <div id="banner{{ $number }}" class="form-group">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                <span class="label label-success label-required">@lang("label.optional")</span>
                <strong class="field-title">Banner {{ $number }}</strong>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                <input id="{{ $number }}" name="banner[{{ $id }}]" type="file" accept="image/gif, image/jpeg,image/jpg,image/png" class="form-control inputIMG">
                <input id="{{ $id }}" class="ifupdate" name="updated[{{ $id }}]" type="hidden" value="still">
                <span class="image-upload-label">@lang("label.banner_upload")</span>

                <div class="image-preview-area">
                    <div id="thumbnail_image_preview" class="image-preview">
                        <img class="img-preview{{ $number }}" src="{{ asset('images/brands') }}/{{ $banner['image']}}" data-image="{{ asset('images/brands') }}/{{ $banner['image'] }}" data-name="{{ $banner['image'] }}" alt="" data-toggle="modal" data-target="#imgpreview">
                    </div>
                    {{-- only news has main image, add css class "show" --}}
                    <p class="delete-image-preview show" data-id="{{ $id }}" data-filename="{{ $banner['image'] }}"
                    ><i class="fa fa-window-close"></i></p>
                    {{-- delete flag for already uploaded image in the server --}}
                </div>
                {{ $slot }}
                <hr>

                <input id="url-banner{{ $number }}" class="form-control validate[custom[url], maxSize[255]]]"
                    data-prompt-position="bottomLeft:0,11" name="url[{{ $id }}]" type="text"
                    placeholder="Enter Destination URL" value="{{ $banner['url'] }}">
            </div>
        </div>
        @if( $loop->last )
            @for( $index = $loop->count+1; $index <= 10; $index++ )
                <div id="banner{{ $index }}" class="form-group">
                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                        <span class="label label-success label-required">@lang("label.optional")</span>
                        <strong class="field-title">Banner {{ $index }}</strong>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                        <input id="{{ $index }}" name="banner[]" type="file" accept="image/gif, image/jpeg,image/jpg,image/png" class="form-control inputIMG">
                        <input id="{{ $id }}" class="ifinsert" name="updated[]" type="hidden" value="still">
                        <span class="image-upload-label">@lang("label.banner_upload")</span>
                        <div class="image-preview-area">
                            <div id="thumbnail_image_preview" class="image-preview">
                                <img class="img-preview{{ $index }}" src="{{ asset('img/no-image/no-image.png') }}" alt="">
                            </div>
                        </div>
                        <hr>
                        <input class="form-control validate[custom[url], maxSize[255]]]" data-prompt-position="bottomLeft:0,11" name="url[]" type="text" placeholder="Enter Destination URL">
                        {{ $slot }}
                    </div>
                </div>
            @endfor
        @endif
    @empty
        @for( $index = 1; $index <= 10; $index++ )
            <div id="banner{{ $index }}" class="form-group">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                    <span class="label label-success label-required">@lang("label.optional")</span>
                    <strong class="field-title">Banner {{ $index }}</strong>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                    <input id="{{ $index }}" name="banner[]" type="file" accept="image/gif, image/jpeg,image/jpg,image/png" class="form-control inputIMG">
                    <span class="image-upload-label">@lang("label.banner_upload")</span>
                    <div class="image-preview-area">
                        <div id="thumbnail_image_preview" class="image-preview">
                            <img class="img-preview{{ $index }}" src="{{ asset('img/no-image/no-image.png') }}" alt="" data-toggle="modal" data-target="#imgpreviews">
                        </div>
                    </div>
                    <hr>
                    <input class="form-control validate[custom[url], maxSize[255]]]" data-prompt-position="bottomLeft:0,11" name="url[]" type="text" placeholder="Enter Destination URL">
                    {{ $slot }}
                </div>
            </div>
        @endfor
    @endforelse
</div>
