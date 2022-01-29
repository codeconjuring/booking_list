@extends('admin.layout._master')

@section('css')

@endsection

@section('content')

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{ $page_title }}</h4>
                    <div class="page-title-right">
                        <a href="{{ route('admin.form.create') }}" class="btn btn-primary"><i data-feather="plus"></i> Create Book</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Filter Book List</h2>
                        </div>

                        <div class="col-md-6">
                            <button class="btn btn-primary btn-sm float-right" type="button" onclick="getFilter()" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </div>


                </div>


                    <div class="collapse" id="collapseExample">
                        <div class="card-body">
                            <form action="" method="get" class="form-group">

                                @csrf

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Select Series</label>
                                        <select name="series_ids[]" id="" class="form-control select2" multiple>
                                            <option value="">Select Series</option>
                                            @foreach ($series as $key=>$ser)
                                                <option {{ in_array($ser->id,$select_series)?"selected":"" }} value="{{ $ser->id }}">{{ $ser->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Select Languages</label>
                                        <select name="language[]" id="" class="form-control select2" multiple>
                                            <option value="">Select Series</option>
                                            @foreach ($languages as $key=>$lan)
                                                <option {{ in_array($lan->language,$select_language)?"selected":"" }} value="{{ $lan->language }}">{{ $lan->language }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Select Status</label>
                                        <select name="status_ids[]" id="" class="form-control select2" multiple>
                                            <option value="">Select Status</option>
                                            @foreach ($status as $sta)
                                                <option {{ in_array($sta->id,$select_status)?"selected":"" }} value="{{ $sta->id }}">{{ $sta->status }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 mt-2">
                                        <button type="submit" class="btn btn-info btn-sm">Search</button>
                                    </div>

                                </div>

                            </form>
                        </div>
                </div>


            </div>
        </div>
    </div>
    <br>
    <!-- container-fluid -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <table cellpadding="2" class="cc-datatable table nowrap w-100" id="myTable">
                        <thead>
                          <tr>
                            @canany(['Edit Book Management','Delete Book Management','Add Another Translation Book Management'])
                            <th class="text-center">Action</th>
                            @endcanany
                            <th class="text-center"> Series </th>
                            <th class="text-center"> No </th>
                            <th class="text-center"> Author </th>
                            <th class="text-center"> ZTF?</th>
                            <th class="text-center"> Tags </th>
                            <th class="text-center"> Title</th>
                            <th class="text-center"> LAN </th>
                            @foreach($form_builder as $key=>$form_bui)
                            <th class="text-center">{{ $form_bui->label }}</th>
                            @endforeach
                          </tr>
                        </thead>
                        <tbody>

                            @php
                                $book_i=1;
                                $row_count=0;
                            @endphp
                            @foreach ($getSeriyes as $key=>$getSeriye)
                                @php
                                    $entry=App\Models\Book::whereCategoryId($getSeriye->category_id)->get();

                                    $series_wise_titles=App\Models\BookList::whereCategoryId($getSeriye->category_id)->get();
                                    $books_count=count($series_wise_titles);
                                    $series_flag=0;

                                @endphp

                                @foreach ($entry as $e)

                                    @php
                                        if(count($select_language)){
                                            $books=App\Models\BookList::whereIn('language',$select_language)->whereBookId($e->id)->get();
                                        }else{
                                            $books=App\Models\BookList::whereBookId($e->id)->get();
                                        }

                                        $entry_count=count($books);
                                        $entry_flag=0;
                                        $main_title_flag=0;
                                    @endphp

                                        @foreach ($books as $b=>$book)


                                        @if ($filter_data!=1)
                                            @if (($main_title_flag==1) && ($entry_id!=$e->id))
                                                @break
                                            @endif
                                        @endif


                                        @if ($row_show!=0 && $row_count>=$row_show)
                                            @break
                                        @endif

                                        @php
                                            $categories='';
                                            foreach($book->categories as $cat){
                                                if(!empty($cat->category)){
                                                    $categories.='<span class="badge badge-primary mr-1">'.$cat->category->name.'</span>';
                                                }
                                            }
                                        @endphp
                                        <tr class="tableAddTitles{{ $e->id }}">
                                            <td class="text-center">

                                                <div class="dropdown">
                                                    <a class="btn cc-table-action p-0 dropdown-toggle" href="#"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>

                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                        @can('Add Another Translation Book Management')
                                                        <li><a class="dropdown-item {{ $book->add_another_book_translation==1?'d-none':'' }}" href="{{ route('admin.form.add-another-title',['id'=>$book->id]) }}"><i class="mdi mdi-google-translate"></i> Add Translation</a></li>
                                                        @endcan

                                                        @can('Edit Book Management')
                                                        <li><a class="dropdown-item" href="{{ route('admin.form.edit',$book->id) }}"><i class="fas fa-edit"></i> Edit</a></li>
                                                        @endcan

                                                        @can('Delete Book Management')
                                                        <form action="{{ route('admin.form.destroy',$book->id) }}" id="deleteForm{{ $book->id }}"  method="post">
                                                                @csrf
                                                                @method('delete')
                                                        </form>

                                                        <li><a class="dropdown-item text-danger" href="#" onclick="makeDeleteRequest(this,{{ $book->id }})"><i class="fas fa-trash-alt text-danger"></i> Delete</a></li>
                                                        @endcan
                                                    </ul>
                                                </div>

                                            </td>
                                            @if ($series_flag==0)
                                                <td class="text-center">{{ $book->serise->name }}</td>
                                                @php
                                                    $series_flag=1;
                                                @endphp

                                            @else
                                            <td class="text-center"></td>
                                            @endif

                                            @if ($entry_flag==0)
                                                <td class="text-center">{{ $book_i++ }}</td>
                                                @php
                                                    $entry_flag=1;
                                                @endphp
                                            @else
                                            <td class="text-center"></td>
                                            @endif

                                            <td class="text-center">{{ $book->author }}</td>

                                            <td class="text-center">{!! $book->available_status!!}</td>


                                            <td>{!! $categories !!}</td>
                                            @if (($main_title_flag==0) && ($filter_data!=1))
                                            <td class="{{ $entry_id==$e->id?'bg-primary':'' }}"><b><a style="text-decoration: none; color:black" data-flag="0" id="mainTitle{{ $e->id }}" onclick="showMoreTitle('{{ $e->id }}','{{ $book_i }}',$(this).attr('data-flag'))" href="javascript:void(0)">{{ $book->title }} ({{ $entry_count }})</a><img width="10%"  class="buffering-img{{ $e->id }} d-none" src="{{ asset('dashboard/assets/images/loading-buffering.gif') }}" alt=""></b></td>
                                            @else
                                            <td class="{{ $entry_id==$e->id?'bg-primary':'' }}">{{ $book->title }}</td>
                                            @endif

                                            <td class="text-center">{{ $book->language }}</td>
                                            @php
                                                $count_form_builder=count($form_builder);
                                                $book_content_count=count($book->content);
                                                $result=$count_form_builder-$book_content_count;
                                            @endphp
                                            @foreach ($form_builder as $form_bui)
                                                @if (array_key_exists($form_bui->id,$book->content))
                                                    @if ($book->content[$form_bui->id]['type']=="1")
                                                    @php
                                                                $query=App\Models\Status::query();
                                                                if(count($select_status)>0){
                                                                    $query->whereIn('id',$select_status)->whereId($book->content[$form_bui->id]['text']);
                                                                }else{
                                                                    $query->whereId($book->content[$form_bui->id]['text']);
                                                                }
                                                                $color=$query->first();
                                                    @endphp

                                                    <td class="text-center" style="background:{{ $color?$color->color:"" }}">{{ $status_array[$book->content[$form_bui->id]['text']]??'-' }}</td>
                                                    @else
                                                    <td class="text-center">{{ $book->content[$form_bui->id]['text']  }} </td>
                                                    @endif
                                                @else
                                                    <td class="text-center">-</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                                @php
                                                    $row_count+=1;
                                                @endphp

                                                @php
                                                    if($main_title_flag==0){
                                                        $main_title_flag=1;
                                                    }
                                                @endphp

                                            @endforeach
                                        @endforeach
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Download Modal --}}
<div class="modal" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Filter and export report and PDF</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.form.download') }}" method="GET">
                @csrf

            @foreach($form_builder as $key=>$form_bui)
                <input type="checkbox" name="select_row[]" id="inputlabel{{ $form_bui->id }}" value="{{ $form_bui->id }}">
                <label for="inputlabel{{ $form_bui->id }}">{{ $form_bui->label }}</label>
            @endforeach

            <div class="form-group">
                <label for="">Select Series</label>
                <select name="series[]" id="" class="form-control select2" multiple>
                    @foreach ($get_all_series as $get_all_ser)
                        <option value="{{ $get_all_ser->id }}">{{ $get_all_ser->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Select Tags</label>
                <select name="tag_ids[]" id="" class="form-control select2" multiple>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Select Language</label>
                <select name="languages[]" id="" class="form-control select2" multiple>
                    @foreach ($languages as $language)
                        <option value="{{ $language->language }}">{{ $language->language }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Select Status</label>
                <select name="status_ids[]" id="" class="form-control select2" multiple>
                    @foreach ($status as $sta)
                        <option value="{{ $sta->id }}">{{ $sta->status }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Download Report</button>

            </form>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>


@endsection


@section('js')


@endsection

@section('script')
<script>
    var mytable="";
    $(document).ready( function () {
        mytable=$('#myTable').DataTable({

        @if($paginate_range<=11)

        "pageLength": 10,

        @elseif($paginate_range>11 && $paginate_range<=26)

        "pageLength": 25,

        @elseif($paginate_range>26 && $paginate_range<=51)

        "pageLength": 50,

        @else

        "pageLength": 100,

        @endif
        "stateSave": true,
        // searching: false,
        // paging: true,
        // info: true

    });

    $(".dataTable").wrap('<div class="table-responsive"><div>');

    setTimeout(() => {
        $(window).scrollTop({{ $top_scroll }});
    }, 1000);


});



function showMoreTitle(e_id,book_i,data_attr)
{

    // console.log($(`#mainTitle${e_id}`).attr('data-flag'));


    $(`.buffering-img${e_id}`).removeClass('d-none');

    if(data_attr=='0')
    {

        $.ajax({
        url:"{{ route('form.show-more-title') }}",
        method:"GET",
        data:{'e_id':e_id,'book_i':book_i},
        success:(response)=>{
            $(`.tableAddTitles${e_id}`).after(response.view);
            $(`.buffering-img${e_id}`).addClass('d-none');
            $(`#mainTitle${e_id}`).attr('data-flag',1);
            $('#myTable').DataTable();

        },
        error:(error)=>{
            console.log(error);
        }

      });
    }else{
        $(`.buffering-img${e_id}`).addClass('d-none');
        $(`.subTitle${e_id}`).remove();
        $(`#mainTitle${e_id}`).attr('data-flag',0);
    }


    // let baseUrl=window.location.origin;
    // let scroll=$(window).scrollTop();
    // window.location.replace(baseUrl+'/admin/form?e_id='+e_id+'&book_i='+book_i+"&scroll="+scroll);

    //
}

function downloadReport(){
    $('#myModal').modal('show');
    $('.select2').select2();

}
// Filter Colaps
function getFilter()
{
    console.log('abcd');
    $('.select2').select2();
}
</script>

@endsection
