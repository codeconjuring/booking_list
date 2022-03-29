@foreach ($getBookLists as $key=>$getBookList)
<tr class="subTitle{{ $getBookList->book_id }}">
   <td class="text-center d-none"></td>
   <td class="text-center d-none"></td>
   <td class="text-center"></td>
   <td class="text-center">{{ $getBookList->titlewise_author }}</td>
   <td class="text-center {{ $frontend_request==1?'d-none':"" }}">{!! $getBookList->available_status !!}</td>
   @php
   $categories='';
   $more_tags = '';
   $tag_count = 0;
   foreach($getBookList->titlewise_tags as $cat){
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
   <td class="{{ $frontend_request==1?'d-none':"" }}">
   @if($tag_count <= 1)
   <span>{!! $categories !!}
   </span>
   @else
   <span id="spanmore{{$getBookList->id}}">
   {!! $categories !!}
   <small><a class="btn-sm text-dark" onclick="tag_span(1,{{$getBookList->id}})" href="javascript:void(0)">+</a></small>
   </span>
   <span class="d-none" id="spanless{{$getBookList->id}}">
   {!! $more_tags !!}
   <small><a class="btn-sm text-dark" onclick="tag_span(0,{{$getBookList->id}})" data-tag-span-id="spanmore{{$getBookList->id}}" href="javascript:void(0)">-</a></small>
   </span>
   @endif
   </td>
   <td class="">
      <a class="text-muted" href="{{ $frontend_request==1 ? route('get-book-details',['id'=>$getBookList->id]) : route('admin.form.get-book-details',['id'=>$getBookList->id]) }}">
      {{ $getBookList->title }} 
      </a>
      @if($getBookList->links != null)
      <a href="{{ $getBookList->links }}" class="fas fa-external-link-alt" target="_blank" title="{{ $getBookList->links }}">
      </a>
      @endif
   </td>
   <td class="text-center">{{ $getBookList->language }}</td>
   @php
   $count_form_builder=count($form_builder);
   $book_content_count=count($getBookList->content);
   $result=$count_form_builder-$book_content_count;
   @endphp
   @foreach ($form_builder as $form_bui)
   @if (($frontend_request==1))
   @if ($form_bui->label!='GFP')
   @if (array_key_exists($form_bui->id,$getBookList->content))
   @if ($getBookList->content[$form_bui->id]['type']=="1")
   @php
   $color=App\Models\Status::whereId($getBookList->content[$form_bui->id]['text'])->first();
   @endphp
   <td class="text-center" style="background:{{ $color?$color->color:"" }}">{{ $status_array[$getBookList->content[$form_bui->id]['text']]??'-' }}</td>
   @else
   <td class="text-center">{{ $getBookList->content[$form_bui->id]['text']  }} </td>
   @endif
   @else
   <td class="text-center">-</td>
   @endif
   @endif
   @else
   @if (array_key_exists($form_bui->id,$getBookList->content))
   @if ($getBookList->content[$form_bui->id]['type']=="1")
   @php
   $color=App\Models\Status::whereId($getBookList->content[$form_bui->id]['text'])->first();
   @endphp
   <td class="text-center" style="background:{{ $color?$color->color:"" }}">{{ $status_array[$getBookList->content[$form_bui->id]['text']]??'-' }}</td>
   @else
   <td class="text-center">{{ $getBookList->content[$form_bui->id]['text']  }} </td>
   @endif
   @else
   <td class="text-center">-</td>
   @endif
   @endif
   @endforeach
   <td class="{{ $frontend_request==1?'d-none':"" }} text-center">
   <div class="dropdown">
      <a class="btn cc-table-action p-0 dropdown-toggle" href="#"
         id="dropdownMenuButton" data-toggle="dropdown"
         aria-expanded="false">
      <i class="fas fa-ellipsis-v"></i>
      </a>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
         @can('Edit Book Management')
         <li><a class="dropdown-item" href="{{ route('admin.form.edit',$getBookList->id) }}"><i class="fas fa-edit"></i> Edit</a></li>
         @endcan
         @can('Delete Book Management')
         <form action="{{ route('admin.form.destroy',$getBookList->id) }}" id="deleteForm{{ $getBookList->id }}"  method="post">
            @csrf
            @method('delete')
         </form>
         <li><a class="dropdown-item text-danger" href="#" onclick="makeDeleteRequest(this,{{ $getBookList->id }})"><i class="fas fa-trash-alt text-danger"></i> Delete</a></li>
         @endcan
      </ul>
   </div>
   </td>
</tr>
@endforeach
