<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $page_title or '' }} | {{ env('APP_NAME','') }}</title>
        <meta name="viewport" content="width=device-width,user-scalable=0,initial-scale=1.0,minimum-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <!-- Components -->
        <link rel="shortcut icon" href="{{ asset('/frontend/assets/images/favicon.png')}}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{asset('/frontend/assets/extra/fontawesome-pro/css/all.min.css')}}">
        <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/skins/skin-blue-light.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/validation-engine/validationEngine.jquery.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/tabulator/tabulator.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/tabulator/tabulator_bootstrap.min.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="{{ asset('css/backend/fontawesome-iconpicker.min.css') }}">

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        @yield('css-scripts')

        <link rel="stylesheet" href="{{ asset('css/backend/backend.css') }}">
        @yield('css-extends')

    </head>
    <body class="hold-transition skin-blue-light sidebar-mini @yield('body-class')">
        <div class="wrapper">

            <header class="main-header">

                <a href="{{ url('admin') }}" class="logo">
                    <span class="logo-mini">{{ config('const.SHORT_APP_NAME') }}</span>
                    <span class="logo-lg">{{ config('const.FULL_APP_NAME') }}</span>
                </a>

                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"><span class="sr-only">Toggle navigation</span></a>

                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="{{ url('/') }}" target="_blank">
                                    <i class="fa fa-home" aria-hidden="true"></i>&nbsp;
                                    <span>Visit Homepage</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.logout') }}">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </nav>
            </header>

            <!-- SIDEBAR -->
            <aside class="main-sidebar">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ asset('img/ic_profile.png') }}" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>{{ Auth::user()->display_name }}</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> @lang('label.online')</a>
                        </div>
                    </div>
                    @include("backend._base.nav_left")
                </section>
            </aside>

            <!-- CONTENT -->
            <div class="content-wrapper">
                @yield('content')
            </div>

            <footer class="main-footer">
                <div class="version hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
            </footer>

        </div>
        <!-- ./wrapper -->

        <!-- JS COMPONENTS -->
        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('bower_components/jquery-cookie/jquery.cookie.min.js') }}"></script>
        <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
        <script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('js/adminlte.min.js') }}"></script>
        <script src="{{ asset('plugins/validation-engine/jquery.validationEngine-en.js') }}"></script>
        <script src="{{ asset('plugins/validation-engine/jquery.validationEngine.js') }}"></script>
        <script src="{{ asset('plugins/tabulator/tabulator.min.js') }}"></script>
        <script src="{{ Util::getFileVersionByLastMod('js/backend/backend.js') }}"></script>
        <script type="text/javascript"> var rootUrl = "{{ url('/') }}"</script>
        @yield('js-scripts')

        <script src="{{ Util::getFileVersionByLastMod('js/tabulator-handler.js') }}"></script>
        <script src="{{ Util::getFileVersionByLastMod('js/backend/form.js') }}"></script>
        <script src="{{ asset('js/backend/fontawesome-iconpicker.min.js') }}"></script>
        @yield('js-extends')

    </body>
</html>
