<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo m-0" data-navbar-theme="theme1" style="background: white; ">
            <a href="{{ route('home.index') }}">
                @if (Auth::user()->hasRole('Client'))
                    <img style="margin-left: -84px; max-width: 120px"
                        src="{{ asset('images/products/' . Auth::user()->product->image) }}" alt="Theme-Logo">
                @else
                    <img style="margin-left: -84px" src="{{ asset('images/default/appinion.png') }}" alt="Theme-Logo">
                @endif
            </a>
        </div>
        <div class="navbar-container container-fluid">
            <div>
                <ul class="nav-right">
                    <li class="header-notification">
                        <a href="#!" id="notificationButton">
                            <i class="ti-bell"></i>
                            <span class="badge"
                                id="badge">{{ $totalUnSeenNotifications }}</span>
                        </a>
                        <ul class="show-notification" id="show-notification">
                            <li>
                                <h6 style="font-weight: bold">Notifications</h6>
                                <label class="label label-danger">New</label>

                                {{-- TODO::this cocde will change and come from controller and its a bad practice --}}
                                @isset($notifications)
                                    @foreach ($notifications as $notification)
                                        @if (Auth::user()->hasRole('Client'))
                                        <li style="{{ $notification->is_seen == 0 ? 'background: 	#F8F8F8' : '' }}" ><a href="{{ route('clients-ticket.index') }}">{{ $notification->message }}</a></li>
                                        @else
                                        <li style="{{ $notification->is_seen == 0 ? 'background: 	#F8F8F8' : '' }}"><a href="{{ route('tickets.index') }}">{{ $notification->message }}</a></li>
                                        @endif
                                    @endforeach
                                @endisset
                            </li>
                        </ul>
                </li>

                <li class="user-profile header-notification">
                    <a href="#!">
                        <img src="{{ asset('assets/images/user.png') }}" alt="User-Profile-Image">
                        <span>{{ Auth::user()->name }}</span>
                        <i class="ti-angle-down"></i>
                    </a>
                    <ul class="show-notification profile-notification">

                        <li>
                            <a href="{{ route('change.password') }}">
                                <i class="ti-user"></i> Change Password
                            </a>
                        </li>

                        <li>

                            <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                <i class="ti-layout-sidebar-left"></i> Logout

                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                </ul>
                <!-- search -->
                <div id="morphsearch" class="morphsearch">
                    <form class="morphsearch-form">
                        <input class="morphsearch-input" type="search" placeholder="Search..." />
                        <button class="morphsearch-submit" type="submit">Search</button>
                    </form>
                    <div class="morphsearch-content">
                        <div class="dummy-column">
                            <h2>People</h2>
                            <a class="dummy-media-object" href="#!">
                                <img class="round"
                                    src="http://0.gravatar.com/avatar/81b58502541f9445253f30497e53c280?s=50&amp;d=identicon&amp;r=G"
                                    alt="Sara Soueidan" />
                                <h3>Sara Soueidan</h3>
                            </a>
                            <a class="dummy-media-object" href="#!">
                                <img class="round"
                                    src="http://1.gravatar.com/avatar/9bc7250110c667cd35c0826059b81b75?s=50&amp;d=identicon&amp;r=G"
                                    alt="Shaun Dona" />
                                <h3>Shaun Dona</h3>
                            </a>
                        </div>
                        <div class="dummy-column">
                            <h2>Popular</h2>
                            <a class="dummy-media-object" href="#!">
                                <img src="{{ asset('assets/images/avatar-1.png') }}" alt="PagePreloadingEffect" />
                                <h3>Page Preloading Effect</h3>
                            </a>
                            <a class="dummy-media-object" href="#!">
                                <img src="{{ asset('assets/images/avatar-1.png') }}"
                                    alt="DraggableDualViewSlideshow" />
                                <h3>Draggable Dual-View Slideshow</h3>
                            </a>
                        </div>
                        <div class="dummy-column">
                            <h2>Recent</h2>
                            <a class="dummy-media-object" href="#!">
                                <img src="{{ asset('assets/images/avatar-1.png') }}"
                                    alt="TooltipStylesInspiration" />
                                <h3>Tooltip Styles Inspiration</h3>
                            </a>
                            <a class="dummy-media-object" href="#!">
                                <img src="{{ asset('assets/images/avatar-1.png') }}" alt="NotificationStyles" />
                                <h3>Notification Styles Inspiration</h3>
                            </a>
                        </div>
                    </div>
                    <!-- /morphsearch-content -->
                    <span class="morphsearch-close"><i class="icofont icofont-search-alt-1"></i></span>
                </div>
                <!-- search end -->
            </div>
        </div>
    </div>
</nav>
