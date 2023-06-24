<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar">
        <ul class="pcoded-item pcoded-left-item">
            {{-- this is dashboard permission get everyone --}}
            @if (Auth::user()->can('admin-dashboard.view') || Auth::user()->can('client-dashboard.view'))
                <li class=" {{ Route::is('home.index') ? 'active' : '' }}">
                    <a href="{{ route('home.index') }}">
                        <span class="pcoded-micon"><i class="ti-home" aria-hidden="true"></i></span>
                        <span class="pcoded-mtext">Home</span>
                        <span class="pcoded-mcaret"></span>
                    </a>

                </li>
            @endif
            {{-- admin all permission --}}
            @if (Auth::user()->can('admin-dashboard.view'))
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                        <span class="pcoded-mtext">User</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            @if (Auth::user()->can('roles.list'))
                                <a href="{{ route('roles.index') }}">
                                    <span class="pcoded-micon"><i class="ti-home"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">User Role</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            @endif
                        </li>
                        <li class="">
                            @if (Auth::user()->can('permissions.list'))
                                <a href="{{ route('permissions.index') }}">
                                    <span class="pcoded-micon"><i class="ti-home"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">User Permission</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            @endif
                        </li>
                        <li class="">
                            @if (Auth::user()->can('users.list'))
                                <a href="{{ route('users.index') }}">
                                    <span class="pcoded-micon"><i class="ti-home"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Internal User</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            @endif
                        </li>
                        <li class="">
                            @if (Auth::user()->can('users.list'))
                                <a href="{{ route('clients.index') }}">
                                    <span class="pcoded-micon"><i class="ti-home"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Client User</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            @endif
                        </li>


                    </ul>
                </li>
                
            @endif
           
        </ul>
    </div>
</nav>
