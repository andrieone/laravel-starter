@php $roles = Auth::user()->adminRole->name; @endphp
@if($roles == 'super_admin')
@endif
<aside class="main-sidebar elevation-1 sidebar-light-info">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link navbar-info text-center">
        <span class="brand-text">{{ config('app.name')  }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('img/backend/adminlte/avatar.png')}}" class="img-circle" alt="{{ Auth::user()->display_name }}">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->display_name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul id="nav-left" class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">MAIN NAVIGATION</li>
                @if($roles == 'super_admin')
                    <li class="nav-item has-treeview" id="tree_superadmins">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p> @lang('label.superAdmin')<i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li id="create_superadmin" class="nav-item">
                                <a href="{{route('admin.superadmin.create')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('label.createNew')</p>
                                </a>
                            </li>
                            <li id="list_superadmin" class="nav-item">
                                <a href="{{route('admin.superadmin.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('label.list')</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview" id="tree_companies">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-building"></i>
                            <p> @lang('label.company')<i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li id="create_company" class="nav-item">
                                <a href="{{route('admin.company.create')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('label.createNew')</p>
                                </a>
                            </li>
                            <li id="list_company" class="nav-item">
                                <a href="{{route('admin.company.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('label.list')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li class="nav-item has-treeview" id="tree_admins">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p> @lang('label.admin') <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li id="create_admin" class="nav-item">
                            <a href="{{route('admin.admins.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('label.createNew')</p>
                            </a>
                        </li>
                        <li id="list_admin" class="nav-item">
                            <a href="{{route('admin.admins.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('label.list')</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview" id="tree_news">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p> @lang('label.news') <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li id="create_news" class="nav-item">
                            <a href="{{route('admin.news.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('label.createNew')</p>
                            </a>
                        </li>
                        <li id="list_admin" class="nav-item">
                            <a href="{{route('admin.news.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('label.list')</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @if($roles == 'super_admin')
                <li class="nav-item">
                    <a href="{{route('admin.logactivities.index')}}" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p>@lang('label.log_activity')</p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
