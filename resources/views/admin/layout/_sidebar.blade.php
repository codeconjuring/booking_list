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
            <li>
                <a href="javascript: void(0);" class="has-arrow" aria-expanded="true">
                    <i class="icon-dashboard"></i>
                    <span data-key="t-dashboard">Dashboard</span>
                </a>
                <ul class="sub-menu mm-collapse" aria-expanded="false">
                    <li><a href="{{ route('admin.dashboard') }}">General Progress</a></li>
                    <li><a href="#">Book Details</a></li>
                    <li><a href="#">Sales & Distribution</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="icon-book-plus"></i>
                    <span>Book Management</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('admin.form.index') }}">Book List</a></li>
                    <li><a href="{{ route('admin.form.create') }}">Book Creation</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="icon-book-open"></i>
                    <span>Book Attributes</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('admin.form-builder.index') }}">Book Format</a></li>
                    <li><a href="{{ route('admin.series.index') }}">Book Series</a></li>
                    <li><a href="{{ route('admin.status.index') }}">Book Status</a></li>
                    <li><a href="{{ route('admin.category.index') }}">Book Tags</a></li>
                    <li><a href="{{ route('admin.author.index') }}">Book Author</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="icon-user"></i>
                    <span>User</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('admin.role.create') }}">Create Role</a></li>
                    <li><a href="{{ route('admin.role.index') }}">List Roles</a></li>
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
                            <li><a href="{{ route('admin.user.index') }}">User List</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">Setting</a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="{{ route('admin.setting.index') }}">System Setting</a></li>
                            <li><a href="{{ route('admin.email.index') }}">Email Setting</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
    <!-- Sidebar -->
</div>
