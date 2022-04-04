@extends('admin.layout._master')
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/datatables.mark.js/2.0.0/datatables.mark.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.min.css">
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
                  {{-- @can('Download Report Book Management')
                  <a href="#" onclick="downloadReport()" class="btn btn-primary"><i class="fas fa-download"></i> &nbsp;Download Report</a>
                  @endcan --}}
               </div>
            </div>
         </div>
      </div>
      <!-- end page title -->
   </div>
   {{--
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
                        <div class="col-md-3">
                           <label for="">Select Series</label>
                           <select name="series_ids[]" id="" class="form-control select2" multiple>
                              <option value="">Select Series</option>
                              @foreach ($series as $key=>$ser)
                              <option {{ in_array($ser->id,$select_series)?"selected":"" }} value="{{ $ser->id }}">{{ $ser->name }}</option>
   @endforeach
   </select>
</div>
<div class="col-md-3">
   <label for="">Select Languages</label>
   <select name="language[]" id="" class="form-control select2" multiple>
      <option value="">Select Series</option>
      @foreach ($languages as $key=>$lan)
      <option {{ in_array($lan->language,$select_language)?"selected":"" }} value="{{ $lan->language }}">{{ $lan->language }}</option>
      @endforeach
   </select>
</div>
<div class="col-md-3">
   <label for="">Select Status</label>
   <select name="status_ids[]" id="" class="form-control select2" multiple>
      <option value="">Select Status</option>
      @foreach ($status as $sta)
      <option {{ in_array($sta->id,$select_status)?"selected":"" }} value="{{ $sta->id }}">{{ $sta->status }}</option>
      @endforeach
   </select>
</div>
<div class="col-md-3">
   <label for="">ZTF?</label>
   <select name="ztf[]" id="" class="form-control select2" multiple>
      <option value="">Select ZTF</option>
      @foreach ($ztf as $key=>$val)
      <option {{ in_array($key,$select_ztf)?'selected':"" }} value="{{ $key }}">{{ $val }}</option>
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
--}}
<!-- container-fluid -->
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-body" id="serieswise_table_div">
            <table cellpadding="2" class="cc-datatable table nowrap w-100" id="myTable">
               <thead>
                  <tr>
                     <th class="text-center d-none"> </th>
                     <th class="text-center d-none"> Series </th>
                     <th class="text-center"> No </th>
                     <th class="text-center"> Author </th>
                     <th class="text-center"> ZTF?</th>
                     <th class="text-center"> Tags </th>
                     <th class="text-center"> Title</th>
                     <th class="text-center"> LAN </th>
                     @foreach($form_builder as $key=>$form_bui)
                     <th class="text-center">{{ $form_bui->label }}</th>
                     @endforeach
                     @canany(['Edit Book Management','Delete Book Management','Add Another Translation Book Management'])
                     <th class="text-center">Action</th>
                     @endcanany
                  </tr>
               </thead>
               <tbody>
                  @php
                  $book_i=1;
                  $row_count=0;
                  @endphp
                  {{-- @foreach ($getSeriyes as $key=>$getSeriye) --}}
                  @php
                  $entry=App\Models\Book::whereCategoryId($selected_series_id)->get();
                  $series_wise_titles=App\Models\BookList::whereCategoryId($selected_series_id)->get();
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
                  {{-- @break --}}
                  @endif
                  @endif
                  @if ($row_show!=0 && $row_count>=$row_show)
                  @break
                  @endif
                  @php
                  $categories='';
                  $more_tags = '';
                  $tag_count = 0;
                  foreach($book->titlewise_tags as $cat){
                  if(!empty($cat->category)){
                  if($tag_count == 1)
                  {
                  $more_tags = $categories.'<br /><span class="badge badge-primary mr-1">'.$cat->category->name.'</span>';
                  }
                  else if($tag_count > 1)
                  {
                  $more_tags.='<br /><span class="badge badge-primary mr-1">'.$cat->category->name.'</span>';
                  }
                  else
                  {
                  $categories.='<span class="badge badge-primary mr-1">'.$cat->category->name.'</span>';
                  }
                  $tag_count += 1;
                  }
                  }
                  @endphp
                  <tr class="tableAddTitles{{ $e->id }} {{ $main_title_flag ==1 ? "translation_row d-none": '' }}">
                     <td class="d-none">-</td>
                     @if ($series_flag==0)
                     <td class="text-center d-none">{{ $book->serise->name }}</td>
                     @php
                     $series_flag=1;
                     @endphp
                     @else
                     <td class="text-center d-none"></td>
                     @endif
                     @if ($entry_flag==0)
                     <td class="text-center">{{ $book_i++ }}</td>
                     @php
                     $entry_flag=1;
                     @endphp
                     @else
                     <td class="text-center"></td>
                     @endif
                     <td class="text-center">{{ $book->titlewise_author }}</td>
                     <td class="text-center">{!! $book->available_status!!}</td>
                     <td>
                        @if($tag_count <= 1) <span>{!! $categories !!}
                           </span>
                           @else
                           <span class="translation_tags_main" id="spanmore{{$book->id}}">
                              {!! $categories !!}
                              <small><a class="btn-sm text-dark" onclick="tag_span(1,{{$book->id}})" href="javascript:void(0)">+</a></small>
                           </span>
                           <span class="translation_tags d-none" id="spanless{{$book->id}}">
                              {!! $more_tags !!}
                              <small><a class="btn-sm text-dark" onclick="tag_span(0,{{$book->id}})" data-tag-span-id="spanmore{{$book->id}}" href="javascript:void(0)">-</a></small>
                           </span>
                           @endif
                     </td>
                     @if (($main_title_flag==0) && ($filter_data!=1))
                     <td class="{{ $entry_id==$e->id?'bg-primary':'' }}"><b><a style="text-decoration: none; color:black" href="{{route('admin.form.get-book-details',['id'=>$book->id]) }}">{{ $book->title }} <a style="text-decoration: none; color:black" data-flag="0" id="mainTitle{{ $e->id }}" onclick="showMoreTitle('{{ $e->id }}','{{ $book_i }}',$(this).attr('data-flag'))" href="javascript:void(0)">(<span class="text-muted">{{ $entry_count.' Translations' }}</span>)</a>
                              @if($book->links != null)
                              <a href="{{$book->links}}" target="_blank" class="fas fa-external-link-alt" title="{{$book->links}}"></a>
                              @endif
                           </a><img width="10%" class="buffering-img{{ $e->id }} d-none" src="{{ asset('dashboard/assets/images/loading-buffering.gif') }}" alt=""></b>
                     </td>
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
                     <td class="text-center">
                        <div class="dropdown">
                           <a class="btn cc-table-action p-0 dropdown-toggle" href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
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
                              <form action="{{ route('admin.form.destroy',$book->id) }}" id="deleteForm{{ $book->id }}" method="post">
                                 @csrf
                                 @method('delete')
                              </form>
                              @php
                              $translations_count = 2;
                              @endphp
                              @if($book->add_another_book_translation == 0)
                              @php
                              $translations_count = App\Models\BookList::whereBookId($book->book_id)->count();
                              @endphp
                              @endif
                              @if($translations_count > 1 && $book->add_another_book_translation == 0)
                              <li><a class="dropdown-item text-danger" href="#" onclick="prompt('You need to delete the translations of this title before deleting it!')"><i class="fas fa-trash-alt text-danger"></i> Delete</a></li>
                              @else
                              <li><a class="dropdown-item text-danger" href="#" onclick="makeDeleteRequest(this,{{ $book->id }})"><i class="fas fa-trash-alt text-danger"></i> Delete</a></li>
                              @endif
                              @endcan
                           </ul>
                        </div>
                     </td>
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
                  {{-- @endforeach --}}
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
         <div class="modal-footer">
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
<script src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js),datatables.mark.js"></script>
<script src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"></script>
@endsection
@section('script')
<script>
   var mytable="";
   $(document).ready( function () {
   
   
   // $('#myTable').dataTable({
   //     dom: 'Bfrtip',
   //     buttons: [
   //         {
   //             text: 'Create',
   //             action: function ( e, dt, node, config ) {
   //                 window.location =""
   //             }
   //         },
   //         'copy',
   //         'csv',
   //         'excel',
   //         'pdf',
   //         'print',
   
   //     ],
   //     language: {
   //         paginate: {
   //         next: '<i class="icon-right-arrow"></i>',
   //         previous: '<i class="icon-left-arrow"></i>',
   //         },
   //         searchPlaceholder: "Search",
   //         search: '<i class="fas fa-search"></i>',
   //     },
   //     });
   
   // $(".dataTable").wrap('<div class="table-responsive"><div>');
   
       var table = $('#myTable').DataTable({
       dom: '<"toolbar">Bftip',
       pageLength: 50,
       columnDefs: [
         { "searchable": false, "targets": -1 }
       ],
       mark: true,
       buttons:
       [
   
           {
           text: 'Report',
               action: function ( e, dt, node, config ) {
                   downloadReport()
               }
           },
           'copy',
           'csv',
           'excel'
       ]
   });
   addSeriesDropdown({{ $selected_series_id }});
   $('.dataTable').wrap('<div class="table-responsive"></div>');
   tableAdjustments();
   // $("div.toolbar").html('<b class="float-right mt-1">Download As: &nbsp; </b>');
   
   // table.buttons().container().appendTo($('#printbar'));
   // table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
   
   
   });
   
   function tableAdjustments()
   {
      $('#myTable_info').addClass('d-none');

      // $("#myTable_filter").find("label input[type='search']").on('focus',function(){
      //    if($(".translation_row").hasClass('d-none'))
      //    {
      //       $(".translation_row").removeClass('d-none');
      //    }
      // });   
      $("#myTable_filter").find("label input[type='search']").on('blur',function(){
         if($("#myTable_filter").find("label input[type='search']").val().length <= 0)
         {
            if(!$(".translation_tags").hasClass('d-none'))
            {
               console.log("Blur: trans tags");
               $(".translation_tags").addClass('d-none');
            }
            if($(".translation_tags_main").hasClass('d-none'))
            {
               console.log("Blur: trans tags main");
               $(".translation_tags_main").removeClass('d-none'); 
            }
            if(!$(".translation_row").hasClass('d-none'))
            {
               console.log("Blur: trans row");
               $(".translation_row").addClass('d-none'); 
            }
         }
      });   
      $("#myTable_filter").find("label input[type='search']").on('keyup',function(){
         if($("#myTable_filter").find("label input[type='search']").val().length <= 0)
         {
            if($(".translation_tags").hasClass('d-none') == false)
            {
               console.log("keyup: trans tags");
               $(".translation_tags").addClass('d-none');
            }
            if($(".translation_tags_main").hasClass('d-none'))
            { 
               console.log("keyup: trans tags main");
               $(".translation_tags_main").removeClass('d-none'); 
            }
            if(!$(".translation_row").hasClass('d-none'))
            {
               console.log("keyup: trans rows");
               $(".translation_row").addClass('d-none'); 
            }
         }
         else if($("#myTable_filter").find("label input[type='search']").val().length > 0)
         {
            if($(".translation_row").hasClass('d-none'))
            {
               $(".translation_row").removeClass('d-none'); 
            }
            if(!$(".translation_tags_main").hasClass('d-none'))
            { 
               $(".translation_tags_main").addClass('d-none'); 
            }
            if($(".translation_tags").hasClass('d-none'))
            {
               $(".translation_tags").removeClass('d-none');
            }
         }
      });      
   }

   function addSeriesDropdown(selected_series_id)
   {
      var options = ''; var current_series_id = 0;
       @foreach ($get_all_series as $series)
         current_series_id = {{ $series->id }};
         if(current_series_id == selected_series_id){
          options += '<option class="bg-light text-dark" selected value="{{ $series->id }}">'+'{{ $series->name }}'+'</option>';
         }
         else{
          options += '<option class="bg-light text-dark" value="{{ $series->id }}">'+'{{ $series->name }}'+'</option>';
         }
       @endforeach
      $(".dt-buttons").prepend('<select id="series_list_id" class="btn btn-lg-outline px-0 ml-1 mr-1" style="height:46px;" onchange="loadSeriesWiseAjaxTable();">'+options+'</select>');
   }
   
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

   function downloadReport() {
      $('#myModal').modal('show');
      $('.select2').select2();

   }
   // Filter Colaps
   function getFilter() {
      console.log('abcd');
      $('.select2').select2();
   }

   function loadSeriesWiseAjaxTable() {
      console.log('Series: ' + $('#series_list_id').val());
      var series_id = $('#series_list_id').val();

      $.ajax({
         url: "{{ route('admin.form.index') }}",
         method: "GET",
         data: {
            selected_series_id: series_id,
            load_ajax_view: 1
         },
         success: function(response) {
            console.log(response.html);
            $('#serieswise_table_div').html('');
            $('#serieswise_table_div').html(response.html);
            $('#myTable').DataTable({
               dom: '<"toolbar">Bftip',
               pageLength: 50,
               columnDefs: [
                 { "searchable": false, "targets": -1 }
               ],
               mark: true,
               buttons: [

                  {
                     text: 'Report',
                     action: function ( e, dt, node, config ) {
                              downloadReport()
                     }
                  },
                  'copy',
                  'csv',
                  'excel'
               ]
            });
            addSeriesDropdown(series_id);
            $('.dataTable').wrap('<div class="table-responsive"></div>');
            tableAdjustments();
         }
      });
   }
</script>
@endsection