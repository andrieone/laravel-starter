@extends('backend._base.listing_tabulator')

@section('listing_tabulator_header')
    <h1>{{ $page_title or '' }}</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> @lang('label.home')</a></li>
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> @lang('label.officeAdmin')</a></li>
        <li class="active">@lang('label.list')</li>
    </ol>
@endsection

@section('listing_tabulator_create_link'){{--** Delete this section if you want to remove add link **--}}
@if(Auth::user()->admin_role_id == 1)
    <a id="btn-add" class="btn btn-primary pull-right"
    href="{{ route('admin.admins.create') }}"> <i class="far fa-plus"></i> @lang('label.createNew')</a>
@endif
@component('backend._component.modal_tabfilter')
@slot('label', __('label.switchDisplay'))
@slot('cookie', 'tabulator-office-admin-filter')
@slot('columns', array(
    array( 'id' => 'id',           'columns' => 'id',                 'label' => 'ID' ),
    array( 'id' => 'displayName',  'columns' => 'display_name',       'label' => __( 'label.name' )),
    array( 'id' => 'email',        'columns' => 'email',              'label' => __( 'label.email' )),
    array( 'id' => 'office',       'columns' => 'office.name',        'label' => __( 'label.office' )),
    array( 'id' => 'createdAt',    'columns' => 'created_at',         'label' => __( 'label.createdAt' ), 'hidden' => true),
    array( 'id' => 'updatedAt',    'columns' => 'updated_at',         'label' => __( 'label.updatedAt' ))
))
@endcomponent
@endsection

@section('listing_tabulator_delete_route')
    {{ route('admin.admins.destroy', 0) }}
@endsection

@section('js-extends')
<script>
    var areaFilters = @json($filters->offices);
    var lang = {
        "office"    : "@lang('label.office')",
        "name"      : "@lang('label.name')",
        "email"     : "@lang('label.email')",
        "role"      : "@lang('label.role')",
        "createAt"  : "@lang('label.createdAt')",
        "updatedAt" : "@lang('label.updatedAt')",
        "edit"      : "Edit/Delete"
        }
    var isAdmin     = "{{ Auth::user()->admin_role_id }}";
</script>
<script src="{{ Util::getFileVersionByLastMod('backend/assets/js/admin/admin.js') }}"></script>
<script src="{{ asset('backend/assets/js/tabulator-filter.js') }}"></script>
@endsection
