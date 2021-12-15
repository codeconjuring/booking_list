@extends('admin.layouts._master')



@section('content')
<div class="content-wrapper">

    @include('admin.layouts._page_header',['title'=>$page_title,'type'=>'Form'])

      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{ $page_title }}</h4>
              <form class="forms-sample" action="{{ route('admin.form.update',$book_list->id) }}" method="POST">
                @csrf
                @method('put')


                <div class="form-group">
                    <label for="exampleInputUsername1">Language</label><span class="text-danger">*</span>
                    <select name="language" id="" required  class="form-control select2">
                        <option value="">Select Language</option>
                            @foreach($languages as $key=>$language)
                                <option {{ $book_list->language==$language->upper_case?'selected':"" }} value="{{ $language->upper_case }}">{{ $language->upper_case }}</option>
                            @endforeach
                        </select>

                    @error('language')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                  <label for="exampleInputUsername1">Series Name</label><span class="text-danger">*</span>

                    <select name="series_id" id="" required class="form-control select2">
                            <option value="">Select Series</option>
                        @foreach($series as $key=>$ser)
                            <option {{ $book_list->category_id==$ser->id?'selected':"" }} value="{{ $ser->id }}">{{ $ser->name }}</option>
                        @endforeach
                    </select>

                  @error('series_id')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" value="{{ $book_list->title }}" required class="form-control" placeholder="Title">
                    @error('title')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                @foreach($form_builder as $key=>$form_build)
                <div class="form-group">
                    <label for="exampleInputUsername1">{{ $form_build->label }}</label><span class="text-danger">*</span>

                    @if (array_key_exists($form_build->id,$book_list->content))
                        @if ($book_list->content[$form_build->id]['type']==1)

                            <select name="content[{{ $form_build->id }}][text]" id="" required class="form-control">
                                <option value="">Select Status</option>
                                @foreach($statues as $k=>$status)
                                    <option {{ $book_list->content[$form_build->id]['text']==$status->id?'selected':"" }} value="{{ $status->id }}">{{ $status->status }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="content[{{ $form_build->id }}][type]" value="1">
                        @else
                        <input type="text" class="form-control" value="{{ $book_list->content[$form_build->id]['text'] }}" name="content[{{ $form_build->id }}][text]" required placeholder="{{ $form_build->label }}">

                        <input type="hidden" name="content[{{ $form_build->id }}][type]" value="0">
                        @endif
                    @else
                        @if($form_build->type=="1")
                            <select name="content[{{ $form_build->id }}][text]" required id="" class="form-control">
                                <option value="">Select Status</option>
                                @foreach($statues as $k=>$status)
                                    <option value="{{ $status->id }}">{{ $status->status }}</option>
                                @endforeach
                            </select>

                            <input type="hidden" name="content[{{ $form_build->id }}][type]" value="1">

                        @elseif($form_build->type=="0")
                            <input type="text" class="form-control" name="content[{{ $form_build->id }}][text]" required placeholder="{{ $form_build->label }}">

                            <input type="hidden" name="content[{{ $form_build->id }}][type]" value="0">

                        @endif
                    @endif
                </div>
                @endforeach

                <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
                <a href="{{ url()->previous() }}" class="btn btn-light">Back</a>
              </form>
            </div>
          </div>
        </div>


      </div>


</div>


@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });

</script>

@endsection
