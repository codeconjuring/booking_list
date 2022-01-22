@foreach ($getBookLists as $key=>$getBookList)


<tr class="subTitle{{ $getBookList->book_id }}">
    <td class="{{ $frontend_request==1?'d-none':"" }}">
        <div class="dropdown show">
            <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            {{-- @can('Add Another Translation Book Management')
                <a class="dropdown-item text-dark {{ $getBookList->add_another_book_translation==1?'d-none':'' }}" href="{{ route('admin.form.add-another-title',['id'=>$getBookList->id]) }}"><i class="far fa-copy text-warning"></i> &nbsp; Add Another Translation</a>
            @endcan --}}

            @can('Edit Book Management')
            <a class="dropdown-item text-dark" href="{{ route('admin.form.edit',$getBookList->id) }}"><i class="fas fa-edit text-info"></i> &nbsp; Edit</a>
            @endcan
            @can('Delete Book Management')
            <form action="{{ route('admin.form.destroy',$getBookList->id) }}" id="deleteForm{{ $getBookList->id }}"  method="post">
                    @csrf
                    @method('delete')
            </form>
            <a class="dropdown-item text-dark" href="#" onclick="makeDeleteRequest(this,{{ $getBookList->id }})"><i class="fas fa-trash-alt text-danger"></i> &nbsp; Delete</a>
            @endcan
        </div>
        </div>
    </td>

    <td></td>



    <td></td>


    <td>{{ $getBookList->author }}</td>

    <td>{!! $getBookList->available_status !!}</td>

    @php
        $categories='';
        foreach($getBookList->categories as $cat){
            $categories.='<span class="badge badge-primary mr-1">'.$cat->category->name.'</span>';
        }
    @endphp
    <td>{!! $categories !!}</td>



    <td class="">{{ $getBookList->title }}</td>


    <td>{{ $getBookList->language }}</td>
    @php
        $count_form_builder=count($form_builder);
        $book_content_count=count($getBookList->content);
        $result=$count_form_builder-$book_content_count;
    @endphp
    @foreach ($form_builder as $form_bui)

        @if (array_key_exists($form_bui->id,$getBookList->content))
            @if ($getBookList->content[$form_bui->id]['type']=="1")
            @php
                $color=App\Models\Status::whereId($getBookList->content[$form_bui->id]['text'])->first();
            @endphp

            <td style="background:{{ $color?$color->color:"" }}">{{ $status_array[$getBookList->content[$form_bui->id]['text']]??'-' }}</td>
            @else
            <td>{{ $getBookList->content[$form_bui->id]['text']  }} </td>
            @endif
        @else
            <td>-</td>
        @endif

    @endforeach
</tr>
@endforeach
