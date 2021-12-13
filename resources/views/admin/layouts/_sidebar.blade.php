<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>

      @canany(['Add User','Edit User','Show User','Delete User'])
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-form-user" aria-expanded="false" aria-controls="ui-form-user">
          <span class="menu-title">User</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-account menu-icon"></i>
        </a>
        <div class="collapse" id="ui-form-user">
          <ul class="nav flex-column sub-menu">
            @can('Show User')
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.user.index') }}">User List</a></li>
            @endcan
          </ul>
        </div>
      </li>
      @endcanany

      @canany(['Add Book Attributes Format','Edit Book Attributes Format','Show Book Attributes Format','Delete Book Attributes Format','Add Book Attributes Series','Edit Book Attributes Series','Show Book Attributes Series','Delete Book Attributes Series','Add Book Attributes Status','Edit Book Attributes Status','Show Book Attributes Status','Delete Book Attributes Status'])
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-form" aria-expanded="false" aria-controls="ui-form">
          <span class="menu-title">Book Attributes</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-book-open-variant menu-icon"></i>
        </a>
        <div class="collapse" id="ui-form">
          <ul class="nav flex-column sub-menu">

            @canany(['Add Book Attributes Format','Edit Book Attributes Format','Show Book Attributes Format','Delete Book Attributes Format'])
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.form-builder.index') }}">Book Format</a></li>
            @endcanany

            @canany(['Add Book Attributes Series','Edit Book Attributes Series','Show Book Attributes Series','Delete Book Attributes Series'])
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.series.index') }}">Book Series</a></li>
            @endcanany
            @canany(['Add Book Attributes Status','Edit Book Attributes Status','Show Book Attributes Status','Delete Book Attributes Status'])
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.status.index') }}">Book Status</a></li>
            @endcanany
          </ul>
        </div>
      </li>
      @endcanany

    @canany(['Add Book Management','Edit Book Management','Show Book Management','Delete Book Management','Add Another Translation Book Management','Download Report Book Management'])
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-form1" aria-expanded="false" aria-controls="ui-form1">
          <span class="menu-title">Book Management</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-book-open-page-variant menu-icon"></i>
        </a>
        <div class="collapse" id="ui-form1">
          <ul class="nav flex-column sub-menu">
            @can('Add Book Management')
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.form.create') }}">Book Creation</a></li>
            @endcan
            @canany(['Edit Book Management','Show Book Management','Delete Book Management','Add Another Translation Book Management','Download Report Book Management'])
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.form.index') }}">Book Listing</a></li>
            @endcanany
          </ul>
        </div>
      </li>
    @endcanany

      @canany(['Add Administration','Edit Administration','Show Administration','Delete Administration'])
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-role" aria-expanded="false" aria-controls="ui-role">
          <span class="menu-title">Administration</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-account-check menu-icon"></i>
        </a>
        <div class="collapse" id="ui-role">
          <ul class="nav flex-column sub-menu">
              @can('Add Administration')
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.role.create') }}">Create Role</a></li>
            @endcan
            @can('Show Administration')
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.role.index') }}">List Roles</a></li>
            @endcan
          </ul>
        </div>
      </li>
      @endcanany

      @canany(['System Settings','Email Settings'])
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">Settings</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-settings menu-icon"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
              @can('System Settings')
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.setting.index') }}">System Setting</a></li>
            @endcan
            @can('Email Settings')
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.email.index') }}">Email Setting</a></li>
            @endcan
          </ul>
        </div>
      </li>
      @endcanany
    </ul>
  </nav>
