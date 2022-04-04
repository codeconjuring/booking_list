<table cellpadding="2" class="cc-datatable table nowrap w-100" id="myTable">
   <thead>
      <tr>
         <th class="text-center d-none">  </th>
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
      $more_tags = $categories.'<br/><span class="badge badge-primary mr-1">'.$cat->category->name.'</span>';
      }
      else if($tag_count > 1)
      {
      $more_tags.='<br/><span class="badge badge-primary mr-1">'.$cat->category->name.'</span>';
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
            @if($tag_count <= 1)
            <span>{!! $categories !!}
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
            </a><img width="10%"  class="buffering-img{{ $e->id }} d-none" src="{{ asset('dashboard/assets/images/loading-buffering.gif') }}" alt=""></b>
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
