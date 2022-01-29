<script src="{{ asset('dashboard/assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/misc.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/dashboard.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/todolist.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/jquery-ui-git.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/speedometer.js') }}"></script>

<script src="{{ asset('dashboard/update_assets/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('dashboard/update_assets/js/pages/select2.init.js') }}"></script>
<script src="{{ asset('dashboard/update_assets/libs/dropzone/min/dropzone.min.js') }}"></script>

{{-- CDN --}}
{{-- Toster Notification --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{{-- Swtte alert --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@yield('js')

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


