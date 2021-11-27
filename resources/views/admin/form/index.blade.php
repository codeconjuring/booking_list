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
                    @foreach($form_builder->content as $key=>$form_bui)
                    <th>{{ $form_bui }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>

                    @php
                       $i=1;
                    @endphp

                    @foreach($books as $key=>$book)
                        <tr>
                            <td> {{ $book->serise->name }}</td>
                            <td> {{ $i++ }} </td>
                            <td> {{ $book->title }} </td>
                            <td> {{ $book->language }} </td>
                            @foreach($form_builder->content as $key=>$form_bui)
                                <td>{{ $book->content[$form_bui]??'N/A' }}</td>
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








