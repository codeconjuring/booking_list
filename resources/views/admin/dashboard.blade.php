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

    <div class="col-md-3 stretch-card grid-margin">
    <div class="card bg-gradient-info card-img-holder text-white">
        <div class="card-body">
        <img src="{{ asset('dashboard/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
        <h3 class="font-weight-normal mb-3">Total Series <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
        </h3>
        <h1 class="mb-5">{{ $total_series }}</h1>
        </div>
    </div>
    </div>
    <div class="col-md-3 stretch-card grid-margin">
    <div class="card bg-gradient-success card-img-holder text-white">
        <div class="card-body">
        <img src="{{ asset('dashboard/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
        <h3 class="font-weight-normal mb-3">Total Books <i class="mdi mdi-diamond mdi-24px float-right"></i>
        </h3>
        <h1 class="mb-5">{{ $book }}</h1>
        </div>
    </div>
    </div>
    <div class="col-md-3 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
            <img src="{{ asset('dashboard/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
            <h3 class="font-weight-normal mb-3">Total Titles <i class="mdi mdi-chart-line mdi-24px float-right"></i>
            </h3>
            <h1 class="mb-5">{{ $unique_title }}</h1>
            </div>
        </div>
    </div>
    <div class="col-md-3 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
            <img src="{{ asset('dashboard/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
            <h3 class="font-weight-normal mb-3">Total Language <i class="mdi mdi-diamond mdi-24px float-right"></i>
            </h3>
            <h1 class="mb-5">{{ $language_count }}</h1>
            </div>
        </div>
        </div>



        <div class="col-lg-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title text-center" style="font-size: 2.125rem">Books per language</h3>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <select name="" id="" onchange="selectLanguage($(this).val())" class="form-control mt-5 select2">
                            <option value="">Select Language</option>
                            @foreach ($languages as $key=>$language)
                            <option value="{{ $language->language }}">{{ strtoupper($language->language) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 text-center">
                        <h1 style="font-size: 100px;" id="NumberOfBook">0</h1>
                    </div>

                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title text-center" style="font-size: 2.125rem">Books per series</h3>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <select name="" id="" onchange="selectSeries($(this).val())" class="form-control mt-5 select2">
                            <option value="">Select Series</option>
                            @foreach ($series as $key=>$serie)
                            <option value="{{ $serie->id }}">{{ $serie->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 text-center">
                        <h1 style="font-size: 100px;" id="SeriesCount">0</h1>
                    </div>

                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title text-center" style="font-size: 1.85rem;">Books Per Format</h6>
                <hr>
                <div class="col-md-12">
                    <select name="" id="" onchange="selectStatusLanguage($(this).val())" class="form-control mt-5 select2">
                        <option value="">Select Language</option>
                        @foreach ($get_languages as $key=>$lan)
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




    {{-- <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">This Number Of Unique Title</h4>
            <canvas id="barChart" style="height:230px"></canvas>
          </div>
        </div>
      </div> --}}

      @foreach ($coughnut_charts as $key=>$col)
        <div class="col-lg-4 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $key }}</h4>
                <canvas id="doughnutChart{{ str_replace(" ","_",$key) }}" style="height:250px"></canvas>
            </div>
            </div>
        </div>
      @endforeach

      <div class="col-lg-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title text-center" style="font-size: 2.125rem">Language Speedo Meter</h3>
            <hr>
            <input type="hidden" id="languageCount" value="{{ $language_count }}" />
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
            data:{'language':val},
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
            data:{'language_table':val},
            success:function(response){
                console.log(response.table);
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




// Show tooltips always even the stats are zero

Chart.pluginService.register({
  beforeRender: function(chart) {
    if (chart.config.options.showAllTooltips) {
      // create an array of tooltips
      // we can't use the chart tooltip because there is only one tooltip per chart
      chart.pluginTooltips = [];
      chart.config.data.datasets.forEach(function(dataset, i) {
        chart.getDatasetMeta(i).data.forEach(function(sector, j) {
          chart.pluginTooltips.push(new Chart.Tooltip({
            _chart: chart.chart,
            _chartInstance: chart,
            _data: chart.data,
            _options: chart.options.tooltips,
            _active: [sector]
          }, chart));
        });
      });

      // turn off normal tooltips
      chart.options.tooltips.enabled = false;
    }
  },
  afterDraw: function(chart, easing) {
    if (chart.config.options.showAllTooltips) {
      // we don't want the permanent tooltips to animate, so don't do anything till the animation runs atleast once
      if (!chart.allTooltipsOnce) {
        if (easing !== 1)
          return;
        chart.allTooltipsOnce = true;
      }

      // turn on tooltips
      chart.options.tooltips.enabled = true;
      Chart.helpers.each(chart.pluginTooltips, function(tooltip) {
        tooltip.initialize();
        tooltip.update();
        // we don't actually need this since we are not animating tooltips
        tooltip.pivot();
        tooltip.transition(easing).draw();
      });
      chart.options.tooltips.enabled = false;
    }
  }
});



@php
    $status=App\Models\Status::pluck('color','status')->toArray();
@endphp

@foreach ($coughnut_charts as $key=>$col)

@php
    $column_number=count($col);
    $total=0;
    $percentages=0;
@endphp

var doughnutPieData{{ str_replace(" ","_",$key) }} = {
    datasets: [{
      data: [
          @foreach($col as $c=>$co)

            @php
                $total+=$co;

            @endphp
          @endforeach

          @foreach($col as $c=>$co)

            @php
                $percentages=($co/$total)*100;
            @endphp

            {{ number_format($percentages,2) }},
          @endforeach

        ],
      backgroundColor: [
        @foreach($col as $c=>$co)
            "{{ $status[$c] }}",
        @endforeach

      ],
      borderColor: [
        @foreach($col as $c=>$co)
            "{{ $status[$c] }}",
        @endforeach
      ],
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        @foreach($col as $c=>$co)
            "{{ $c }}",
        @endforeach
    ],

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
      options: {
          showAllTooltips: true,
        }

    });
  }

@endforeach





//   Lanugae Seppdo Meter
$("#languageCount").speedometer({divFact:10,eventListenerType:'click'});
$("#languageCount").click();




</script>

@endsection
