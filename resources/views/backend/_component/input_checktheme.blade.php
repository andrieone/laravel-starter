<div id="parent" class="form-group">
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
        @if( $isRequired == 1 )
            <span class="label label-danger label-required">@lang('label.required')</span>
        @else
            <span class="label label-success label-required">@lang('label.optional')</span>
        @endif
        <strong class="field-title">Theme {{ $number+1  }}</strong>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content" data-sub="subparent{{ $number }}">
        {{ $slot }}
    </div>
</div>
<div class="subparent{{ $number }} {{ $all_sub->count() > 0 ? '' : 'hide' }}">
    <div class="form-group no-border">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
            <span class="label label-success label-required">@lang('label.optional')</span>
            <strong class="field-title">@lang('label.subparent') {{ $number+1  }}</strong>
        </div>
        <div id="dataCheckbox{{ $number }}" class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content checkbox">
            @if( $all_sub->count() > 0 )
                @foreach( $all_sub as $subs )
                    @php
                        $unslug = ucwords( str_replace( '-', ' ', $subs->slug ));
                        $inArray = in_array( $subs->id, array_column( $data_sub, 'themes_id')) ? true : false;
                    @endphp
                    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3 choice">
                        {{-- {{Form::hidden('themes_old['.$number.'][subparent][]', $subs->id)}} --}}
                        {{
                            Form::checkbox(
                                "themes[".$number."][subparent][]",
                                $subs->id, $inArray,
                                array( 'id' => "theme-$subs->slug-$subs->id" )
                            )
                        }} {{
                            Form::label( "theme-$subs->slug-$subs->id", $unslug, array(
                                'title' => $subs->label
                            ))
                        }}
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
