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

   <!-- Required datatable js -->
   <script src="{{ asset('dashboard/update_assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('dashboard/update_assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
   <!-- Buttons examples -->
   <script src="{{ asset('dashboard/update_assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
   <script src="{{ asset('dashboard/update_assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('dashboard/update_assets/libs/jszip/jszip.min.js') }}"></script>
   <script src="{{ asset('dashboard/update_assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
   <script src="{{ asset('dashboard/update_assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
   <script src="{{ asset('dashboard/update_assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
   <script src="{{ asset('dashboard/update_assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
   <script src="{{ asset('dashboard/update_assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

   <!-- Responsive examples -->
   <script src="{{ asset('dashboard/update_assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
   <script src="{{ asset('dashboard/update_assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>


   <!-- Datatable init js -->
   <script src="{{ asset('dashboard/update_assets/libs/select2/js/select2.min.js') }}"></script>
   <script src="{{ asset('dashboard/update_assets/js/pages/select2.init.js') }}"></script>
   <!-- dropzone js -->
   <script src="{{ asset('dashboard/update_assets/libs/dropzone/min/dropzone.min.js') }}"></script>

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


@yield('js')

@yield('script')

<script>

    // Toster notification
    @if(Session::has('success'))
        toastr["success"]("{{ Session::get('success') }}")
    @elseif(Session::has('error'))
        toastr["error"]("{{ Session::get('error') }}")
    @endif



    $(()=>{
        if(localStorage.getItem('sideBar')==1){
            $('#vertical-menu-btn').click();
        }
    });





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
    function prompt(prompt_string)
    {
        Swal.fire({
            title: 'Info',
            text: prompt_string,
            icon: 'warning',
            });
    }
    function tag_span(flag, book_id)
    {
        if(flag == 0)
        {
          $('#spanless'+book_id).addClass('d-none')
          $('#spanmore'+book_id).removeClass('d-none')
        }
        else if(flag == 1)
        {
          $('#spanmore'+book_id).addClass('d-none')
          $('#spanless'+book_id).removeClass('d-none')
        }
    }

</script>




