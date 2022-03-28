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
                                <form class="forms-sample" action="{{ route('admin.narrator.store') }}" method="POST" autocomplete="off">
                                    @csrf

                                      <div class="form-group">
                                        <label for="exampleInputUsername1">Narrator Name</label><span class="text-danger">*</span>
                                        <div class="position-relative">
                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="exampleInputUsername1" placeholder="Narrator Name">
                                        </div>


                                        @error('name')
                                          <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                      </div>

                                      <div class="form-group">
                                        <label for="exampleInputUsername1">       Nationality
                                        </label>
                                        <div class="position-relative">
                                          <select name="nationality" class="form-control">
                                            <option value="">
                                              Select nationality
                                            </option>
                                          @foreach($countries as $country)
                                            <option value="{{ $country->id }}" class="form-control">
                                              {{ $country->name }}
                                            </option>
                                          @endforeach
                                          </select>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label for="exampleInputUsername1">       Language
                                        </label>
                                        <div class="position-relative">
                                          <select name="language" class="form-control">
                                            <option value="">
                                              Select language
                                            </option>
                                          @foreach($languages as $language)
                                            <option value="{{ $language->id }}" class="form-control">
                                              {{ strtoupper($language->short_hand) }}
                                            </option>
                                          @endforeach
                                          </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Create</button>
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
