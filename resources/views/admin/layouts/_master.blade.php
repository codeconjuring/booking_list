<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.layouts._head')
  </head>
  <body>
    <div class="container-scroller">

      @include('admin.layouts._top')

      <div class="container-fluid page-body-wrapper">

            @include('admin.layouts._sidebar')

            <div class="main-panel">

                @yield('content')


                @include('admin.layouts._footer')
            </div>
      </div>


    </div>

    @include('admin.layouts._script')
  </body>
</html>
