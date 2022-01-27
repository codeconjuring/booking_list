<div class="navbar-header">

    <div class="d-flex cc-collapsed-menu">
        <button type="button" class="btn btn-sm font-size-16 header-item" id="vertical-menu-btn">
            <i data-feather="chevron-left"></i>
        </button>

        <!-- App Search-->
        <form class="app-search d-none d-lg-block">
            <div class="position-relative">
                <input type="text" class="form-control" placeholder="Search...">
                <button class="btn" type="button"><i data-feather="search"></i></button>
            </div>
        </form>
    </div>

    <div class="d-flex">
        <div class="dropdown d-inline-block d-lg-none ms-2">
            <button type="button" class="btn header-item" id="page-header-search-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i data-feather="search" class="icon-lg"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                aria-labelledby="page-header-search-dropdown">

                <form class="p-3">
                    <div class="form-group m-0">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search ..."
                                aria-label="Search Result">
                            <button class="btn" type="submit"><i data-feathe="search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="dropdown d-inline-block">
            <button class="header-item bg-transparent d-flex align-items-center dropdown-toggle"
                type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                @if(auth()->user()->profile_image)
                    <img class="rounded-circle header-profile-user" src="{{ asset(Storage::url(auth()->user()->profile_image)) }}" alt="{{ auth()->user()->full_name }}">
                @else
                    <img class="rounded-circle header-profile-user" src="{{ asset(Storage::url(Settings::get('default_profile'))) }}" alt="{{ auth()->user()->full_name }}">
                @endif

                <div class="text-left ml-3">
                    <span class="d-none d-xl-inline-block fw-medium font-size-18 text-black">{{ auth()->user()->full_name }}</span>
                    <p class="mb-0 font-size-12 text-gray">{{ auth()->user()->email }}</p>
                </div>
                <i class="mdi mdi-chevron-down d-none font-size-20 d-xl-inline-block text-yellow"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <!-- item-->
                <a class="dropdown-item" href="{{ route('admin.profile.index') }}"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" onclick="logout()"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
            </div>
        </div>
    </div>
</div>
