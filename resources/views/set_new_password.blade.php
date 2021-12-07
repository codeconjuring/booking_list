

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ Settings::get('title') }}</title>
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('dashboard/assets/images/favicon.ico') }}" />
    {{-- CDN --}}
    {{-- Toster Notification --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  {{-- <img src="{{ asset('dashboard/assets/images/logo.svg') }}"> --}}
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="form-horizontal m-t-30" action="{{ route('set.password',['uuid'=>$uu_id]) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="username">New Password</label>
                        <input type="password" name="password" class="form-control" placeholder="New Password">
                        @error('password')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                          <label class="form-label">Re-Type New Password</label>
                          <input type="password" name="password_confirmation" class="form-control" placeholder="Re-Type New Password">

                    </div>

                    <div class="form-group row m-t-20">
                        <div class="col-sm-6">
                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Set Password</button>
                        </div>
                    </div>

                    <div class="form-group m-t-10 mb-0 row">
                        <div class="col-12 m-t-20">
                            <a href="{{ route('reset.password') }}"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                        </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <script src="{{ asset('dashboard/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/misc.js') }}"></script>
    {{-- CDN --}}
    {{-- Toster Notification --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        @if(Session::has('success'))
            toastr["success"]("{{ Session::get('success') }}")
        @elseif(Session::has('error'))
            toastr["error"]("{{ Session::get('error') }}")
        @endif
    </script>

  </body>
</html>
