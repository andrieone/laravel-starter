@extends('backend._base.content_datatables')

@section('breadcrumbs')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fas fa-tachometer-alt"></i> @lang('label.dashboard')</a></li>
        <li class="breadcrumb-item active">{{ $page_title }}</li>
    </ol>
@endsection

@section('top_buttons')
    <a href="{{ route('admin.news.create') }}" class="btn btn-info">@lang(('label.createNew'))</a>
@endsection

@section('content')
    <th id="id">ID</th>
    <th id="display_name">@lang('label.admin_id')</th>
    <th id="activity">@lang('label.activity')</th>
    <th id="detail">@lang('label.detail')</th>
    <th id="ip">@lang('label.ip')</th>
    <th id="access_time">@lang('label.access_time')</th>
    <th id="hide_action"></th>
@endsection
