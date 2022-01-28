<!-- JAVASCRIPT -->
<script src="{{ asset('dashboard/update_assets/libs/jquery/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="{{ asset('dashboard/update_assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('dashboard/update_assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('dashboard/update_assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('dashboard/update_assets/libs/feather-icons/feather.min.js') }}"></script>
<!-- pace js -->
<script src="{{ asset('dashboard/update_assets/libs/pace-js/pace.min.js') }}"></script>

<!-- apexcharts -->
<script src="{{ asset('dashboard/update_assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('dashboard/update_assets/libs/raphael.min.js') }}"></script>
<script src="{{ asset('dashboard/update_assets/libs/morris.min.js') }}"></script>
<script src="{{ asset('dashboard/update_assets/js/pages/morris.init.js') }}"></script>

{{-- <script src="{{ asset('dashboard/update_assets/js/pages/apexcharts.init.js') }}"></script> --}}

<!-- dashboard init -->
<script src="{{ asset('dashboard/update_assets/js/app.js') }}"></script>
{{-- CDN --}}
{{-- Toster Notification --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{{-- Swtte alert --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- select2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@yield('script')

<script>

    // Toster notification
    @if(Session::has('success'))
        toastr["success"]("{{ Session::get('success') }}")
    @elseif(Session::has('error'))
        toastr["error"]("{{ Session::get('error') }}")
    @endif

    // Sweet alear
    function logout()
    {
        Swal.fire({
            title: 'Are you sure?',
            text: "Logout the system!!!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Logout it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.assign('/logout')
                }
            })
    }

    function makeDeleteRequest(event,id)
    {
        Swal.fire({
            title: 'Are you sure?',
            text: "Delete This!!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#deleteForm${id}`).submit();
                }
            })
    }

</script>

@yield('js')


