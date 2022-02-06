@extends('admin.layout._master')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
@endsection

@section('content')


<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Book Lists</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

    </div>
    <!-- container-fluid -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table cellpadding="2" class="cc-datatable table nowrap w-100 " id="myTable">
                        <thead>
                            <tr>
                                <th class="text-center">Sl</th>
                                <th class="text-center"> Lebel </th>
                                <th class="text-center">Type </th>
                                @canany(["Edit Book Attributes Format","Delete Book Attributes Format"])
                                <th class="text-center">Action</th>
                                @endcanany
                            </tr>
                        </thead>

                        <tbody id="tablecontents">

                            @php
                                $i=1;
                            @endphp
                            @foreach ($form_builders as $form_builder)
                                <tr class="row1 text-center" data-id="{{ $form_builder->id }}">
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{{ $form_builder->label }}</td>
                                    <td class="text-center">{{ $form_builder->type==0?"Text":"Dropdown" }}</td>
                                    @canany(["Edit Book Attributes Format","Delete Book Attributes Format"])
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <a class="btn cc-table-action p-0 dropdown-toggle" href="#"
                                                    id="dropdownMenuButton" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>

                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    @can('Edit Book Attributes Format')
                                                    <li><a class="dropdown-item" href="{{route('admin.form-builder.edit',$form_builder->id) }}"><i class="fas fa-edit"></i> Edit</a></li>
                                                    @endcan
                                                    @can('Delete Book Attributes Format')
                                                    <form action="{{ route('admin.form-builder.destroy', $form_builder->id) }}"  id="deleteForm{{ $form_builder->id }}" method="post" style="display: none">
                                                        @csrf
                                                        @method("DELETE")
                                                    </form>
                                                    <li><a class="dropdown-item text-danger" href="javascript:void(0)" onclick="makeDeleteRequest(event,{{ $form_builder->id}})"><i class="fas fa-trash-alt text-danger"></i> Delete</a></li>
                                                    @endcan
                                                </ul>
                                            </div>
                                        </td>
                                    @endcanany
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection


@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>


    <script type="text/javascript">
      $(function () {
        $("#myTable").DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                text: 'Create',
                action: function ( e, dt, node, config ) {
                    window.location ="{{ route('admin.form-builder.create') }}"
                }
            },
            'copy',
            'csv',
            'excel',
            'pdf',
            'print',

        ],
        // colReorder: true
    });

        $( "#tablecontents" ).sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
          update: function() {
              sendOrderToServer();
          }
        });

        function sendOrderToServer() {
          var order = [];
          var token = $('meta[name="csrf-token"]').attr('content');
          $('tr.row1').each(function(index,element) {
            order.push({
              id: $(this).attr('data-id'),
              position: index+1
            });
          });
          $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('admin.table.sort') }}",
                data: {
              order: order,
              _token: token
            },
            success: function(response) {
                if (response.status == "success") {
                  console.log(response);
                } else {
                  console.log(response);
                }
            }
          });
        }
      });
    </script>
@endsection

