@extends('layouts._master')

@section('content')
    <!-- Begin page -->
    <div id="layout-wrapper">
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">

                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                @if (Settings::get('site_logo'))
                                <a class="navbar-brand brand-logo" href="{{ route('admin.dashboard') }}"><img width="10%" src="{{ asset(Storage::url(Settings::get('site_logo'))) }}" alt="{{ Settings::get('title') }}" /></a>
                                @else
                                    <a class="navbar-brand brand-logo" href="{{ route('admin.dashboard') }}"><img width="10%" src="{{ asset(config('settings.site_logo')) }}" alt="{{ Settings::get('title') }}" /></a>
                                @endif
                                <div class="page-title-right">
                                    <a href="{{ route('login') }}" class="btn btn-primary">System Login</a>
                                </div>
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
                                <div class="cc-table-button-heads align-items-center d-flex justify-content-between">
                                    <ul class="list-unstyled d-flex ic-tables-buttons">
                                        <li>
                                            <button onclick="downloadReport()" class="btn tb-btn btn-outline-primary"><i class="icon-download"></i>Download Report</button>
                                        </li>
                                    </ul>
                                </div>
                                <table id="datatable"  class="dataTable table nowrap w-100">
                                    <thead>
                                        <tr>

                                            <th class="text-center d-none">Action</th>

                                            <th class="text-center"> Series </th>
                                            <th class="text-center"> No </th>
                                            <th class="text-center"> Author </th>
                                            {{-- <th class="text-center"> ZTF?</th> --}}
                                            {{-- <th class="text-center"> Tags </th> --}}
                                            <th class="text-center"> Title</th>
                                            <th class="text-center"> LAN </th>
                                            @foreach($form_builder as $key=>$form_bui)
                                                @if ($form_bui->label!='GFP')
                                                <th class="text-center">{{ $form_bui->label }}</th>
                                                @endif
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
                                                        $query=App\Models\BookList::query();
                                                        if(count($select_language)){
                                                            $query->whereIn('language',$select_language)->whereBookId($e->id);
                                                        }else{
                                                            $query->whereBookId($e->id);
                                                        }

                                                        if(count($select_ztf)>0){
                                                            $query->whereIn('available',$select_ztf);
                                                        }



                                                        $books=$query->get();


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

                                                        {{-- @php
                                                            $categories='';
                                                            foreach($book->categories as $cat){
                                                                if(!empty($cat->category)){
                                                                    $categories.='<span class="badge bg-primary mr-1">'.$cat->category->name.'</span>&nbsp;';
                                                                }
                                                            }
                                                        @endphp --}}
                                                        <tr class="tableAddTitles{{ $e->id }}">

                                                            <td class="text-center d-none">
                                                                <div class="dropdown">
                                                                    <a class="btn cc-table-action p-0 dropdown-toggle" href="#"
                                                                        role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                                        aria-expanded="false">
                                                                        <i class="fas fa-ellipsis-v"></i>
                                                                    </a>

                                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                        <li><a class="dropdown-item" href="#"><i class="mdi mdi-google-translate
                                                                            "></i> Add Translation</a></li>
                                                                        <li><a class="dropdown-item" href="#"><i class="fas fa-edit
                                                                            "></i> Edit</a></li>
                                                                        <li><a class="dropdown-item text-danger" href="#"><i
                                                                                    class="fas fa-trash-alt text-danger"></i> Delete</a>
                                                                        </li>
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

                                                            {{-- <td class="text-center">{!! $book->available_status!!}</td> --}}


                                                            {{-- <td class="text-center">{!! $categories !!}</td> --}}
                                                            @if (($main_title_flag==0) && ($filter_data!=1))
                                                            <td class="{{ $entry_id==$e->id?'bg-primary':'' }}"><b><a style="text-decoration: none; color:black" data-flag="0" id="mainTitle{{ $e->id }}" onclick="showMoreTitle('{{ $e->id }}','{{ $book_i }}',$(this).attr('data-flag'))" href="javascript:void(0)">{{ $book->title }} ({{ $entry_count }})</a><img width="10%" class="buffering-img{{ $e->id }} d-none" src="{{ asset('dashboard/assets/images/loading-buffering.gif') }}" alt=""></b></td>
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
                                                                @if ($form_bui->label!='GFP')
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

        </div>

    </div>


        {{-- Download Modal --}}

        <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Filter and export report and PDF</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('form.download') }}" method="GET">
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
                    <div class="form-group">
                        <label for="">ZTF?</label>
                        <select name="ztf[]" id="" class="form-control select2" multiple>
                            <option value="">Select ZTF</option>
                            @foreach ($ztf as $key=>$val)
                                <option {{ in_array($key,$select_ztf)?'selected':"" }} value="{{ $key }}">{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Download Report</button>

                    </form>
                </div>
              </div>
            </div>
          </div>



@endsection

@section('js')
<script>
    $(document).ready(function () {
        $("#datatable").DataTable();
        $(".dataTable").wrap('<div class="table-responsive"><div>');
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
        data:{'e_id':e_id,'book_i':book_i,'frontend_request':1},
        success:(response)=>{
            $(`.tableAddTitles${e_id}`).after(response.view);
            $(`.buffering-img${e_id}`).addClass('d-none');
            $(`#mainTitle${e_id}`).attr('data-flag',1);
            // $('.cc-datatable').DataTable();

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
    console.log('abcd');
    $('#myModal').modal('show');
    $('.select2').select2();

}
// Filter Colaps
function getFilter()
{
    $('.select2').select2();
}

// Col spand
// @if($entry_id!=0)
// $(document).ready( function () {
//     window.history.pushState({}, document.title, "/" + "admin/form");
// });
// @endif


</script>
@endsection