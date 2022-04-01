<table id="datatable" class="dataTable table nowrap w-100">
   <thead>
      <tr>
         <th class="text-center d-none">Action</th>
         <th class="text-center d-none"> Series </th>
         <th class="text-center"> No </th>
         <th class="text-center d-none"> Author </th>
         {{-- 
         <th class="text-center"> ZTF?</th>
         --}}
         {{-- 
         <th class="text-center"> Tags </th>
         --}}
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
               <a class="btn cc-table-action p-0 dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
               <i class="fas fa-ellipsis-v"></i>
               </a>
               <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item" href="#"><i class="mdi mdi-google-translate
                     "></i> Add Translation</a></li>
                  <li><a class="dropdown-item" href="#"><i class="fas fa-edit
                     "></i> Edit</a></li>
                  <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash-alt text-danger"></i> Delete</a>
                  </li>
               </ul>
            </div>
         </td>
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
         {{-- <td class="text-center">{{ $book->author }}</td> --}}
         
         {{-- <td class="text-center">{!! $book->available_status!!}</td> --}}
        
         {{-- 
         <td class="text-center">{!! $categories !!}</td>
         --}}
         @if (($main_title_flag==0) && ($filter_data!=1))
         <td class="{{ $entry_id==$e->id?'bg-primary':'' }}"><b><a style="text-decoration: none; color:black" href="{{route('get-book-details', ['id' => $book->id])}}">{{ $book->title }}</a><a style="text-decoration: none; color:black" data-flag="0" id="mainTitle{{ $e->id }}" onclick="showMoreTitle('{{ $e->id }}','{{ $book_i }}',$(this).attr('data-flag'))" href="javascript:void(0)"> (<span class="text-muted">{{ $entry_count.' Translations' }}</span>)
            @if($book->links)
            <a class="fas fa-external-link-alt" href="{{ $book->links }}" target="_blank" title="{{ $book->links }}"></a>
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
      {{-- @endforeach --}}
   </tbody>
</table>
