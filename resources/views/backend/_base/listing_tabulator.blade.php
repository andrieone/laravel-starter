@extends('backend._base.app')

@section('content')

    @php $locale = Config::get('app.locale') @endphp

    <section class="content-header">
        @yield('listing_tabulator_header')
        {{--**SECTION**
            <h1>@lang('label.officeAdmin')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> @lang('label.home')</a></li>
                <li class="active">@lang('label.officeAdmin')</li>
            </ol>
        **--}}
    </section>
    <!-- Main content -->
    <section class="content admins-content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">@lang('heading.list')</h3>
                        @yield('listing_tabulator_create_link')
                        {{--**SECTION** <a id="btn-add" class="btn btn-primary pull-right" href="{{ route('admin.admins.create') }}">@lang('label.createNew')</a> **--}}
                    </div>
                    <div class="box-body">
                        {{-- show success/error message --}}
                        @if( $message = Session::get('success'))
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        @if( $message = Session::get('error'))
                            <div class="alert alert-error">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        {{ Form::hidden( 'total-data', '', array( 'id' => 'total-data' )) }}

                        {{-- @if( 'ja' == $locale )
                            <div id="datalist-header" class="pull-right invisible">
                                <span id="datalist-total-data"></span><span>件中</span>
                                <span id="datalist-min-data"></span><span>〜</span>
                                <span id="datalist-max-data"></span>
                                <span>件を表示</span>
                            </div>
                        @elseif( 'en' == $locale )
                            <div id="datalist-header" class="pull-right invisible">
                                <span>Showing</span>
                                <span id="datalist-min-data"></span>&nbsp;<span>~</span>
                                <span id="datalist-max-data"></span>&nbsp;<span>of</span>
                                <span id="datalist-total-data"></span>
                            </div>
                        @endif --}}

                        <div id="datalist-header" class="pull-right invisible">
                            <span>Showing</span>
                            <span id="datalist-min-data"></span>&nbsp;<span>~</span>
                            <span id="datalist-max-data"></span>&nbsp;<span>of</span>
                            <span id="datalist-total-data"></span>
                        </div>

                        <div id="datalist" data-json="{{ $json_path }}"></div>

                        @yield('listing_tabulator_content')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

    <!-- Modal Delete -->
    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    @php $confirm = 'listing_tabulator_delete_confirm' @endphp
                    @if( !empty( $__env->yieldContent( $confirm )))
                        <h4 class="modal-title">@yield( $confirm )</h4>
                    @else
                        <h4 class="modal-title">@lang('label.tabulator.deleteConfirm')</h4>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">@lang('label.close')</button>

                    <form id="form-delete" action="@yield('listing_tabulator_delete_route')" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-warning">@lang('label.delete')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->

    <!-- Modal Show Column -->
    <div class="modal fade" id="modal-column">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Switch display</h4>
                </div>

                <div class="modal-body">
                    <div class="list-column">
                        <ul class="list-unstyled">
                        </ul>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">@lang('label.close')</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->
@endsection
