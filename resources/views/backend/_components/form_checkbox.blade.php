<div class="form-group">
    <div class="col-xs-12 col-md-3 col-lg-2 col-header">
        @if( $isRequired == 1 )
            <span class="label label-danger label-required">@lang('label.required')</span>
        @else
            <span class="label label-success label-required">@lang('label.optional')</span>
        @endif
        <strong class="field-title">{{ $label }}</strong>
    </div>
    <div class="col-xs-12 col-md-9 col-lg-10 col-content">
        @php
            $id = isset( $id ) ? $id : 'check-'.$name;
            $text = isset( $text ) ? $text : false;
            $checked = isset( $checked ) && $checked;
            $disabled = isset( $disabled ) && $disabled;

            $attrName = isset( $name ) ? ' name="'.$name.'"' : '';
            $attrClass = isset( $class ) ? ' class="'.$class.'"' : '';
            $attrValue = isset( $value ) ? ' value="'.$value.'"' : '';
            $attrChecked = $checked ? ' checked': '';
            $attrDisabled = $disabled ? ' disabled': '';

            $attrs = $attrName.$attrClass.$attrValue.$attrChecked.$attrDisabled;
        @endphp
        <input type="checkbox" id="{{ $id }}" {!! $attrs !!} />
        @if( $text )
            @php
                $class = 'no-select';
                $class .= $disabled ? ' muted' : '';
            @endphp
            <label class="{{ $class }}" for="{{ $id }}">{{ $text }}</label>
        @endif
    </div>
</div>
