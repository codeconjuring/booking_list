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
                                <form class="forms-sample" action="{{ route('admin.series.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                      <label for="exampleInputUsername1">Status</label><span class="text-danger">*</span>
                                      <div class="position-relative">
                                        <input type="text" name="status" value="{{ $status->status }}" class="form-control" id="exampleInputUsername1" placeholder="Status">
                                      </div>

                                      @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Color</label><span class="text-danger">*</span>
                                        <div class="position-relative">
                                            <input type="color" name="color" value="{{ $status->color }}" class="form-control" id="exampleInputUsername1" placeholder="Color">
                                        </div>

                                        @error('color')
                                          <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-light">Back</a>
                                  </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
