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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-10 m-auto">

                            <form action="{{route('admin.role.update',[$role->id])}}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="#">Role Name</label>
                                    <div class="position-relative">
                                        <input type="text" name="role_name" class="form-control" placeholder="Type role name" required value="{{$role->name}}">
                                    </div>
                                </div>


                                <div class="cc-permission-all mt-4 ">
                                    <div class="d-flex align-items-cnter">
                                        <h4 class="d-flex">All Permissions</h4>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="parent_id" class="custom-control-input" id="customCheck-all" value="all">
                                            <label class="custom-control-label" for="customCheck-all"></label>
                                        </div>
                                    </div>



                                        <div class="cc-permission-inner mt-4">
                                            <div class="accordion" id="accordionExample">
                                                @foreach ($permissions as $i => $permission)
                                                    <div class="card">
                                                        <div class="card-header d-flex align-items-center justify-content-between" id="heading{{$permission->id}}">
                                                            <p class="mb-0">{{$permission->name}} All</p>

                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" name="parent_id" class="custom-control-input" id="customSwitch{{$permission->id}}" onchange="loadChildren({{$permission->id}})" data-toggle="collapse" data-target="#collapse{{$permission->id}}" aria-expanded="false" aria-controls="collapseOne">
                                                                <label class="custom-control-label" for="customSwitch{{$permission->id}}"></label>
                                                            </div>
                                                        </div>
                                                        @foreach ($permission->children as $children)
                                                        <div id="collapse{{$permission->id}}" class="collapse ic_parent-{{$permission->id}}" aria-labelledby="heading{{$permission->id}}" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <ul class="cc-permission-under">
                                                                    <li class="d-flex align-items-center justify-content-between">
                                                                        <p class="mb-0">{{$children->name}}</p>
                                                                        <div class="custom-control custom-switch">
                                                                            <input type="checkbox" name="permissions[]" {{in_array($children->id,$role_permission)?'checked':''}} class="custom-control-input parent-identy-{{$permission->id}}" id="customSwitch{{$children->id}}" value="{{$children->id}}">
                                                                            <label class="custom-control-label" for="customSwitch{{$children->id}}"></label>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>


                                </div>
                                <div class="cc-button-heads mt-5 text-center">
                                    <button class="btn btn-primary">Update Role</button>
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

@section('script')

<script>
    $("#customCheck-all").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
        // $('div .ic_div-show').toggle();
        $('div .collapse').toggle();
    });

    function loadChildren(parent_id) {

        $(`#ic_parent-${parent_id}`).toggle();

        if ($(`#customSwitch${parent_id}`).is(':checked')){
            $(`.parent-identy-${parent_id}`).each(function(){
                $(this).prop('checked', true);
            });
        }else{
            $(`.parent-identy-${parent_id}`).each(function(){
                $(this).prop('checked', false);
            });
        }
    }

    @foreach($parents_id as $parent_id)
            $('#customSwitch{{$parent_id}}').prop('checked', true);
            $(`.ic_parent-{{$parent_id}}`).addClass('show');
    @endforeach

</script>

@endsection


