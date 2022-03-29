<meta charset="utf-8" />
<title>{{ Settings::get('title')??"ztfbooks" }} | {{ $page_title??'' }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="themessani" name="author" />
<!-- App favicon -->
<meta name="csrf-token" content="{{ csrf_token() }}">
@if(Settings::get('favicon'))
<link rel="shortcut icon" href="{{ asset(Storage::url(Settings::get('favicon'))) }}" />
@else
<link rel="shortcut icon" href="{{ asset(config('settings.favicon')) }}" />
@endif

<!-- preloader css -->
<link rel="stylesheet" href="{{ asset('dashboard/update_assets/css/preloader.min.css') }}" type="text/css" />
<!-- DataTables -->
<link href="{{ asset('dashboard/update_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}"
    rel="stylesheet" type="text/css" />
<link href="{{ asset('dashboard/update_assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
    rel="stylesheet" type="text/css" />

<!-- Bootstrap Css -->
<link href="{{ asset('dashboard/update_assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dashboard/update_assets/icomoon/icon-moons.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dashboard/update_assets/css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ asset('dashboard/update_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />


<link href="{{ asset('dashboard/update_assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dashboard/update_assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('dashboard/update_assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

{{-- Toster Notification --}}
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
{{-- select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- App Css-->
<link href="{{ asset('dashboard/update_assets/css/custome.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dashboard/update_assets/css/style.css') }}" rel="stylesheet" type="text/css" />



@yield('css')