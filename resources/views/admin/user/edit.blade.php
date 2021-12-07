@extends('admin.layouts._master')



@section('content')
<div class="content-wrapper">

    @include('admin.layouts._page_header',['title'=>$page_title,'type'=>'Form'])

      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{ $page_title }}</h4>
              <form class="forms-sample" action="{{ route('admin.user.update',$user->id) }}" method="POST">
                @csrf
                @method('put')

                <div class="form-group">
                  <label for="exampleInputUsername1">First Name</label><span class="text-danger">*</span>
                  <input type="text" name="first_name" value="{{ $user->first_name }}" class="form-control" id="exampleInputUsername1" placeholder="First Name">

                  @error('first_name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputUsername1">Last Name</label>
                    <input type="text" name="last_name" value="{{ $user->last_name }}" class="form-control" id="exampleInputUsername1" placeholder="Last Name">

                    @error('last_name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputUsername1">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="exampleInputUsername1" placeholder="Email">

                    @error('email')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputUsername1">Password</label>
                    <input type="password" name="password"  class="form-control" id="exampleInputUsername1" placeholder="Password">

                    @error('password')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputUsername1">Role</label>
                    <select name="role" id="" class="form-control">

                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                            <option {{ $user->roles?$user->roles[0]->name==$role->name?'selected':'':'' }} value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>

                    @error('role')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="exampleInputUsername1">Profile Image</label> &nbsp;<span class="text-danger">(100X100) px</span>
                    <div class="input-group">
                        <span class="input-group-btn">
                        <a id="defaultProfilePicBtn" data-input="default_profile_pic" data-preview="holder" class="btn btn-info">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                        </span>
                        <input id="default_profile_pic" class="form-control" value="{{ $user->profile_image }}" type="text"  name="profile_image">
                    </div>
                </div>
                <button type="submit" class="btn btn-gradient-primary mr-2">Update User</button>
                <a href="{{ url()->previous() }}" class="btn btn-light">Back</a>
              </form>
            </div>
          </div>
        </div>

        <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                    <label for="">Profile Image</label><br>
                    @if($user->profile_image)
                        <img src="{{ asset(Storage::url($user->profile_image)) }}" alt="{{ $user->full_name }}">
                    @else
                        <img src="{{ asset(Storage::url(Settings::get('default_profile'))) }}" alt="{{ $user->full_name }}">
                    @endif
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
