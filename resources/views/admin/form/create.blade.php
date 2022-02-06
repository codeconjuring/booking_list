@extends('admin.layouts._master')



@section('content')
<div class="content-wrapper">

    @include('admin.layouts._page_header',['title'=>$page_title,'type'=>'Form'])

      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{ $page_title }}</h4>
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


                {{-- <div class="form-group">
                    <label for="exampleInputUsername1">Language</label><span class="text-danger">*</span>
                    <select name="language" id="selectLanguage" onchange="selectSeries($(this).val(),'language')" class="form-control select2">

                    </select>

                    @error('language')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}







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
                        <input type="text" list="selectTitle" name="title" class="form-control"/><datalist id="selectTitle"></datalist>`);


                        $('#selectTitle').find('option').remove();

                        for (let index = 0; index < response.titles.length; index++) {
                            $('#selectTitle').append(`<option value="${response.titles[index].title}">${response.titles[index].title}</option>`);
                        }
                        // $('#selectTitle').select2();
                    }else{
                        console.log('input text');
                        $('#selectOption').append(`<label for="exampleInputUsername1" class="">Title</label><span class="text-danger">*</span><input type="text" name="title" class="form-control" placeholder="Title">`);
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
