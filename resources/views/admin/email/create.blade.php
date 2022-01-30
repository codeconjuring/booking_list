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

                                <form class="forms-sample" action="{{ route('admin.email.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                            <label for="">Host <span class="error">*</span></label>
                                            <input type="text" name="contents[host]" class="form-control" placeholder="Enter host here" required value="@if($email_setting){{ $email_setting->contents['host'] }}@endif"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Port <span class="error">*</span></label>
                                            <input type="text" name="contents[port]" class="form-control" placeholder="Enter port here" required value="@if($email_setting){{ $email_setting->contents['port'] }}@endif"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Encryption</label>
                                            <input type="text" name="contents[encryption]" class="form-control" placeholder="Enter encryption here" value="@if($email_setting){{ $email_setting->contents['encryption'] }}@endif"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Username <span class="error">*</span></label>
                                            <input type="text" name="contents[username]" class="form-control" placeholder="Enter username here" required value="@if($email_setting){{ $email_setting->contents['username'] }}@endif"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Password <span class="error">*</span></label>
                                            <input type="text" name="contents[password]" class="form-control" placeholder="Enter password here" required value="@if($email_setting){{ $email_setting->contents['password'] }}@endif"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Mail From name <span class="error">*</span></label>
                                            <input type="text" name="contents[from_name]" class="form-control" placeholder="Enter from name here" required value="@if($email_setting){{ $email_setting->contents['from_name'] ?? '' }}@endif"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Mail From address <span class="error">*</span></label>
                                            <input type="text" name="contents[from_address]" class="form-control" placeholder="Enter from address here" required value="@if($email_setting){{ $email_setting->contents['from_address'] }}@endif"/>
                                        </div>


                                    <button type="submit" class="btn btn-primary mr-2">Update Email Setting</button>
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

