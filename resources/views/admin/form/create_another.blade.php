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
                                <form action="{{ route('admin.add-another-book-list') }}" method="POST" class="dropzone" id="coverFormId" enctype="multipart/form-data">
                                    @csrf
                                    <div class="fallback">
                                        <input name="cover" type="file" multiple="multiple">
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
                                <form action="{{ route('admin.add-another-book-list') }}" method = "POST" class="dropzone" id="epubFormId" enctype="multipart/form-data">
                                    @csrf
                                    <div class="fallback">
                                        <input name="epub" type="file" multiple="multiple">
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
                                <form action="{{ route('admin.add-another-book-list') }}" method="POST" class="dropzone" id="audioFormId" enctype="multipart/form-data">
                                    @csrf
                                    <div class="fallback">
                                        <input name="audio" type="file" multiple="multiple">
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
                                  <input type="hidden" id="coverNameInputId" name="coverFileName">
                                  <input type="hidden" id="epubNameInputId" name="epubFileName">
                                  <input type="hidden" id="audioNameInputId" name="audioFileName">
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

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Link</label>
                                    <input class="form-control" type="text" name="link">

                                    @error('link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">
                                      Synopsis
                                    </label>
                                    <textarea class="form-control" name="synopsis"></textarea>
                                    @error('synopsis')
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
                                <div class="row">
                                  <div class="col-lg-4">
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
                                  </div>
                                  @if(strtolower($form_build->label) == 'gfp')
                                  <div class="col-lg-4">
                                    <div class="form-group">
                                      <label for="exampleInputUsername1">Proofreader
                                      </label>
                                      <select name="proofReaderId" id="" class="form-control select2">
                                        <option value="">Select Proofreader</option>
                                        @foreach($proofReaders as $k=>$pr)
                                          <option value="{{ $pr->id }}">{{ $pr->name }}
                                          </option>
                                        @endforeach
                                      </select>
                                      <input type="hidden" name="formatInfo[price][{{ $form_build->id }}]">
                                      @error('language')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                    </div>
                                  </div>
                                  @else
                                  <div class="col-lg-4">
                                    <div class="form-group">
                                      <label for="exampleInputUsername1">Price
                                      </label>
                                      <input type="text" class="form-control" name="formatInfo[price][{{ $form_build->id }}]" autocomplete="false">
                                      @error('language')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                    </div>
                                  </div>
                                  @endif
                                  <div class="col-lg-4">
                                    <div class="form-group">
                                      <label for="exampleInputUsername1">Modification Year
                                      </label>
                                      <select name="formatInfo[modifyYear][{{ $form_build->id }}]" id="" class="form-control">
                                        @for($year = date("Y"); $year>=1900; $year--)
                                            <option value="{{ $year }}">
                                              {{ $year }}
                                            </option>
                                        @endfor
                                      </select>
                                      @error('modify_year')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                    </div>
                                  </div>
                                </div>
                                @endforeach

                                <div class="row">
                                  <div class="col-lg-4">
                                    <div class="form-group">
                                      <label for="exampleInputUsername1">Pages</label>
                                      <input type="text" class="form-control" name="pages" autocomplete="false">
                                      @error('pages')
                                        <span class="text-danger">{{ $message }}
                                        </span>
                                      @enderror
                                    </div>
                                  </div>
                                  <div class="col-lg-4">
                                    <div class="form-group">
                                      <label for="exampleInputUsername1">To Read</label>
                                      <input type="text" class="form-control" name="toRead" autocomplete="false">
                                      @error('to_read')
                                        <span class="text-danger">{{ $message }}
                                        </span>
                                      @enderror
                                    </div>
                                  </div>
                                  <div class="col-lg-4">
                                    <div class="form-group">
                                      <label for="exampleInputUsername1">To Listen</label>
                                      <input type="text" class="form-control" name="toListen" autocomplete="false">
                                      @error('to_listen')
                                        <span class="text-danger">{{ $message }}
                                        </span>
                                      @enderror
                                    </div>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label for="exampleInputUsername1">
                                    Narrated By
                                  </label>
                                  <select name="narratorId" class="form-control">
                                    <option value="">Select Narrator</option>
                                    @foreach($narrators as $narrator)
                                      <option value="{{ $narrator->id }}">
                                        {{ $narrator->name }}
                                      </option>
                                    @endforeach
                                  </select>
                                  @error('narrator')
                                    <span class="text-danger">
                                      {{ $message }}
                                    </span>
                                  @enderror
                                </div>

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

    var prevCoverFiles = null;
    var prevEpubFiles = null;
    var prevAudioFiles = null;
    
    Dropzone.options.coverFormId = {
        maxFiles:1,
        maxFilesize: 5000,
        init: function() {
            this.on("addedfile", function(file){
                if(prevCoverFiles)
                {
                    this.removeFile(prevCoverFiles);
                }
                prevCoverFiles = file;
            });
            this.on("sending", function(file, xhr, formData){
                formData.append("uploadType", "cover");
            });
        },
        success:function(file, response)
        {
            console.log(response);
            $("#coverNameInputId").val(response);
        },
        error: function(file, message) {
            console.log(message);
        }
    };  
      
    Dropzone.options.epubFormId = {
        maxFiles:1,
        maxFilesize: 5000,
        init: function() {
            this.on("addedfile", function(file){
                if(prevEpubFiles)
                {
                    this.removeFile(prevEpubFiles);
                }
                prevEpubFiles = file;
            });
            this.on("sending", function(file, xhr, formData){
                formData.append("uploadType", "epub");
            });
        },
        success:function(file, response)
        {
            console.log(response);
            $("#epubNameInputId").val(response);
        },
        error: function(file, message) {
            console.log(message);
        }
    };  

    Dropzone.options.audioFormId = {
        maxFiles:1,
        maxFilesize: 5000,
        init: function() {
            this.on("addedfile", function(file){
                if(prevAudioFiles)
                {
                    this.removeFile(prevAudioFiles);
                }
                prevAudioFiles = file;
            });
            this.on("sending", function(file, xhr, formData){
                formData.append("uploadType", "audio");
            });
        },
        success:function(file, response)
        {
            console.log(response);
            $("#audioNameInputId").val(response);
        },
        error: function(file, message) {
            console.log(message);
        }
    };

    $(window).on("beforeunload",function(){
        confirm("Are you sure?");
    });
</script>

@endsection
