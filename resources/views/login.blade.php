<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bookign List</title>
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
                  <img src="{{ asset('dashboard/assets/images/logo.svg') }}">
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3" action="{{ route('login') }}" method="post">
                    @csrf
                  <div class="form-group">
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">

                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN </button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                    </div>
                    <a href="#" class="auth-link text-black">Forgot password?</a>
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
