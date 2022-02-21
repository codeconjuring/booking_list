@extends('admin.layout._master')


@section('css')


@endsection

@section('content')


<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-xxl-10 col-12 m-auto">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{ $page_title }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

    </div>
    <!-- container-fluid -->

    <div class="row">
        <div class="col-xxl-10 col-12 m-auto">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cc-file-card">
                                <form action="#" class="dropzone">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple="multiple">
                                    </div>
                                    <div class="dz-message needsclick">
                                        <div class="mb-3 mt-3">
                                            <i class="display-4 text-muted text-yellow icon-image"></i>
                                        </div>

                                        <p> Drop book cover here, or <span class="text-yellow">browse</span>
                                        </p>
                                    </div>
                                </form>
                            </div>
                            <div class="cc-file-card">
                                <form action="#" class="dropzone">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple="multiple">
                                    </div>
                                    <div class="dz-message needsclick">
                                        <div class="mb-3 mt-3">
                                            <i class="display-4 text-muted text-yellow icon-epub"></i>
                                        </div>

                                        <p>Drop epub file here, or <span class="text-yellow">browse</span>
                                        </p>
                                    </div>
                                </form>
                            </div>
                            <div class="cc-file-card">
                                <form action="#" class="dropzone">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple="multiple">
                                    </div>
                                    <div class="dz-message needsclick">
                                        <div class="mb-3 mt-3">
                                            <i class="display-4 text-muted text-yellow icon-mp3"></i>
                                        </div>

                                        <p>Upload audio/mp3 file here, or <span
                                                class="text-yellow">browse</span>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-8">

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
                                        <select name="content[{{ $form_build->id }}][text]" id="" class="form-control select2">
                                            <option value="">Select Status</option>
                                            @foreach($statues as $k=>$status)
                                                <option {{ $form_build->default_status_id==$status->id?'selected':'' }} value="{{ $status->id }}">{{ $status->status }}</option>
                                            @endforeach
                                        </select>

                                        <input type="hidden" name="content[{{ $form_build->id }}][type]" value="1">

                                    @elseif($form_build->type=="0")
                                        <input type="text" class="form-control" name="content[{{ $form_build->id }}][text]" placeholder="{{ $form_build->label }}">

                                        <input type="hidden" name="content[{{ $form_build->id }}][type]" value="0">

                                    @endif
                                </div>
                                @endforeach



                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary mr-2">Create New</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-light">Back</a>
                                </div>

                              </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });

    let series='';
    let language='';


    // Select Series
    function selectSeries(val,type)
    {

        if(type=='series')
        {
            series=val;
        }else{
            language=val;
        }
        let val_data=validation(series,language);

        if(val_data)
        {
            $.ajax({
                url:'{{ route("admin.form.api_request") }}',
                method:"GET",
                data:{'series':series,'language':language},
                success:function(response){
                    $('#selectOption').html(' ');

                    console.log('response'+response);

                    if(response.titles.length>0){

                        console.log(response.titles);

                        // $('#selectOption').append(`<label for="exampleInputUsername1" class="">Title</label><span class="text-danger">*</span>
                        // <select name="title" class="form-control" id="selectTitle"></select>`);

                        $('#selectOption').append(`<label for="exampleInputUsername1" class="">Title</label><span class="text-danger">*</span>
                        <input type="text" list="selectTitle" name="title" required class="form-control"/><datalist id="selectTitle"></datalist>`);


                        $('#selectTitle').find('option').remove();

                        for (let index = 0; index < response.titles.length; index++) {
                            $('#selectTitle').append(`<option value="${response.titles[index].title}">${response.titles[index].title}</option>`);
                        }
                        // $('#selectTitle').select2();
                    }else{
                        console.log('input text');
                        $('#selectOption').append(`<label for="exampleInputUsername1" class="">Title</label><span class="text-danger">*</span><input type="text" name="title" class="form-control" required placeholder="Title">`);
                    }

                },
                error:function(err){
                    toastr["error"]("Something is problem");
                }
            });
        }

    }

    // Get language
    function getLanguage(series_id){
        $.ajax({
            url:"{{ route('admin.form.get-another-lanugage') }}",
            method:"get",
            data:{'series_id':series_id},
            success:function(response){

                $('#selectLanguage').find('option').remove();
                $('#selectLanguage').append(`<option value="">Select Language</option>`);
                for (let index = 0; index < response.languages.length; index++) {
                    $('#selectLanguage').append(`<option value="${response.languages[index]}">${response.languages[index]}</option>`);
                }

                $('#selectLanguage').select2();
            },
            error:function(error){
                toastr["error"](error);
            }
        });
    }

    function validation(s,l)
    {
        if((s==''))
        {
            if((s==''))
            {
                toastr["error"]("Pleas Select Series");
            }

        }else{
            return true;
        }

    }

</script>

@endsection
