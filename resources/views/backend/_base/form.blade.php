@extends('backend._base.app')

@section('content')
@yield('form_header')
<!-- Main content -->
<section id="main-content" class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                @yield('form_header_right')
                <div class="box-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @yield('form_content')
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="imgpreview">
    <div class="modal-dialog" role="document" id="modal-dialog-image-preview">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Image Preview</h4>
            </div>
            <div class="modal-body">
                <img id='imagesmodal' width='100%' height='auto' src=''/>
            </div>
        </div>
    </div>
</div>

@endsection
