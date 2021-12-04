@extends('admin.layouts._master')



@section('content')
<div class="content-wrapper">

    @include('admin.layouts._page_header',['title'=>$page_title,'type'=>'List'])



      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{ $page_title }}</h4>


              <table class="table table-bordered">
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

                    @foreach ($books as $b=>$book)
                    <tr>
                        <td>
                            <div class="dropdown show">
                                <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                  <a class="dropdown-item text-dark" href="{{ route('admin.form.add-another-title',['id'=>$book->id]) }}"><i class="far fa-copy text-warning"></i> &nbsp; Add Another Title</a>
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








