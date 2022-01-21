<script src="{{ asset('dashboard/assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/misc.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/dashboard.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/todolist.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/jquery-ui-git.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/speedometer.js') }}"></script>
@yield('js')
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
