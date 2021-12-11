@extends('admin.layouts._master')


@section('content')

<div class="content-wrapper">

<div class="page-header">
    <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-home"></i>
    </span> Dashboard
    </h3>
    <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li>
    </ul>
    </nav>
</div>

<div class="row">

    <div class="col-md-4 stretch-card grid-margin">
    <div class="card bg-gradient-info card-img-holder text-white">
        <div class="card-body">
        <img src="{{ asset('dashboard/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
        <h3 class="font-weight-normal mb-3">Total Series <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
        </h3>
        <h1 class="mb-5">{{ $total_series }}</h1>
        </div>
    </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
    <div class="card bg-gradient-success card-img-holder text-white">
        <div class="card-body">
        <img src="{{ asset('dashboard/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
        <h3 class="font-weight-normal mb-3">Total Books <i class="mdi mdi-diamond mdi-24px float-right"></i>
        </h3>
        <h1 class="mb-5">{{ $book }}</h1>
        </div>
    </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
            <img src="{{ asset('dashboard/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
            <h3 class="font-weight-normal mb-3">Number Of Unique Titles <i class="mdi mdi-chart-line mdi-24px float-right"></i>
            </h3>
            <h1 class="mb-5">{{ $unique_title }}</h1>
            </div>
        </div>
        </div>


        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title text-center" style="font-size: 2.125rem">Number of books in a given language</h3>
                <hr>
                <div class="row">
                    <div class="col-md-6 text-center">
                        <h1 style="font-size: 100px;" id="NumberOfBook">0</h1>
                    </div>
                    <div class="col-md-6">
                        <select name="" id="" onchange="selectLanguage($(this).val())" class="form-control mt-5 select2">
                            <option value="">Select Language</option>
                            @foreach ($languages as $key=>$language)
                            <option value="{{ $language->id }}">{{ strtoupper($language->short_hand) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title text-center" style="font-size: 2.125rem">Number of books in a given series</h3>
                <hr>
                <div class="row">
                    <div class="col-md-6 text-center">
                        <h1 style="font-size: 100px;" id="SeriesCount">0</h1>
                    </div>
                    <div class="col-md-6">
                        <select name="" id="" onchange="selectSeries($(this).val())" class="form-control mt-5 select2">
                            <option value="">Select Series</option>
                            @foreach ($series as $key=>$serie)
                            <option value="{{ $serie->id }}">{{ $serie->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title text-center" style="font-size: 2.125rem">Language Wise Status Count</h3>
                <hr>
                <div class="col-md-4 offset-4">
                    <select name="" id="" onchange="selectStatusLanguage($(this).val())" class="form-control mt-5 select2">
                        <option value="">Select Language</option>
                        @foreach ($languages as $key=>$lan)
                        <option value="{{ strtoupper($lan->short_hand) }}">{{ strtoupper($lan->short_hand) }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <div id="languageTable"></div>
                    </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Language wise status metrices of cols</h4>
                <div id="tableLanguage">
                    Loading. . .
                </div>
              </div>
            </div>
          </div>

    {{-- <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">This Number Of Unique Title</h4>
            <canvas id="barChart" style="height:230px"></canvas>
          </div>
        </div>
      </div> --}}

      @foreach ($coughnut_charts as $key=>$col)
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $key }}</h4>
                <canvas id="doughnutChart{{ str_replace(" ","_",$key) }}" style="height:250px"></canvas>
            </div>
            </div>
        </div>
      @endforeach



</div>
</div>






@endsection

@section('js')
    <script src="{{ asset('dashboard/assets/vendors/chart.js/Chart.min.js') }}"></script>
@endsection

@section('script')

<script>
$(function () {

    $(document).ready(function() {
        $('.select2').select2();
    });

  var data = {
    labels: [
        @foreach($number_of_unique_titles as $key=>$number_of_unique_title)
        "{{ $number_of_unique_title->title }}",
        @endforeach
    ],
    datasets: [{
      label: '# of Votes',
      data: [
        @foreach($number_of_unique_titles as $key=>$number_of_unique_title)
                "{{ $number_of_unique_title->total }}",
        @endforeach
    ],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: false
    }]
  };


  var options = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    },
    legend: {
      display: false
    },
    elements: {
      point: {
        radius: 0
      }
    }

  };




  // Get context with jQuery - using jQuery's .get() method.
  if ($("#barChart").length) {
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: data,
      options: options
    });
  }


});

