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
    <th id="title">@lang('label.title')</th>
    <th id="body">@lang('label.body')</th>
    <th id="image">@lang('label.image')</th>
    <th id="publish_date">@lang('label.publish_date')</th>
    <th id="status">@lang('label.status')</th>
@endsection
