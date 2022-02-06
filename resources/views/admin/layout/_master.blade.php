<!doctype html>
<html lang="en">

<head>

    @include('admin.layout._head')

</head>

<body>

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            @include('admin.layout._top')
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">
            @include('admin.layout._sidebar')
        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            @yield('content')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    @include('admin.layout._script')
</body>

</html>
