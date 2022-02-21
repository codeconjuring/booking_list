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

                            <form class="forms-sample" action="{{ route('admin.form.store') }}" method="POST">
                                @csrf




                                <div class="form-group">
                                    <label for="exampleInputUsername1">Series Name</label><span class="text-danger">*</span>

                                      <select name="series_id" id="" onchange="selectSeries($(this).val(),'series')" class="form-control select2">
                                              <option value="">Select Series</option>
                                          @foreach($series as $key=>$ser)
                                              <option value="{{ $ser->id }}">{{ $ser->name }}</option>
                                          @endforeach
                                      </select>

                                    @error('series_id')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>



                                <div class="form-group">
                                    <label for="exampleInputUsername1">Language</label><span class="text-danger">*</span>
                                    <select name="language" id="" onchange="selectSeries($(this).val(),'language')" class="form-control select2">
                                        <option value="">Select Language</option>
                                            @foreach($languages as $lan)
                                                <option value="{{ $lan->language }}">{{ $lan->language }}</option>
                                            @endforeach
                                        </select>

                                    @error('language')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Tags</label><span class="text-danger">*</span>
                                    <select name="categorys[]" id="" required class="form-control select2" multiple>
                                            @foreach($categories as $categorie)
                                                <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                            @endforeach
                                    </select>

                                    @error('categorys')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Author</label><span class="text-danger">*</span>

                                    <select name="author" id="" required class="form-control select2">
                                        <option value="">Select Author</option>
                                        @foreach($authors as $author)
                                            <option value="{{ $author->name }}">{{ $author->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('author')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>



                                <div class="form-group">

                                    <div id="selectOption"></div>


                                    @error('title')
                                      <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                @foreach($form_builder as $key=>$form_build)
                                <div class="form-group">
                                    <label for="exampleInputUsername1">{{ $form_build->label }}</label><span class="text-danger">*</span>


                                    @if($form_build->type=="1")
                                        <select name="content[{{ $form_build->id }}][text]" id="" required class="form-control select2">
                                            <option value="">Select Status</option>
                                            @foreach($statues as $k=>$status)
                                                <option {{ $form_build->default_status_id==$status->id?'selected':'' }} value="{{ $status->id }}">{{ $status->status }}</option>
                                            @endforeach
                                        </select>

                                        <input type="hidden" name="content[{{ $form_build->id }}][type]" value="1">

                                    @elseif($form_build->type=="0")
                                        <input type="text" class="form-control" name="content[{{ $form_build->id }}][text]" required placeholder="{{ $form_build->label }}">

                                        <input type="hidden" name="content[{{ $form_build->id }}][type]" value="0">

                                    @endif
                                </div>
                                @endforeach


                                <p class="cc-font-weigth">ZTF?</p>
                                <div class="cc-check-items">
                                    <div class="form-check">
                                        <input class="form-check-input" checked  name="available" value="0" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            No
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="available" value="1" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="available" value="2" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault3">
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            Not Available
                                        </label>
                                    </div>

                                    @error('available')
                                      <span class="text-danger">{{ $message }}</span>
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

</script>

@endsection
