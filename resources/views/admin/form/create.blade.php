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
                    <select name="series_id" id="" class="form-control select2">
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

                <div class="form-group">
                    <label for="exampleInputUsername1">Language</label><span class="text-danger">*</span>
                    <select name="language" id="" class="form-control select2">
                        <option value="">Select Language</option>
                            @foreach($languages as $key=>$language)
                                <option value="{{ $language->upper_case }}">{{ $language->upper_case }}</option>
                            @endforeach
                        </select>

                    @error('language')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                @foreach($form_builder->content as $key=>$form_build)
                <div class="form-group">
                    <label for="exampleInputUsername1">{{ $form_build }}</label><span class="text-danger">*</span>
                    <select name="content[{{ $form_build }}]" id="" class="form-control">
                        <option value="">Select Status</option>
                        @foreach($table_status as $key=>$status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>

                    @error('series_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
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
</script>

@endsection
