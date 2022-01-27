<div data-simplebar class="h-100">
    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- LOGO -->
        <div class="navbar-brand-box">

            @if (Settings::get('site_logo'))
                <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset(Storage::url(Settings::get('site_logo'))) }}" alt="{{ Settings::get('title') }}">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset(Storage::url(Settings::get('site_logo'))) }}" alt="{{ Settings::get('title') }}">
                    </span>
                </a>

                <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset(Storage::url(Settings::get('site_logo'))) }}" alt="{{ Settings::get('title') }}">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset(Storage::url(Settings::get('site_logo'))) }}" alt="{{ Settings::get('title') }}">
                    </span>
                </a>
            @else
                <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset(Storage::url(Settings::get('site_logo'))) }}" alt="{{ Settings::get('title') }}">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset(Storage::url(Settings::get('site_logo'))) }}" alt="{{ Settings::get('title') }}">
                    </span>
                </a>

                <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset(config('settings.site_logo')) }}" alt="{{ Settings::get('title') }}">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset(config('settings.site_logo')) }}" alt="{{ Settings::get('title') }}">
                    </span>
                </a>
            @endif
        </div>
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="mm-active">
                <a href="javascript: void(0);" class="has-arrow" aria-expanded="true">
                    <i class="icon-dashboard"></i>
                    <span data-key="t-dashboard">Dashboard</span>
                </a>
                <ul class="sub-menu mm-collapse mm-show" aria-expanded="false">
                    <li><a href="#">Single Book Dashboard</a></li>
                    <li><a href="#">Progress Dashboard</a></li>
                    <li><a href="#">Sales/Distribution
                            Dashboard</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="icon-book-plus"></i>
                    <span>Book Management</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="#">Book List</a></li>
                    <li><a href="#">Book Creation</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="icon-book-open"></i>
                    <span>Book Attributes</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="#">Book Format</a></li>
                    <li><a href="#">Book Series</a></li>
                    <li><a href="#">Book Status</a></li>
                    <li><a href="#">Book Tags</a></li>
                    <li><a href="#">Book Author</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="icon-user"></i>
                    <span>User</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="#">Production Report</a></li>
                    <li><a href="#">Distribution Report</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
                <ul class="sub-menu" aria-expanded="true">
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">User</a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="javascript: void(0);">User List</a></li>
                            <li><a href="javascript: void(0);">User Role</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">Setting</a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="javascript: void(0);">System Setting</a></li>
                            <li><a href="javascript: void(0);">Email Setting</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
    <!-- Sidebar -->
</div>
