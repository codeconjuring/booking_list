<div data-simplebar class="h-100">
    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- LOGO -->
        <div class="navbar-brand-box">

            @if (Settings::get('site_logo'))
                <a href="{{ route('index') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('dashboard/update_assets/images/sort-logo.png') }}" alt="{{ Settings::get('title') }}">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset(Storage::url(Settings::get('site_logo'))) }}" alt="{{ Settings::get('title') }}">
                    </span>
                </a>

                <a href="{{ route('index') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('dashboard/update_assets/images/sort-logo.png') }}" alt="{{ Settings::get('title') }}">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset(Storage::url(Settings::get('site_logo'))) }}" alt="{{ Settings::get('title') }}">
                    </span>
                </a>
            @else
                <a href="{{ route('index') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('dashboard/update_assets/images/sort-logo.png') }}" alt="{{ Settings::get('title') }}">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset(Storage::url(Settings::get('site_logo'))) }}" alt="{{ Settings::get('title') }}">
                    </span>
                </a>

                <a href="{{ route('index') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('dashboard/update_assets/images/sort-logo.png') }}" alt="{{ Settings::get('title') }}">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset(config('settings.site_logo')) }}" alt="{{ Settings::get('title') }}">
                    </span>
                </a>
            @endif
        </div>
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="{{ Route::currentRouteName() == 'admin.dashboard' ? 'mm-active':'' }}">
                <a href="javascript: void(0);" onclick="window.location = '{{ route('admin.dashboard') }}';" aria-expanded="true">
                    <i class="icon-dashboard"></i>
                    <span>Dashboard</span>
                </a>
                {{-- <ul class="sub-menu mm-collapse" aria-expanded="false">
                    <li><a href="{{ route('admin.dashboard') }}">General Progress</a></li>
                    <li><a href="#">Book Details</a></li>
                    <li><a href="#">Sales & Distribution</a></li>
                </ul> --}}
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow" aria-expanded="true">
                    <i class="icon-dashboard"></i>
                    <span data-key="t-conception">Conception</span>
                </a>
                <ul class="sub-menu mm-collapse" aria-expanded="false">

                      <li><a href="{{ route('admin.form.index') }}">Catalogue</a></li>
                      <li><a href="{{ route('admin.form.create') }}">Add New Book</a></li>
                    {{-- <a href="javascript: void(0);" class="has-arrow">
                      <i class="icon-book-open"></i>
                      <span>Book Attributes</span>
                    </a> --}}
                      <li><a href="{{ route('admin.form-builder.index') }}">Add Book Format</a></li>
                      <li><a href="{{ route('admin.series.index') }}">Add Book Series</a></li>
                      <li><a href="{{ route('admin.status.index') }}">Add Book Status</a></li>
                      <li><a href="{{ route('admin.category.index') }}">Add Book Tags</a></li>
                      <li><a href="{{ route('admin.author.index') }}">Add Book Author</a></li>
                      <li><a href="{{ route('admin.proof-reader.index') }}">Add Proofreader</a></li>
                      <li><a href="{{ route('admin.narrator.index') }}">Add Narrator</a></li>
                      <li><a href="#">Add Translator</a></li>
                    </ul>
            </li>

            {{-- <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="icon-book-plus"></i>
                    <span>Book Management</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('admin.form.index') }}">Book List</a></li>
                    <li><a href="{{ route('admin.form.create') }}">Book Creation</a></li>
                </ul>
            </li> --}}
            {{-- <li>
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
                    <li><a href="{{ route('admin.proof-reader.index') }}">Book Proofreader</a></li>
                    <li><a href="{{ route('admin.narrator.index') }}">Book Narrator</a></li>
                </ul>
            </li> --}}
            @canany(['Show Analytics','Add CPH','Edit CPH','Delete CPH','Add Add Report','Edit Add Report','Delete Add Report'])
            <li class = "{{ url()->current() == url('admin/production-department/create') ? "mm-active" : '' }}{{ url()->current() == url('admin/production-house/create') ? "mm-active" : '' }}">
              <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-industry"></i>
                <span>Production</span>
              </a>
              <ul class="sub-menu" aria-expanded="false">
                @can('Show Analytics')
                <li>
                  <a href="{{ route('admin.production.production-dashboard') }}">Analytics
                  </a>
                </li>
                @endcan
                @canany(['Add CPH','Edit CPH','Delete CPH'])
                <li class="{{ url()->current() == url('admin/production-house/create') ? "mm-active" : '' }}">
                  <a class="{{ url()->current() == url('admin/production-house/create') ? "active" : '' }}" href="{{ route('admin.production-house.index') }}">
                    Add CPH
                  </a>
                </li>
                @endcanany
                @canany(['Add Add Report','Edit Add Report','Delete Add Report'])
                <li class = "{{ url()->current() == url('admin/production-department/create') ? "mm-active" : '' }}">
                  <a class="{{ url()->current() == url('admin/production-department/create') ? "active" : '' }}" href="{{ route('admin.production-department.index') }}">   Add Report
                  </a>
                </li>
                @endcanany
              </ul>
            </li>
            @endcanany
            <li>
              <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-network-wired"></i>
                <span>Distribution</span>
              </a>
              <ul class="sub-menu" aria-expanded="false">
                <li>
                  <a href="#">
                    Add Agent
                  </a>
                </li>
                <li>
                  <a href="#">Add Report
                  </a>
                </li>
              </ul>
            </li>
            {{-- <li>
                <a href="javascript: void(0);" class="has-arrow">
                     <i class="fas fa-cog"></i>
                    <span>Sales/Distribution</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            Production
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('admin.production.production-dashboard') }}">Analytics
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.production-house.index') }}">
                                Add CPH
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.production-department.index') }}">Add Report
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            Distribution
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{ route('admin.production-house.index') }}">
                                Add Agent
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.production-department.index') }}">Add Report
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li> --}}
            <li>
                <a href="javascript: void(0);">
                     <i class="fas fa-cog"></i>
                    <span>Impact</span>
                </a>
            </li>
            <li>
                <a href="javascript: void(0);">
                     <i class="fas fa-chart-line"></i>
                    <span>Finance</span>
                </a>
            </li>
            <li>
                <a href="javascript: void(0);">
                     <i class="fas fa-cog"></i>
                    <span>POD System</span>
                </a>
            </li>
            <li>
              <a href="javascript: void(0);" class="has-arrow">
                <i class="fas fa-shopping-cart"></i>
                <span>E-Commerce</span>
              </a>
              <ul class="sub-menu" aria-expanded="false">
                <li>
                  <a href="#">
                    Coupon Management
                  </a>
                </li>
                <li>
                  <a href="#">Analytics
                  </a>
                </li>
              </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="fas fa-user"></i>
                    <span>Administration</span>
                </a>
                <ul class="sub-menu" aria-expanded="true">
                    <li>
                      <li><a href="{{ route('admin.user.index') }}">User Listing</a></li>
                      <li><a href="{{ route('admin.role.create') }}">Create Role</a></li>
                      <li><a href="{{ route('admin.role.index') }}">List Roles</a></li>
                      <li><a href="{{ route('admin.setting.index') }}">System Setting</a></li>
                      <li><a href="{{ route('admin.email.index') }}">Email Setting</a></li>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- Sidebar -->
</div>
