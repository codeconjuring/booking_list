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
                                    <td style="background:{{ $status->color }}">{{ $status->status }}</td>
                                    @elseif($bookContent['text']==0)
                                    <td>{{ $bookContent['text'] }}</td>
                                    @else
                                    <td>N/A</td>
                                    @endif
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








