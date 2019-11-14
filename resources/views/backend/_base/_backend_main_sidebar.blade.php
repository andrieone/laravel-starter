@php $roles = Auth::user()->adminRole->name; @endphp
@if($roles == 'super_admin')
@endif
<aside class="main-sidebar elevation-1 sidebar-light-info">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link navbar-info">
        <img src="{{asset('img/backend/adminlte/Logo.png')}}" alt="Grune Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Grune</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('img/backend/adminlte/avatar.png')}}" class="img-circle elevation-2" alt="{{ Auth::user()->display_name }}">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->display_name }}</a>
            </div>
        </div>

    <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                @if($roles == 'super_admin')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p> @lang('label.superAdmin')<i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.super-admin.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('label.createNew')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.super-admin.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('label.list')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p> @lang('label.admin') <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.admins.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('label.createNew')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.admins.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('label.list')</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
