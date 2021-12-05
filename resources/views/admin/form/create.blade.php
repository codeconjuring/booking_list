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
                    <label for="exampleInputUsername1">Language</label><span class="text-danger">*</span>
                    <select name="language" id="" onchange="selectLanguage($(this).val())" class="form-control select2">
                        <option value="">Select Language</option>
                            @foreach($languages as $key=>$language)
                                <option value="{{ $language->upper_case }}">{{ $language->upper_case }}</option>
                            @endforeach
                        </select>

                    @error('language')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                  <label for="exampleInputUsername1">Series Name</label><span class="text-danger">*</span>
                    <select name="series_id" id="" onchange="selectSeries($(this).val())" class="form-control select2">
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
                    <label for="exampleInputUsername1">Title</label><span class="text-danger">*</span>
                    <input type="text" name="title" class="form-control" placeholder="Title">

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

    // let series='';
    // let language='';

    // // Select Lanugate
    // function selectLanguage(val)
    // {
    //     language=val;

    // }
    // // Select Series
    // function selectSeries(val)
    // {
    //     series=val;
    //     let val_data=validation(series,language);

    //     if(val_data)
    //     {
    //         $.ajax({
    //             url:'{{ route("admin.form.api_request") }}',
    //             method:"GET",
    //             data:{'series':series,'language':language},
    //             success:function(response){
    //                 console.log(response);
    //             },
    //             error:function(err){
    //                 console.log(err);
    //             }
    //         });
    //     }

    // }

    // function validation(s,l)
    // {
    //     if(s=='')
    //     {
    //         toastr["error"]("Pleas Select Series");
    //     }

    //     if(l==''){
    //         toastr["error"]("Pleas Select Language");
    //     }
    //     return true;
    // }

</script>

@endsection
