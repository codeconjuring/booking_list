@extends('admin.layouts._master')



@section('content')
<div class="content-wrapper">

    @include('admin.layouts._page_header',['title'=>$page_title,'type'=>'Form'])

      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{ $page_title }}</h4>

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


                <button type="submit" class="btn btn-gradient-primary mr-2">Update Email Setting</button>
                <a href="{{ url()->previous() }}" class="btn btn-light">Back</a>
              </form>
            </div>
          </div>
        </div>



      </div>


</div>


@endsection


