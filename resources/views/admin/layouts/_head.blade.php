<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>{{ Settings::get('title')??"ztfbooks" }} | {{ $page_title??'' }}</title>
<link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/css/vendor.bundle.base.css') }}">
<link rel="stylesheet" href="{{ asset('dashboard/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('dashboard/assets/css/custome.css') }}">
<link rel="stylesheet" href="{{ asset('dashboard/assets/css/speedometer.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@if(Settings::get('favicon'))
    <link rel="shortcut icon" href="{{ asset(Storage::url(Settings::get('favicon'))) }}" />
@else
    <link rel="shortcut icon" href="{{ asset(config('settings.favicon')) }}" />
@endif

@yield('css')

{{-- CDN --}}
{{-- Toster Notification --}}
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
{{-- fontawesome --}}
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
{{-- select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
