@extends('backend._base.content_form')

@section('breadcrumbs')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fas fa-tachometer-alt"></i> @lang('label.dashboard')</a></li>
        <li class="breadcrumb-item active">{{ $page_title }}</li>
    </ol>
@endsection

@section('top_buttons')
    @if ($page_type == "create")
        <a href="{{route('admin.news.index')}}" class="btn btn-info float-sm-right">@lang('label.list')</a>
    @else
        <a href="{{route('admin.news.create')}}" class="btn btn-info float-sm-right">@lang('label.createNew')</a>
        <a href="{{route('admin.news.index')}}" class="btn btn-info float-sm-right">@lang('label.list')</a>
    @endif
@endsection

@section('content')
    @component('backend._components.form_container', ["action" => $form_action, "page_type" => $page_type, "files" => true])
        @component('backend._components.input_text', ['name' => 'title', 'label' => __('label.title'), 'required' => 1, 'value' => $item->title]) @endcomponent
        @component('backend._components.input_image', ['name' => 'image', 'label' => __('label.image'), 'required' => 1, 'value' => $item->image]) @endcomponent
        @component('backend._components.input_text_editor', ['name' => 'body', 'label' => __('label.body'), 'required' => 1, 'value' => $item->body]) @endcomponent
        @component('backend._components.input_date_picker', ['name' => 'publish_date', 'label' => __('label.publish_date'), 'required' => 1, 'value' => $item->publish_date]) @endcomponent
        @component('backend._components.input_radio', ['name' => 'status', 'options' => ['draft', 'publish'], 'label' => __('label.status'), 'required' => 1, 'value' => $item->status]) @endcomponent

        @component('backend._components.input_buttons', ['page_type' => $page_type])@endcomponent
    @endcomponent
@endsection
