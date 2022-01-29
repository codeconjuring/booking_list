@foreach ($getBookLists as $key=>$getBookList)


<tr class="subTitle{{ $getBookList->book_id }}">
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

                <li><a class="dropdown-item text-danger" href="#" nclick="makeDeleteRequest(this,{{ $getBookList->id }})"><i class="fas fa-trash-alt text-danger"></i> Delete</a></li>
                @endcan
            </ul>
        </div>
    </td>

    <td class="text-center"></td>



    <td class="text-center"></td>


    <td class="text-center">{{ $getBookList->author }}</td>

    <td class="text-center {{ $frontend_request==1?'d-none':"" }}">{!! $getBookList->available_status !!}</td>

    @php
        $categories='';
        foreach($getBookList->categories as $cat){
            if($cat->category){
                $categories.='<span class="badge bg-primary mr-1">'.$cat->category->name.'</span>&nbsp;';
            }
        }
    @endphp
    <td class="{{ $frontend_request==1?'d-none':"" }}">{!! $categories !!}</td>

    <td class="">{{ $getBookList->title }}</td>

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
</tr>
@endforeach
