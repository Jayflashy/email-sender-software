<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{route('admin.index')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{my_asset(get_setting('logo'))}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{my_asset(get_setting('logo'))}}" alt="" height="20">
                    </span>
                </a>

                <a href="{{route('admin.index')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{my_asset(get_setting('logo'))}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{my_asset(get_setting('logo'))}}"  alt="" height="20">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-menu"></i>
            </button>

            <div class="d-none d-sm-block ms-2">
                <h4 class="page-title font-size-18">@yield('title')</h4>
            </div>

        </div>

        <!-- Search input -->
        <div class="search-wrap" id="search-wrap">
            <div class="search-bar">
                <input class="search-input form-control" placeholder="Search" />
                <a href="#" class="close-search toggle-search" data-bs-target="#search-wrap">
                    <i class="mdi mdi-close-circle"></i>
                </a>
            </div>
        </div>

        <div class="d-flex">



            <div class="dropdown d-inline-block ms-2">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{static_asset('images/users/avatar-2.jpg')}}"
                        alt="Header Avatar">
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{route('admin.profile')}}"><i class="dripicons-user font-size-16 align-middle me-2"></i>
                        Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('logout')}}"><i class="dripicons-exit font-size-16 align-middle me-2"></i>
                        Logout</a>
                </div>
            </div>

        </div>
    </div>
</header>
