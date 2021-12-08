@extends('admin.layouts._master')



@section('content')
<div class="content-wrapper">

    @include('admin.layouts._page_header',['title'=>$page_title,'type'=>'Form'])

      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{ $page_title }}</h4>
              <form class="forms-sample" action="{{ route('admin.form-builder.store') }}" method="POST">
                @csrf

                <div class="form-group">
                  <label for="exampleInputUsername1">Label</label><span class="text-danger">*</span>
                  <input type="text" name="label" value="{{ old('label') }}" class="form-control" id="exampleInputUsername1" placeholder="Label">

                  @error('label')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputUsername1">Select Type</label><span class="text-danger">*</span>
                    <p>Dropdown <input type="radio" checked name="type" value="1"> Text <input type="radio" name="type" value="0"></p>

                    @error('type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <button type="submit" class="btn btn-gradient-primary mr-2">Create</button>
                <a href="{{ url()->previous() }}" class="btn btn-light">Back</a>
              </form>
            </div>
          </div>
        </div>


      </div>


</div>


@endsection
