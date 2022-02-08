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

                                <form class="forms-sample" action="{{ route('admin.setting.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                      <label for="exampleInputUsername1">Title</label>
                                      <input type="text" name="title" value="{{ Settings::get('title') }}" class="form-control" id="exampleInputUsername1" placeholder="System Title">
                                      @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Email Notification Email</label>
                                        <input type="email" name="email_notification" value="{{ Settings::get('email_notification') }}" class="form-control" id="exampleInputUsername1" placeholder="Email Notification Email">
                                        @error('email_notification')
                                          <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                      </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Report Font Size</label>
                                        <input type="number" name="report_font_size" value="{{ Settings::get('report_font_size') }}" class="form-control" id="exampleInputUsername1" placeholder="Report Font Size">
                                        @error('report_font_size')
                                          <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                      </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Site Logo</label> &nbsp;<span class="text-danger">(140X28) px</span>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                            <a id="siteLogo" data-input="thumbnail" data-preview="holder" class="btn btn-info">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                            </span>
                                            <input id="thumbnail" class="form-control" type="text"  name="site_logo">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Favicon</label> &nbsp;<span class="text-danger">(16X16) px</span>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                            <a id="faviconBtn" data-input="favicon" data-preview="holder" class="btn btn-info">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                            </span>
                                            <input id="favicon" class="form-control" type="text"  name="favicon">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Default profile</label> &nbsp;<span class="text-danger">(32X32) px</span>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                            <a id="defaultProfilePicBtn" data-input="default_profile_pic" data-preview="holder" class="btn btn-info">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                            </span>
                                            <input id="default_profile_pic" class="form-control" type="text"  name="default_profile">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-light">Back</a>

                                  </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                        <label for="">Site Logo</label><br>
                        <img width="50%" src="{{ asset(Storage::url(Settings::get('site_logo'))) }}" alt="">
                    </div>

                    <div class="form-group">
                        <label for="">Favicon</label><br>
                        <img width="50%" src="{{ asset(Storage::url(Settings::get('favicon'))) }}" alt="">
                    </div>

                    <div class="form-group">
                        <label for="">Default profile</label><br>
                        <img width="50%" src="{{ asset(Storage::url(Settings::get('default_profile'))) }}" alt="">
                    </div>

                  </div>
                </div>
             </div>

        </div>
    </div>


@endsection

@section('js')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

@endsection

@section('script')

<script>
    $('#defaultProfilePicBtn').filemanager('profile');
    $('#faviconBtn').filemanager('setting');
    $('#siteLogo').filemanager('setting');
</script>

@endsection

