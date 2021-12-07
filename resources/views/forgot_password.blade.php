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
                <h4>Forgot Password</h4>
                {{-- <h6 class="font-weight-light">Forgot Password.</h6> --}}
                <form class="form-horizontal m-t-30" action="{{ route('send.reset.password') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="username">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="username" value="{{ old('email') }}" placeholder="Enter Email" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror


                    </div>

                    <div class="form-group row m-t-20">
                        {{-- <div class="col-sm-6">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customControlInline">
                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                            </div>
                        </div> --}}
                        <div class="col-sm-6">
                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Forgot Password</button>
                        </div>
                    </div>

                    <div class="form-group m-t-10 mb-0 row">
                        <div class="col-12 m-t-20">
                            <a href="{{ route('login') }}"><i class="mdi mdi-lock"></i>Login</a>
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


