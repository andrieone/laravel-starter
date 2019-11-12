<?php $role = Auth::user()->adminRole->name; ?>
<ul class="sidebar-menu uppercase" data-widget="tree">
    <li class="header uppercase">MAIN NAVIGATION</li>
    {{-- Menu Super Admin --}}
    @if( $role == "admin_super" )
        <li id="menu-admin-super">
            <a href="{{ route('admin.super-admin.edit', Auth::user()->id ) }}">
                <i class="fa fa-user"></i>
                <span>@lang('label.superAdmin')</span>
            </a>
        </li>
    @endif
    {{-- Menu Office Admin --}}
    <li id="menu-office-admin" class="treeview">
        <a href="#">
            <i class="fa fa-users"></i>
            <span>@lang('label.officeAdmin')</span>
        </a>
        <ul class="treeview-menu capitalize">
            @if( $role == "admin_super" )
                <li>
                    <a class="create-office" href="{{ route('admin.admins.create') }}">
                        @lang('label.createNew')
                    </a>
                </li>
            @elseif($role == "admin_office")
                <li class="update-admins-profile">
                    <a class="update-office" href="{{ route('admin.admins.edit', Auth::user()->id) }}">
                        @lang('label.updateProfile')
                    </a>
                </li>
            @endif
            <li>
                <a class="list-office" href="{{ route('admin.admins.index') }}">
                    @lang('label.list')
                </a>
            </li>
        </ul>
    </li>
    @if( $role == "admin_super")
        {{-- Super Admin : Office Menu --}}
        <li id="menu-office" class="treeview">
            <a href="#">
                <i class="fa fa-building"></i>
                <span>@lang('label.office')</span>
            </a>
            <ul class="treeview-menu capitalize">
                <li>
                    <a class="office-create" href="{{ route('admin.offices.create') }}">
                        @lang('label.createNew')
                    </a>
                </li>
                <li>
                    <a class="office-list" href="{{ route('admin.offices.index') }}">
                          @lang('label.list')
                    </a>
                </li>
            </ul>
        </li>
        {{-- Super Admin : Grand Top Menu --}}
        <li id="menu-grand-top">
            <a href="{{ route('admin.top.edit', 1 ) }}">
                <i class="fa fa-globe"></i>
                <span>@lang('label.grandTop')</span>
            </a>
        </li>
        {{-- Super Admin : Country Menu --}}
        <li id="menu-country">
            <a href="{{ route('admin.countries.index') }}">
                <i class="fa fa-flag"></i>
                <span>@lang('label.country')</span>
            </a>
        </li>
        {{-- Super Admin : Area Menu --}}
        <li id="menu-area" class="treeview">
            <a href="#">
                <i class="fa fa-map-signs"></i>
                <span>@lang('label.area')</span>
            </a>
            <ul class="treeview-menu capitalize">
                <li><a class="area-create" href="{{ route('admin.areas.create') }}">  @lang('label.createNew')</a></li>
                <li><a class="area-list" href="{{ route('admin.areas.index') }}">  @lang('label.list')</a></li>
            </ul>
        </li>
    @elseif( $role == "admin_office" )
        @php $country_id = Auth::user()->office->places_id; @endphp
        {{-- Office Admin : Office Menu --}}
        <li id="menu-office">
            <a href="{{ route('admin.offices.edit', Auth::user()->office_id) }}">
                <i class="fa fa-building"></i>
                <span>@lang('label.office')</span>
            </a>
        </li>
        {{-- Office Admin : Country Menu --}}
        <li id="menu-country">
            <a href="{{ route('admin.countries.edit',$country_id) }}">
                <i class="fa fa-flag"></i>  @lang('label.country')
            </a>
        </li>
        {{-- Office Admin : Area Menu --}}
        <li id="menu-area" class="treeview">
            <a href="#">
                <i class="fa fa-map-signs"></i>
                <span>@lang('label.area')</span>
            </a>
            <ul class="treeview-menu capitalize">
                <li><a class="area-create" href="{{ route('admin.areas.create') }}">  @lang('label.createNew')</a></li>
                <li><a class="area-list" href="{{ route('admin.areas.index') }}">  @lang('label.list')</a></li>
            </ul>
        </li>
    @endif
    {{-- Product Theme Menu --}}
    <li id="menu-product-theme" class="treeview">
        <a href="#">
            <i class="fa fa-tasks"></i>
            <span>@lang('label.productTheme')</span>
        </a>
        <ul class="treeview-menu capitalize">
            <li>
                <a class="theme-create" href="{{ route('admin.product-theme.create') }}">
                    <span>@lang('label.createNew')</span>
                </a>
            </li>
            <li>
                <a class="theme-list" href="{{ route('admin.product-theme.index') }}">
                    <span>@lang('label.list')</span>
                </a>
            </li>
        </ul>
    </li>
    <li id="menu-discount">
            <a href="{{ route('admin.discount.index') }}">
                <i class="fas fa-tag"></i>
                <span>Discount Badge</span>
            </a>
    </li>
    {{-- Customers Voice Menu --}}
    <li id="menu-customers-voice" class="treeview">
        <a href="#">
            <i class="fa fa-volume-up"></i>
            <span>@lang('label.customerVoice')</span>
        </a>
        <ul class="treeview-menu capitalize">
            <li>
                <a class="voices-create" href="{{ route('admin.customer-voices.create') }}">
                    <span>@lang('label.createNew')</span>
                </a>
            </li>
            <li>
                <a class="voices-list" href="{{ route('admin.customer-voices.index') }}">
                    <span>@lang('label.list')</span>
                </a>
            </li>
        </ul>
    </li>
    {{-- Customers Experince Menu --}}
    <li id="menu-customers-experience" class="treeview">
        <a href="#">
            <i class="fas fa-poll-people"></i>
            <span>@lang('label.customerExperience')</span>
        </a>
        <ul class="treeview-menu capitalize">
            <li>
                <a class="experience-create" href="{{ route('admin.customer-experience.create') }}">
                    <span>@lang('label.createNew')</span>
                </a>
            </li>
            <li>
                <a class="experience-list" href="{{ route('admin.customer-experience.index') }}">
                    <span>@lang('label.list')</span>
                </a>
            </li>
        </ul>
    </li>
    {{-- Reservation Chat Menu --}}
    <li id="menu-reservation-chat">
        <a href="{{ route('admin.chat') }}">
            <i class="fa fa-comments"></i>
            <span>@lang('label.reservationChat')</span>
        </a>
    </li>
    {{-- Country Email Menu --}}
    <li id="menu-country-email" class="treeview">
        <a href="#">
            <i class="fa fa-envelope"></i> 
            <span>Country Email</span>
        </a>
        <ul class="treeview-menu capitalize">
            <li>
                <a class="country-email-create" href="{{ route('admin.country-email.create') }}">
                    <span>@lang('label.createNew')</span>
                </a>
            </li>
            <li>
                <a class="country-email-list" href="{{ route('admin.country-email.index') }}">
                    <span>@lang('label.list')</span>
                </a>
            </li>
        </ul>
    </li>
    @if( $role == "admin_super")
    {{-- Currency Exchange Menu --}}
    <li id="menu-currency">
        <a href="{{ route('admin.currencies.index') }}">
            <i class="fa fa-dollar-sign"></i>
            <span>Currency Exchange Rate</span>
        </a>
    </li>
    {{-- Page Information Menu --}}
    <li id="menu-page-information">
        <a href="{{ route('admin.page-information.index') }}">  
            <i class="fa fa-file-word"></i>               
            <span>@lang('label.pageInformation')</span>
        </a>
    </li>
    {{-- Page Setting Menu --}}
    <li id="menu-settings">
        <a href="{{ route('admin.page-setting.index') }}">
            <i class="fa fa-cog"></i>
            <span>Page Setting</span>
        </a>
    </li>
    {{-- Log Histories Menu --}}
    <li id="menu-log-histories">
        <a href="{{ route('admin.histories.index') }}">
            <i class="fa  fa-list-alt"></i>
            <span>@lang('label.log')</span>
        </a>
    </li>
    @endif
</ul>
