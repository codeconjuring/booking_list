@extends('admin.layouts._master')



@section('content')
<div class="content-wrapper">

    @include('admin.layouts._page_header',['title'=>$page_title,'type'=>'Form'])

      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">{{ $page_title }}</h4>
              <form class="forms-sample" action="{{route('admin.role.store')}}" method="POST">
                @csrf

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ic_role_name">Role Name</label>
                            <input type="text" class="form-control ic_custom-form-input" id="ic_role_name" autocomplete="off" name="role_name" placeholder="Enter Role Name" required value="{{old('role_name')}}">
                        </div>

                        <div class="row my-2">
                            <div class="col-8 pt-1">
                                <div class="custom-control" style="padding-left: 0px;">
                                    <label for="customCheck-all">All Permissions</label>
                                </div>
                            </div>
                            <div class="col-4 pt-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="parent_id" class="custom-control-input" id="customCheck-all" value="all">
                                    <label class="custom-control-label" for="customCheck-all"></label>
                                </div>
                            </div>
                        </div>

                        @foreach ($permissions as $i => $permission)
                            <div class="row ic_parent_permission my-2">
                                <div class="col-8 pt-1">
                                    <div class="custom-control" style="padding-left: 0px">
                                        <label for="customCheck-{{$permission->id}}"><strong>{{$permission->name}} All</strong></label>
                                    </div>
                                </div>
                                <div class="col-4 pt-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="parent_id" class="custom-control-input" id="customCheck-{{$permission->id}}" onchange="loadChildren({{$permission->id}})">
                                        <label class="custom-control-label" for="customCheck-{{$permission->id}}"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row ic_div-show" id="ic_parent-{{$permission->id}}" style="display: none;transition: all 10s ease">
                                @foreach ($permission->children as $children)
                                    <div class="col-8 pt-1">
                                        <div class="custom-control" style="padding-left: 0px">
                                            <label for="customCheck-{{$children->id}}">{{$children->name}}</label>
                                        </div>
                                    </div>
                                    <div class="col-4 pt-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="permissions[]" class="custom-control-input parent-identy-{{$permission->id}}" id="customCheck-{{$children->id}}" value="{{$children->id}}">
                                            <label class="custom-control-label" for="customCheck-{{$children->id}}"></label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-gradient-primary mr-2">Create Role</button>
                        <a href="{{ url()->previous() }}" class="btn btn-light">Back</a>
                    </div>

              </form>

            </div>
          </div>
        </div>
    </div>

</div>


@endsection

@section('js')
<script>
        $("#customCheck-all").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
            $('div .ic_div-show').toggle();
        });

        function loadChildren(parent_id) {

            $(`#ic_parent-${parent_id}`).toggle();

            if ($(`#customCheck-${parent_id}`).is(':checked')){
                $(`.parent-identy-${parent_id}`).each(function(){
                    $(this).prop('checked', true);
                });
            }else{
                $(`.parent-identy-${parent_id}`).each(function(){
                    $(this).prop('checked', false);
                });
            }
        }
    </script>
@endsection

@section('css')
	<style>
        .ic_parent_permission {
            background-color: rgb(250, 243, 213);
            color: rgb(220, 74, 83);
            border-radius: 5px;
        }
    </style>
@endsection





