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

                                  <form class="forms-sample" action="{{ route('admin.user.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                      <label for="exampleInputUsername1">First Name</label><span class="text-danger">*</span>
                                        <div class="position-relative">
                                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" id="exampleInputUsername1" placeholder="First Name">
                                        </div>


                                      @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Last Name</label>
                                        <div class="position-relative">
                                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" id="exampleInputUsername1" placeholder="Last Name">
                                        </div>


                                        @error('last_name')
                                          <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Email</label>
                                        <div class="position-relative">
                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputUsername1" placeholder="Email">
                                        </div>


                                        @error('email')
                                          <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Password</label>
                                        <div class="position-relative">
                                            <input type="password" name="password"  class="form-control" id="exampleInputUsername1" placeholder="Password">
                                        </div>


                                        @error('password')
                                          <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Role</label>
                                        <div class="position-relative">
                                            <select name="role" id="" class="form-control">
                                                <option value="">Select Role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @error('role')
                                          <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Profile Image</label> &nbsp;<span class="text-danger">(100X100) px</span>
                                        <div class="position-relative">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                <a id="defaultProfilePicBtn" data-input="default_profile_pic" data-preview="holder" class="btn btn-info">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                </a>
                                                </span>
                                                <input id="default_profile_pic" class="form-control" type="text"  name="profile_image">
                                            </div>
                                        </div>

                                    </div>

                                    <button type="submit" class="btn btn-primary mr-2">Create User</button>
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

@section('js')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

<script>
    $('#defaultProfilePicBtn').filemanager('profile');
</script>

@endsection

