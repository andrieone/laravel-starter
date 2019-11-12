@extends('backend._base.listing_tabulator')

@section('listing_tabulator_header')
    <h1>Super Admin</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> @lang('label.home')</a></li>
        <li class="active">Super Admin</li>
    </ol>
@endsection

{{--@section('listing_tabulator_create_link')
@if(Auth::user()->admin_role_id == 1)
    <a id="btn-add" class="btn btn-primary pull-right" href="{{ route('admin.admins.create') }}">@lang('label.createNew')</a>
@endif
@endsection--}}

{{--@section('listing_tabulator_delete_route')
    {{ route('admin.admins.destroy', 0) }}
@endsection--}}

@section('js-scripts')
    <script type="text/javascript">
        window.column = [
            {title: "ID", field: "id", width: 45, headerFilter: "input", sorter: "number", headerFilterPlaceholder: " "},
            {title: "@lang('label.name')", minWidth: 161, field: "name", headerFilter: "input", headerFilterPlaceholder: " "},
            {title: "@lang('label.role')", minWidth: 161, field: "admin_role.name", headerFilter: false, headerSort:false, headerFilterPlaceholder: " "},
            {title: "@lang('label.email')", minWidth: 161, field: "email", headerFilter: "input", headerFilterPlaceholder: " "},
            {title: "@lang('label.createdAt')", minWidth: 161, field: "created_at", headerFilter: "input", headerFilterPlaceholder: " ", sorter: "string"},
            {title: "@lang('label.updatedAt')", minWidth: 164, field: "updated_at", headerFilter: "input", headerFilterPlaceholder: " ", sorter: "string"},
        ];
    </script>
@endsection