// Select Language
function selectLanguage(val)
{
    if(val!=''){
        $.ajax({
            url:'{{ route("admin.dashboard") }}',
            method:"GET",
            data:{'language_id':val},
            success:function(response){
                if(response.language_count){
                    $('#NumberOfBook').html(response.language_count);
                }else{
                    $('#NumberOfBook').html(0);
                    toastr["error"]("Not Found ! ! !");
                }

            },
            error:function(error){
                toastr["error"](error);
            }
        });
    }else{
        toastr["error"]("Please Select Language");
    }
}

// Slelect Series
function selectSeries(val)
{
    if(val!=''){
        $.ajax({
            url:'{{ route("admin.dashboard") }}',
            method:"GET",
            data:{'service_id':val},
            success:function(response){


                if(response.series_count){
                    $('#SeriesCount').html(response.series_count);
                }else{
                    $('#SeriesCount').html(0);
                    toastr["error"]("Not Found ! ! !");
                }

            },
            error:function(error){
                toastr["error"](error);
            }
        });
    }else{
        toastr["error"]("Please Select Service");
    }
}

// Select language
function selectStatusLanguage(val){
    if(val){
        $.ajax({
            url:"{{ route('admin.dashboard')  }}",
            method:"get",
            data:{'language':val},
            success:function(response){
                console.log(response);
                if(response.table){
                    $('#languageTable').html(response.table);
                }
            },
            error:function(error){
                console.log(error);
            }
        });
    }
}

// After page loading
setTimeout(() => {
    $.ajax({
        url:"{{ route('admin.dashboard') }}",
        method:"GET",
        data:{'table_load':'table_load'},
        success:function(response){
            console.log(response);
            $('#tableLanguage').html(" ");
            $('#tableLanguage').html(response.table);
        },
        error:function(error){
            toastr["error"](error);
        }
    });
}, 5000);

// Doughnut Chart
@php
    $color_name=['chartreuse','darkolivegreen','darkmagenta','deeppink','greenyellow','purple','maroon','green','yellow','navy','maroon','teal'];
@endphp

@foreach ($coughnut_charts as $key=>$col)

@php
    $column_number=count($col);
@endphp

var doughnutPieData{{ str_replace(" ","_",$key) }} = {
    datasets: [{
      data: [
          @foreach($col as $c=>$co)
            {{ $co }},
          @endforeach
        ],
      backgroundColor: [
          @for ($x = 0; $x <= $column_number; $x++)
            "{{ $color_name[$x] }}",
          @endfor

      ],
      borderColor: [
        @for ($x = 0; $x <= 10; $x++)
        "{{ $color_name[$x] }}",
        @endfor
      ],
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        @foreach($col as $c=>$co)
            "{{ $c }}",
        @endforeach
    ]
  };

  var doughnutPieOptions{{ str_replace(" ","_",$key) }} = {
    responsive: true,
    animation: {
      animateScale: true,
      animateRotate: true
    }
  };

if ($("#doughnutChart{{ str_replace(" ","_",$key) }}").length) {
    var doughnutChartCanvas{{ str_replace(" ","_",$key) }} = $("#doughnutChart{{ str_replace(" ","_",$key) }}").get(0).getContext("2d");
    var doughnutChart = new Chart(doughnutChartCanvas{{ str_replace(" ","_",$key) }}, {
      type: 'doughnut',
      data: doughnutPieData{{ str_replace(" ","_",$key) }},
      options: doughnutPieOptions{{ str_replace(" ","_",$key) }}
    });
  }


@endforeach



</script>

@endsection
