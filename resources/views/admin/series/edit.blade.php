@extends('admin.layout._master')


@section('content')


    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{ $page_title }}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

        </div>
        <!-- container-fluid -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-10 m-auto">
                                <form class="forms-sample" action="{{ route('admin.series.update',$series->id) }}" method="POST" autocomplete="off">
                                    @csrf


                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Series Name</label><span class="text-danger">*</span>
                                        <div class="position-relative">
                                            <input type="text" name="name" value="{{ $series->name }}" class="form-control" id="exampleInputUsername1" placeholder="Label" >
                                        </div>

                                        @error('name')
                                          <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                      </div>



                                      <div class="cc-button-heads mt-5 text-center">
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
