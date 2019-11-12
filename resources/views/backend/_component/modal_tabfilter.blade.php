
{{-- -------------------------------------------------------------------- --}}
@php
    $btnLabel = isset( $label ) ? $label : '表示項目の切替';
    $cookie = isset( $cookie ) ? $cookie : false;
    $attrCookie = $cookie ? ' data-cookie-id="'.$cookie.'"' : '';
    $attrs = $attrCookie;
@endphp
{{-- -------------------------------------------------------------------- --}}

{{-- -------------------------------------------------------------------- --}}
{{-- Tabulator filter button --}}
{{-- -------------------------------------------------------------------- --}}
<button id="btn-col-tabulator" type="button" class="btn btn-default pull-right"
    data-toggle="modal" data-target="#modal-col-tabulator">
    <i class="fas fa-eye"></i> <span>{{ $btnLabel }}</span>
</button>
{{-- -------------------------------------------------------------------- --}}


{{-- -------------------------------------------------------------------- --}}
{{-- Filter modal --}}
{{-- -------------------------------------------------------------------- --}}
<div id="modal-col-tabulator" class="modal" {!! $attrs !!}>
    <div class="modal-dialog">
        <div class="modal-content modal-col-tabulator-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            @if( isset( $columns ) && count( $columns ))
                <div class="modal-body">
                    <div class="row checkbox">
                        @foreach( $columns as $index => $entry )
                            <div class="col-xs-12 col-sm-4 col-md-4">
                                @php
                                    // --------------------------------------
                                    $entry = (object) $entry;
                                    // --------------------------------------
                                    $cols = $entry->columns;
                                    if( !is_array( $cols )) $cols = array( $cols );
                                    // --------------------------------------
                                    $label = $entry->label;
                                    $identifier = $index +1;
                                    // --------------------------------------
                                    $checked = !( isset( $entry->hidden ) && $entry->hidden );
                                    $attrChecked = $checked ? ' checked="checked"' : '';
                                    // --------------------------------------
                                    $attrID = ' data-column-id="'.$entry->id.'"';
                                    $attrs = $attrID.$attrChecked;
                                    // --------------------------------------
                                @endphp
                                <input id="check-column-{{ $identifier }}" class="col-choose" type="checkbox"
                                    value="{{ json_encode( $cols )}}" {!! $attrs !!}>
                                <label for="check-column-{{ $identifier }}">{{ $label }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
{{-- -------------------------------------------------------------------- --}}
