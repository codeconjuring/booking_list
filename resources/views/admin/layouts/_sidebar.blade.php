<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.form-builder.index') }}">
          <span class="menu-title">Form Builder</span>
          <i class="mdi mdi-newspaper menu-icon"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-form" aria-expanded="false" aria-controls="ui-form">
          <span class="menu-title">Form</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-format-line-style menu-icon"></i>
        </a>
        <div class="collapse" id="ui-form">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.form.create') }}">Form Submit</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.form.index') }}">Book List</a></li>
          </ul>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-role" aria-expanded="false" aria-controls="ui-role">
          <span class="menu-title">Administration</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-account-check menu-icon"></i>
        </a>
        <div class="collapse" id="ui-role">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.role.create') }}">Create Role</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.role.index') }}">Role List</a></li>
          </ul>
        </div>
      </li>


      @canany(['Show Series'])
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.series.index') }}">
          <span class="menu-title">Series</span>
          <i class="mdi mdi-attachment menu-icon"></i>
        </a>
      </li>
      @endcanany

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.status.index') }}">
          <span class="menu-title">Status</span>
          <i class="mdi mdi-arrow-down-bold-hexagon-outline menu-icon"></i>
        </a>
      </li>



      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">Settings</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-settings menu-icon"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.setting.index') }}">System Setting</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.email.index') }}">Email Setting</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>
