@extends('admin.layouts._master')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
@endsection

@section('content')
<div class="content-wrapper">

    @include('admin.layouts._page_header',['title'=>$page_title,'type'=>'List'])

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{ $page_title }}</h4>


              <table class="table table-bordered" id="myTable">
                <thead>
                  <tr>
                    <th>Sl</th>
                    <th> Lebel </th>
                    <th>Type </th>
                    @canany(["Edit Build Form","Delete Build Form"])
                    <th>Action</th>
                    @endcanany
                  </tr>
                </thead>
                <tbody id="tablecontents">
                    @php
                        $i=1;
                    @endphp
                    @foreach ($form_builders as $form_builder)
                        <tr class="row1" data-id="{{ $form_builder->id }}">
                            <td>{{ $i++ }}</td>
                            <td>{{ $form_builder->label }}</td>
                            <td>{{ $form_builder->type==0?"Text":"Dropdown" }}</td>
                            @canany(["Edit Build Form","Delete Build Form"])
                                <td>
                                    <div class="dropdown">
                                    <button class="btn btn-info btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @can('Edit Build Form')
                                        <a class="dropdown-item text-success" href="{{route('admin.form-builder.edit',$form_builder->id) }}" title="Edit Category">
                                        <i class="fas fa-edit"></i>&nbsp;Edit
                                        </a>
                                        @endcan
                                        @can('Delete Build Form')
                                        <form action="{{ route('admin.form-builder.destroy', $form_builder->id) }}"  id="deleteForm{{ $form_builder->id }}" method="post" style="display: none">
                                            @csrf
                                            @method("DELETE")
                                        </form>
                                        <a href="javascript:void(0)" class="dropdown-item text-danger" onclick="makeDeleteRequest(event,{{ $form_builder->id}})" title="Delete Role"><i class="fas fa-trash"></i>&nbsp;Delete</a>
                                        @endcan
                                    </div>
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
                text: 'Crate',
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

