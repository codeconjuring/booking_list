@extends('admin.layouts._master')



@section('content')
<div class="content-wrapper">

    @include('admin.layouts._page_header',['title'=>$page_title,'type'=>'Form'])

      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{ $page_title }}</h4>
              <form class="forms-sample" action="{{ route('admin.status.update',[$status]) }}" method="POST">
                @csrf
                @method('put')

                <div class="form-group">
                  <label for="exampleInputUsername1">Status</label><span class="text-danger">*</span>
                  <input type="text" name="status" value="{{ $status->status }}" class="form-control" id="exampleInputUsername1" placeholder="Status">

                  @error('status')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputUsername1">Color</label><span class="text-danger">*</span>
                    <input type="color" name="color" value="{{ $status->color }}" class="form-control" id="exampleInputUsername1" placeholder="Color">

                    @error('color')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                <button type="submit" class="btn btn-gradient-primary mr-2">Update Status</button>
                <a href="{{ url()->previous() }}" class="btn btn-light">Back</a>
              </form>
            </div>
          </div>
        </div>


      </div>


</div>


@endsection
