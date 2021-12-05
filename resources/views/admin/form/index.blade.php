@extends('admin.layouts._master')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">

@endsection


@section('content')
<div class="content-wrapper">

    @include('admin.layouts._page_header',['title'=>$page_title,'type'=>'List'])



      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{ $page_title }}
                <a href="{{ route('admin.form.download') }}" class="btn btn-info btn-sm float-right mb-1"><i class="fas fa-download"></i> &nbsp;Download Report</a>
            </h4>


              <table class="table table-bordered" id="myTable">
                <thead>
                  <tr>
                    <th>Action</th>
                    <th> Serise </th>
                    <th> No </th>
                    <th> Title</th>
                    <th> LAN </th>
                    @foreach($form_builder as $key=>$form_bui)
                    <th>{{ $form_bui->label }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>

                    @php
                        $i=1;
                    @endphp
                    @foreach ($getSeriyes as $key=>$getSeriye)

                        @php
                            $books=App\Models\BookList::whereCategoryId($getSeriye->category_id)->get();

                        @endphp


                        @foreach ($books as $b=>$book)

                            <tr>
                                <td>
                                    <div class="dropdown show">
                                        <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item text-dark" href="{{ route('admin.form.add-another-title',['id'=>$book->id]) }}"><i class="far fa-copy text-warning"></i> &nbsp; Add Another Translation</a>
                                        <a class="dropdown-item text-dark" href="#"><i class="fas fa-edit text-info"></i> &nbsp; Edit</a>
                                        <form action="{{ route('admin.form.destroy',$book->id) }}" id="deleteForm{{ $book->id }}"  method="post">
                                                @csrf
                                                @method('delete')
                                        </form>
                                        <a class="dropdown-item text-dark" href="#" onclick="makeDeleteRequest(this,{{ $book->id }})"><i class="fas fa-trash-alt text-danger"></i> &nbsp; Delete</a>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $book->serise->name }}</td>
                                <td>{{ $i++ }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->language }}</td>
                                @php
                                    $count_form_builder=count($form_builder);
                                    $book_content_count=count($book->content);
                                    $result=$count_form_builder-$book_content_count;
                                @endphp
                                @foreach ($form_builder as $form_bui)
                                            @foreach ($book->content as $bc=>$bookContent)

                                                @if($form_bui->id==$bc)
                                                    @if($bookContent['type']=='1')
                                                        @php
                                                            $status=App\Models\Status::whereId($bookContent['text'])->first();
                                                        @endphp
                                                    <td style="background:{{ $status?$status->color:'' }}">{{ $status?$status->status:'N/A' }}</td>
                                                    @elseif($bookContent['text']==0)
                                                    <td>{{ $bookContent['text'] }}</td>
                                                    @else
                                                    <td>N/A</td>
                                                    @endif
                                                @else
                                                @endif

                                            @endforeach

                                @endforeach
                                    @for ($i = 0; $i < $result; $i++)
                                    <td>N/A</td>
                                    @endfor
                                        </tr>
                                @endforeach
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
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>

<script>
    $(document).ready( function () {
    $('#myTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
} );
</script>
@endsection







