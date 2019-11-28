@extends('backend._base.content_form')

@section('breadcrumbs')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fas fa-tachometer-alt"></i> @lang('label.dashboard')</a></li>
        <li class="breadcrumb-item active">{{ $page_title }}</li>
    </ol>
@endsection

@section('top_buttons')
    @if ($page_type == "create")
        <a href="{{route('admin.company.index')}}" class="btn btn-info float-sm-right">@lang('label.list')</a>
    @else
        <a href="{{route('admin.company.create')}}" class="btn btn-info float-sm-right">@lang('label.createNew')</a>
        <a href="{{route('admin.company.index')}}" class="btn btn-info float-sm-right">@lang('label.list')</a>
    @endif
@endsection

@section('content')
    @component('backend._components.form_container', ["action" => $form_action, "page_type" => $page_type, "files" => false])
        @component('backend._components.input_text', ['name' => 'company_name', 'label' => __('label.company_name'), 'required' => 1, 'value' => $item->company_name]) @endcomponent
        @component('backend._components.input_text', ['name' => 'post_code', 'label' => __('label.post_code'), 'required' => 1, 'value' => $item->post_code]) @endcomponent
        @component('backend._components.input_text', ['name' => 'address', 'label' => __('label.address'), 'required' => 1, 'value' => $item->address]) @endcomponent
        @component('backend._components.input_text', ['name' => 'phone', 'label' => __('label.phone'), 'required' => 1, 'value' => $item->phone]) @endcomponent

        @component('backend._components.input_buttons', ['page_type' => $page_type])@endcomponent
    @endcomponent
@endsection
