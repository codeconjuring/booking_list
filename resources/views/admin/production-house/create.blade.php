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
      <div class="col-xxl-10 col-12 m-auto">
        <div class="card">
          <div class="card-body">
            <form class="forms-sample" action="{{ route('admin.production-house.store') }}" method="POST" autocomplete="off">
            @csrf
            <div class="row">
            <div class="col-lg-6">
            <div class="form-group">
              <label for="exampleInputUsername1">House Name</label>
                <span class="text-danger">*</span>
              <div class="position-relative">
                <input type="text" name="house" value="{{ old('house') }}" class="form-control" id="exampleInputUsername1" placeholder="Production House Name">
              </div>
              @error('house')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
            <div class="col-lg-6">
            <div class="form-group">
              <label for="exampleInputUsername1">Director</label>
                <span class="text-danger">*</span>
              <div class="position-relative">
                <input type="text" name="director" value="{{ old('director') }}" class="form-control" id="exampleInputUsername1" placeholder="Production Director Name">
              </div>
              @error('director')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
            <div class="col-lg-4">
            <div class="form-group">
              <label for="exampleInputUsername1">Nation</label>
                <span class="text-danger">*</span>
              <div class="position-relative">
                <select type="text" name="country" value="{{ old('country') }}" class="countries form-control" id="countryId">
                  <option value=""></option>
                </select>
              </div>
              @error('nation')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
            <div class="col-lg-4">
            <div class="form-group">
              <label for="exampleInputUsername1">State</label>
                <span class="text-danger">*</span>
              <div class="position-relative">
                <select type="text" name="state" value="{{ old('state') }}" class="states form-control" id="stateId" placeholder="City">
                  <option value=""></option>
                </select>
              </div>
              @error('state')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label for="exampleInputUsername1">City</label>
                <span class="text-danger">*</span>
              <div class="position-relative">
                <select type="text" name="city" value="{{ old('city') }}" class="cities form-control" id="cityId">
                  <option value=""></option>
                </select>
              </div>
              @error('city')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="col-lg-12 text-right">
          <button type="submit" class="btn btn-primary mr-2">Create</button>
          <a href="{{ url()->previous() }}" class="btn btn-light">Back</a>
          </div>
          </div>
            </form>
          </div>
        </div>
        </div>
      </div>
    </div>

@endsection

@section('js')
<script type="text/javascript" src="{{ asset('dashboard/update_assets/js/country-state-select.js') }}"></script>
@endsection
