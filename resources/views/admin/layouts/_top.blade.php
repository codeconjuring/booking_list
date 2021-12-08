<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        @if (Settings::get('site_logo'))
            <a class="navbar-brand brand-logo" href="{{ route('admin.dashboard') }}"><img src="{{ asset(Storage::url(Settings::get('site_logo'))) }}" alt="{{ Settings::get('title') }}" /></a>
            <a class="navbar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}"><img src="{{ asset(Storage::url(Settings::get('site_logo'))) }}" alt="{{ Settings::get('title') }}" /></a>
            @else
            <a class="navbar-brand brand-logo" href="{{ route('admin.dashboard') }}"><img src="{{ asset(config('settings.site_logo')) }}" alt="{{ Settings::get('title') }}" /></a>
            <a class="navbar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}"><img src="{{ asset(config('settings.site_logo')) }}" alt="{{ Settings::get('title') }}" /></a>
        @endif

    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-menu"></span>
      </button>
      <div class="search-field d-none d-md-block">

      </div>
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
            <div class="nav-profile-img">
                @if(auth()->user()->profile_image)
                    <img src="{{ asset(Storage::url(auth()->user()->profile_image)) }}" alt="{{ auth()->user()->full_name }}">
                @else
                    <img src="{{ asset(Storage::url(Settings::get('default_profile'))) }}" alt="{{ auth()->user()->full_name }}">
                @endif

              <span class="availability-status online"></span>
            </div>
            <div class="nav-profile-text">
              <p class="mb-1 text-black">{{ auth()->user()->full_name }}</p>
            </div>
          </a>
          <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="{{ route('admin.profile.index') }}">
              <i class="mdi mdi-face-profile mr-2 text-success"></i> Profile </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" onclick="logout()" href="#">
              <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>
