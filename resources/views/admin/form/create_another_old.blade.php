@extends('admin.layouts._master')



@section('content')
<div class="content-wrapper">

    @include('admin.layouts._page_header',['title'=>$page_title,'type'=>'Form'])

      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{ $page_title }}</h4>
              <form class="forms-sample" action="{{ route('admin.add-another-book-list') }}" method="POST">
                @csrf

                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <div class="form-group">
                    <input type="hidden" name="series_id" value="{{ $series->id }}">

                  @error('series_id')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputUsername1">Title</label><span class="text-danger">*</span>
                    <input type="text" name="title" class="form-control" placeholder="Title">

                    @error('title')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputUsername1">Language</label><span class="text-danger">*</span>
                    <select name="language" id="" class="form-control select2">
                        <option value="">Select Language</option>
                            @foreach($new_languages as $key=>$new_language)
                                <option value="{{ $new_language }}">{{ $new_language }}</option>
                            @endforeach
                        </select>

                    @error('language')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- <div class="form-group">
                    <label for="exampleInputUsername1">Category</label><span class="text-danger">*</span>
                    <select name="categorys[]" id="" required class="form-control select2" multiple>
                            @foreach($categories as $categorie)
                                <option {{ in_array($categorie->id,$selected_categorys)?'selected':'' }} value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                            @endforeach
                        </select>

                    @error('categorys')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}

                {{-- <div class="form-group">
                    <label for="exampleInputUsername1">Author</label><span class="text-danger">*</span>

                    <input type="text" list="selectAuthor" name="author" value="{{ $book_list->author }}" required class="form-control" autocomplete="off"/>
                    <datalist id="selectAuthor">
                        @foreach ($authors as $author)
                            <option value="{{ $author->author }}">{{ $author->author }}</option>
                        @endforeach
                    </datalist>
                    @error('author')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}

                @foreach($form_builder as $key=>$form_build)
                <div class="form-group">
                    <label for="exampleInputUsername1">{{ $form_build->label }}</label><span class="text-danger">*</span>


                    @if($form_build->type=="1")
                        <select name="content[{{ $form_build->id }}][text]" id="" class="form-control">
                            <option value="">Select Status</option>
                            @foreach($statues as $k=>$status)
                                <option value="{{ $status->id }}">{{ $status->status }}</option>
                            @endforeach
                        </select>

                        <input type="hidden" name="content[{{ $form_build->id }}][type]" value="1">

                    @elseif($form_build->type=="0")
                        <input type="text" class="form-control" name="content[{{ $form_build->id }}][text]" placeholder="{{ $form_build->label }}">

                        <input type="hidden" name="content[{{ $form_build->id }}][type]" value="0">

                    @endif
                </div>
                @endforeach

                {{-- <div class="form-group">
                    <label for="">Handwritten by ZTF</label>
                    <p><input type="radio" checked name="available" value="0"> No&nbsp;<input type="radio"  name="available" value="1"> Yes&nbsp;<input type="radio" name="available" value="2"> Not available</p>

                    @error('available')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}

                <button type="submit" class="btn btn-gradient-primary mr-2">Create New</button>
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
