@extends('admin.layouts._master')



@section('content')
<div class="content-wrapper">

    @include('admin.layouts._page_header',['title'=>$page_title,'type'=>'Form'])

      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{ $page_title }}</h4>
              <form class="forms-sample" action="{{ route('admin.category.update',$category) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                  <label for="exampleInputUsername1">Tags Name</label><span class="text-danger">*</span>

                  <input type="text" name="name" value="{{ $category->name }}" class="form-control" id="exampleInputUsername1" placeholder="Tags Name">

                  @error('name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <button type="submit" class="btn btn-gradient-primary mr-2">Update Category</button>
                <a href="{{ url()->previous() }}" class="btn btn-light">Back</a>
              </form>
            </div>
          </div>
        </div>


      </div>


</div>


@endsection
