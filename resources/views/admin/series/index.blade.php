@extends('admin.layout._master')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/buttons/1.6.3/css/buttons.bootstrap4.min.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css"/>
@endsection

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
        <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body ">
                    <div class="table-responsive">
                    {!! $dataTable->table(['class'=>'table table-striped table-bordered nowrap no-footer dtr-inline text-center'], false) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('js')

<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.6.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.6.3/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}
@endsection
