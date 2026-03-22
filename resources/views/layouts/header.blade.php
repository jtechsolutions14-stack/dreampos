 <div class="header">

            <!-- Logo -->
            <div class="header-left active">
                <a href="{{ route('dashboard') }}" class="logo logo-normal">
                    <img src="{{ company_logo_url(asset('assets/img/logo.png')) }}" alt="">
                </a>
                <a href="{{ route('dashboard') }}" class="logo logo-white">
                    <img src="{{ company_setting('dark_logo') ? asset('storage/' . company_setting('dark_logo')) : asset('assets/img/logo-white.png') }}" alt="">
                </a>
                <a href="{{ route('dashboard') }}" class="logo-small">
                    <img src="{{ company_setting('logo_icon') ? asset('storage/' . company_setting('logo_icon')) : asset('assets/img/logo-small.png') }}" alt="">
                </a>
                <a id="toggle_btn" href="javascript:void(0);">
                    <i data-feather="chevrons-left" class="feather-16"></i>
                </a>
            </div>
            <!-- /Logo -->

            <a id="mobile_btn" class="mobile_btn" href="#sidebar">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>

            <!-- Header Menu -->
            <ul class="nav user-menu">

                <!-- Search -->
                <li class="nav-item nav-searchinputs">
                    <div class="top-nav-search">
                        <a href="javascript:void(0);" class="responsive-search">
                            <i class="fa fa-search"></i>
                        </a>
                        <form action="#" class="dropdown">
                            <div class="searchinputs dropdown-toggle" id="dropdownMenuClickable"
                                data-bs-toggle="dropdown" data-bs-auto-close="false">
                                <input type="text" placeholder="Search">
                                <div class="search-addon">
                                    <span><i data-feather="x-circle" class="feather-14"></i></span>
                                </div>
                            </div>
                            <div class="dropdown-menu search-dropdown" aria-labelledby="dropdownMenuClickable">
                                <div class="search-info">
                                    <h6><span><i data-feather="search" class="feather-16"></i></span>Recent Searches
                                    </h6>
                                    <ul class="search-tags">
                                        <li><a href="javascript:void(0);">Products</a></li>
                                        <li><a href="javascript:void(0);">Sales</a></li>
                                        <li><a href="javascript:void(0);">Applications</a></li>
                                    </ul>
                                </div>
                                <div class="search-info">
                                    <h6><span><i data-feather="help-circle" class="feather-16"></i></span>Help</h6>
                                    <p>How to Change Product Volume from 0 to 200 on Inventory management</p>
                                    <p>Change Product Name</p>
                                </div>
                                <div class="search-info">
                                    <h6><span><i data-feather="user" class="feather-16"></i></span>Customers</h6>
                                    <ul class="customers">
                                        <li>
                                            <a href="javascript:void(0);">Aron Varu<img
                                                    src="{{ asset('assets/img/profiles/avatar-02.jpg') }}" alt=""
                                                    class="img-fluid"></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Jonita<img
                                                    src="{{ asset('assets/img/profiles/avatar-01.jpg') }}" alt=""
                                                    class="img-fluid"></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Aaron<img
                                                    src="{{ asset('assets/img/profiles/avatar-10.jpg') }}" alt=""
                                                    class="img-fluid"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <!-- /Search -->

                <li class="nav-item nav-item-box">
                    <a href="javascript:void(0);" id="btnFullscreen">
                        <i data-feather="maximize"></i>
                    </a>
                </li>
                <!-- Notifications -->
                {{-- <li class="nav-item dropdown nav-item-box">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <i data-feather="bell"></i><span class="badge rounded-pill">2</span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0">
                                                <img alt="" src="{{ asset('assets/img/profiles/avatar-02.jpg') }}" class="img-fluid">
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">John Doe</span> added
                                                    new task <span class="noti-title">Patient appointment
                                                        booking</span>
                                                </p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="activities.html">View all Notifications</a>
                        </div>
                    </div>
                </li> --}}
                <!-- /Notifications -->

                <li class="nav-item nav-item-box">
                    <a href="{{ route('company-settings') }}"><i data-feather="settings"></i></a>
                </li>
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                        <span class="user-info">
                            <span class="user-letter">
                                <img src="{{ asset(Auth::user()->photo ? 'storage/' . Auth::user()->photo : 'assets/img/profiles/avatar-02.jpg') }}" alt="" class="img-fluid">
                            </span>
                            <span class="user-detail">
                                <span class="user-name">{{ Auth::user()->first_name ?? 'User' }}</span>
                                <span class="user-role">{{ Auth::user()->roles()->first()->name ?? 'Super Admin' }}</span>
                            </span>
                        </span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                        <div class="profilename">
                            <div class="profileset">
                                <span class="user-img"><img src="{{ asset(Auth::user()->photo ? 'storage/' . Auth::user()->photo : 'assets/img/profiles/avatar-02.jpg') }}" alt="">
                                    <span class="status online"></span></span>
                                <div class="profilesets">
                                    <h6>{{ Auth::user()->first_name ?? 'User' }}</h6>
                                    <h5>{{ Auth::user()->roles()->first()->name ?? 'Super Admin' }}</h5>
                                </div>
                            </div>
                            <hr class="m-0">
                            <a class="dropdown-item" href="{{ route('profile') }}"> <i class="me-2" data-feather="user"></i>
                                My Profile</a>
                            <a class="dropdown-item" href="{{ route('profile.password') }}"><i class="me-2"
                                    data-feather="settings"></i>Change Password</a>
                            <hr class="m-0">
                            <a class="dropdown-item logout pb-0" href="javascript:void(0);" id="logoutBtn"><i class="me-2"
                                    data-feather="lock"></i>Logout</a>
                        </div>
                        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            <!-- /Header Menu -->

            <!-- Mobile Menu -->
            <div class="dropdown mobile-user-menu">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">My Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="#">Logout</a>
                </div>
            </div>
            <!-- /Mobile Menu -->
        </div>