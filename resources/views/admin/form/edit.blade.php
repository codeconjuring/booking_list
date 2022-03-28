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
                                <form action="{{ route('admin.form.update',$book_list->id) }}" class="dropzone" id="coverFormId" method="POST" enctype="multipart/form-data">
                                  @csrf
                                  @method('put')
                                    <div class="fallback">
                                        <input name="cover" type="file" multiple="multiple">
                                    </div>
                                    <div class="dz-message needsclick">
                                      @if($book_list->bookInfos != null)
                                        <img width="200px" src="{{ asset('storage/covers/'.$book_list->bookInfos->cover_file_name) }}">
                                      @endif
                                        <div class="mb-3 mt-3">
                                            <i class="display-4 text-muted text-yellow icon-image"></i>
                                        </div>

                                        <p> Drop book cover here, or <span class="text-yellow">browse</span>
                                        </p>
                                    </div>
                                </form>
                            </div>
                            <div class="cc-file-card">
                                <form action="{{ route('admin.form.update',$book_list->id) }}" class="dropzone" id="epubFormId" method="POST" enctype="multipart/form-data">
                                  @csrf
                                  @method('put')
                                    <div class="fallback">
                                        <input name="epub" type="file" multiple="multiple">
                                    </div>
                                    <div class="dz-message needsclick">
                                      @if($book_list->bookInfos != null)
                                        {{ $book_list->bookInfos->epub_file_name }}
                                      @endif
                                        <div class="mb-3 mt-3">
                                            <i class="display-4 text-muted text-yellow icon-epub"></i>
                                        </div>

                                        <p>Drop epub file here, or <span class="text-yellow">browse</span>
                                        </p>
                                    </div>
                                </form>
                            </div>
                            <div class="cc-file-card">
                                <form action="{{ route('admin.form.update',$book_list->id) }}" class="dropzone" id="audioFormId" method="POST" enctype="multipart/form-data">
                                  @csrf
                                  @method('put')
                                    <div class="fallback">
                                        <input name="audio" type="file" multiple="multiple">
                                    </div>
                                    <div class="dz-message needsclick">
                                      @if($book_list->bookInfos != null)
                                        {{ $book_list->bookInfos->audio_file_name }}
                                      @endif
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
                                    <label for="exampleInputUsername1">Link</label>
                                    <input class="form-control" type="text" name="link" value="{{ $book_list->links != null?$book_list->links:'' }}">

                                    @error('link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            @if($book_list->add_another_book_translation == 0)
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
                                    <label for="exampleInputUsername1">Tags</label><span class="text-danger">*</span>
                                    <select name="categorys[]" id="" required class="form-control select2" multiple>
                                            @foreach($categories as $categorie)
                                                <option {{ in_array($categorie->id,$selected_categorys)?'selected':'' }} value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                            @endforeach
                                        </select>

                                    @error('categorys')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                  <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Author</label><span class="text-danger">*</span>

                                        <select name="author" id="" required class="form-control select2">
                                            <option value="">Select Author</option>
                                            @foreach($authors as $author)
                                                <option {{ $book_list->author==$author->name?"selected":"" }} value="{{ $author->name }}">{{ $author->name }}</option>
                                            @endforeach
                                        </select>
                                      @error('author')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                    </div>
                                  </div>
                                  <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">    Copyright Year
                                        </label>

                                        <select name="copyrightYear" id="" class="form-control select2">
                                            <option value=""></option>
                                            @for($year = date("Y"); $year>=1900; $year--)
                                            <option value="{{ $year }}" {{ $book_list->books->copyright_year == $year ? 'selected':'' }}>
                                              {{ $year }}
                                            </option>
                                        @endfor
                                        </select>
                                      @error('author')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                    </div>
                                  </div>
                                </div>
                                @endif

                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="title" value="{{ $book_list->title }}" required class="form-control" placeholder="Title">
                                    <input type="hidden" id="coverNameInputId" name="coverFileName" value="{{ $book_list->bookInfos != null ? $book_list->bookInfos->cover_file_name : '' }}">
                                    <input type="hidden" id="epubNameInputId" name="epubFileName" value="{{ $book_list->bookInfos != null ? $book_list->bookInfos->epub_file_name : '' }}">
                                    <input type="hidden" id="audioNameInputId" name="audioFileName" value="{{ $book_list->bookInfos != null ? $book_list->bookInfos->audio_file_name : '' }}">
                                    @error('title')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">
                                      Synopsis
                                    </label>
                                    <textarea class="form-control" name="synopsis">{{ $book_list->bookInfos != null ? $book_list->bookInfos->synopsis : '' }}</textarea>
                                    @error('synopsis')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                @foreach($form_builder as $key=>$form_build)
                                <div class="row">
                                  <div class="col-lg-4">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">{{ $form_build->label }}</label><span class="text-danger">*</span>

                                    @if (array_key_exists($form_build->id,$book_list->content))
                                        @if ($book_list->content[$form_build->id]['type']==1)

                                            <select name="content[{{ $form_build->id }}][text]" id="" required class="form-control select2">
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
                                            <select name="content[{{ $form_build->id }}][text]" required id="" class="form-control select2">
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
                                  </div>
                                  @if(strtolower($form_build->label) == 'gfp')
                                  <div class="col-lg-4">
                                    <div class="form-group">
                                      <label for="exampleInputUsername1">Proofreader
                                      </label>
                                      <select name="proofReaderId" id="" class="form-control select2">
                                        <option value="">Select Proofreader</option>
                                        @foreach($proofReaders as $k=>$pr)
                                          <option value="{{ $pr->id }}" {{ $book_list->bookInfos != null ? $book_list->bookInfos->proofreader_id == $pr->id ? 'selected':'':'' }}>{{ $pr->name }}
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
                                      <input type="text" class="form-control" name="formatInfo[price][{{ $form_build->id }}]" autocomplete="false" value="{{ sizeof($book_format_price) > 0 ? $book_format_price[$form_build->id] : '' }}">
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
                                            <option value=""></option>
                                        @for($year = date("Y"); $year>=1900; $year--)
                                            <option value="{{ $year }}" {{ sizeof($book_format_modify_year) > 0 ? $book_format_modify_year[$form_build->id] == $year ? 'selected':'':'' }}>
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
                                      <input type="text" class="form-control" name="pages" autocomplete="false" value="{{$book_list->bookInfos != null ? $book_list->bookInfos->pages : ''}}">
                                      @error('pages')
                                        <span class="text-danger">{{ $message }}
                                        </span>
                                      @enderror
                                    </div>
                                  </div>
                                  <div class="col-lg-4">
                                    <div class="form-group">
                                      <label for="exampleInputUsername1">To Read</label>
                                      <input type="text" class="form-control" name="toRead" autocomplete="false" value="{{$book_list->bookInfos != null ? $book_list->bookInfos->to_read : ''}}">
                                      @error('to_read')
                                        <span class="text-danger">{{ $message }}
                                        </span>
                                      @enderror
                                    </div>
                                  </div>
                                  <div class="col-lg-4">
                                    <div class="form-group">
                                      <label for="exampleInputUsername1">To Listen</label>
                                      <input type="text" class="form-control" name="toListen" autocomplete="false" value="{{$book_list->bookInfos != null ? $book_list->bookInfos->to_listen : ''}}">
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
                                      <option value="{{ $narrator->id }}" {{ $book_list->bookInfos != null ? $book_list->bookInfos->narrators != null ? $book_list->bookInfos->narrators->id == $narrator->id ? 'selected':'':'':'' }}>
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
                                @if($book_list->add_another_book_translation == 0)
                                <p class="cc-font-weigth">ZTF?</p>
                                <div class="cc-check-items">
                                    <div class="form-check">
                                        <input class="form-check-input" {{ $book_list->available==0?'checked':'' }}  name="available" value="0" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            No
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" {{ $book_list->available==1?'checked':'' }} name="available" value="1" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" {{ $book_list->available==2?'checked':'' }} name="available" value="2" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault3">
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            Not Available
                                        </label>
                                    </div>

                                    @error('available')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                @endif
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary mr-2">Update</button>
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
