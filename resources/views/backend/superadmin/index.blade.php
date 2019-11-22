@extends('backend._base.content_datatables')

@section('breadcrumbs')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fas fa-tachometer-alt"></i> @lang('label.dashboard')</a></li>
        <li class="breadcrumb-item active">{{ $page_title }}</li>
    </ol>
@endsection

@section('top_buttons')
    <a href="{{ route('admin.superadmin.create') }}" class="btn btn-info">@lang(('label.createNew'))</a>
@endsection

@section('content')
    <th id="id">ID</th>
    <th id="display_name">@lang('label.name')</th>
    <th id="email">@lang('label.email')</th>
    <th id="created_at">@lang('label.created_at')</th>
    <th id="updated_at">@lang('label.update_at')</th>
@endsection
