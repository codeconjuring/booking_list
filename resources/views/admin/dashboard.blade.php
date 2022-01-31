@extends('admin.layout._master')

@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<!-- DataTables -->
<link href="{{ asset('dashboard/update_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dashboard/update_assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
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

    <div class="ic-dashboard-card">
        <div class="ic-dashboard-card-items box purple">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-1.png') }}" class="first-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-2.png') }}" class="second-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purlple-3.png') }}" class="third-img" alt="">
            <div class="icon">
                <i class="icon-books"></i>
            </div>
            <div class="ic-card-content">
                <p>Total Series</p>
                <h3>{{ $total_series }}</h3>
            </div>
        </div>
        <div class="ic-dashboard-card-items box orange">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-1.png') }}" class="first-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-2.png') }}" class="second-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purlple-3.png') }}" class="third-img" alt="">
            <div class="icon">
                <i class="icon-a-books"></i>
            </div>
            <div class="ic-card-content">
                <p>Total Titles</p>
                <h3>{{ $total_titles }}</h3>
            </div>
        </div>
        <div class="ic-dashboard-card-items box blue">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-1.png') }}" class="first-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-2.png') }}" class="second-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purlple-3.png') }}" class="third-img" alt="">
            <div class="icon">
                <i class="icon-book-open"></i>
            </div>
            <div class="ic-card-content">
                <p>Total Books</p>
                <h3>{{ $total_books }}</h3>
            </div>
        </div>

        <div class="ic-dashboard-card-items box blue">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-1.png') }}" class="first-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-2.png') }}" class="second-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purlple-3.png') }}" class="third-img" alt="">
            <div class="icon">
                <i class="icon-book-open"></i>
            </div>
            <div class="ic-card-content">
                <p>Total Titles Published</p>
                <h3>{{ $total_title_published }}</h3>
            </div>
        </div>

        <div class="ic-dashboard-card-items box blue">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-1.png') }}" class="first-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-2.png') }}" class="second-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purlple-3.png') }}" class="third-img" alt="">
            <div class="icon">
                <i class="icon-book-open"></i>
            </div>
            <div class="ic-card-content">
                <p>Total Books Published</p>
                <h3>{{ $total_books_published }}</h3>
            </div>
        </div>


        <div class="ic-dashboard-card-items box sky-blue">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-1.png') }}" class="first-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-2.png') }}" class="second-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purlple-3.png') }}" class="third-img" alt="">
            <div class="icon">
                <i class="icon-book-open"></i>
            </div>
            <div class="ic-card-content">
                <p>Total Language</p>
                <h3>{{ $language_count }}</h3>
            </div>
        </div>

        @php
            $bootstrap_colors=['dark','success','info','warning','primary','danger'];
        @endphp

        @foreach ($form_builder_name_with_counts as $key=>$form_builder_count)

            <div class="ic-dashboard-card-items box tia bg-gradient-{{ $bootstrap_colors[$loop->iteration]??'primary' }}">
                <img src="{{ asset('dashboard/update_assets/images/purple/purple-1.png') }}" class="first-img" alt="">
                <img src="{{ asset('dashboard/update_assets/images/purple/purple-2.png') }}" class="second-img" alt="">
                <img src="{{ asset('dashboard/update_assets/images/purple/purlple-3.png') }}" class="third-img" alt="">
                <div class="icon">
                    <i class="icon-book-open"></i>
                </div>
                <div class="ic-card-content">
                    <p>Total {{ $key }}</p>
                    <h3>{{ $form_builder_count }}</h3>
                </div>
            </div>

        @endforeach
    </div>


    <section class="cc-mt-80">
        <div class="ic-pie-chart-heads">
            <div class="card">
                <div class="card-body p-2">
                <div id="doughunt"></div>
                <ul class="ic-doughunt-text">
                    <li>
                        <span>Todo</span><span class="ic-red">35%</span>
                    </li>
                    <li>
                        <span>Progress</span><span class="ic-orange">35%</span>
                    </li>
                    <li>
                        <span>Done</span><span class="ic-green">35%</span>
                    </li>
                </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-body p-2">
                <div id="doughunt1"></div>
                <ul class="ic-doughunt-text">
                    <li>
                        <span>Todo</span><span class="ic-red">35%</span>
                    </li>
                    <li>
                        <span>Progress</span><span class="ic-orange">35%</span>
                    </li>
                    <li>
                        <span>Done</span><span class="ic-green">35%</span>
                    </li>
                </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-body p-2">
                <div id="doughunt2"></div>
                <ul class="ic-doughunt-text">
                    <li>
                        <span>Todo</span><span class="ic-red">35%</span>
                    </li>
                    <li>
                        <span>Progress</span><span class="ic-orange">35%</span>
                    </li>
                    <li>
                        <span>Done</span><span class="ic-green">35%</span>
                    </li>
                </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-body p-2">
                <div id="doughunt3"></div>
                <ul class="ic-doughunt-text">
                    <li>
                        <span>Todo</span><span class="ic-red">35%</span>
                    </li>
                    <li>
                        <span>Progress</span><span class="ic-orange">35%</span>
                    </li>
                    <li>
                        <span>Done</span><span class="ic-green">35%</span>
                    </li>
                </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-body p-2">
                <div id="doughunt4"></div>
                <ul class="ic-doughunt-text">
                    <li>
                        <span>Todo</span><span class="ic-red">35%</span>
                    </li>
                    <li>
                        <span>Progress</span><span class="ic-orange">35%</span>
                    </li>
                    <li>
                        <span>Done</span><span class="ic-green">35%</span>
                    </li>
                </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="cc-mt-80">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Top 10 languges by titles published</h4>
                    </div>
                    <div class="card-body pt-0 ps-0 pe-0">
                        <div id="column_chart_datalabel" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Parcent Titles Status per Series</h4>
                    </div>
                    <div class="card-body pt-0 ps-0 pe-0">
                        <div id="bar_chart_datalabel" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cc-mt-80">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div
                            class="cc-table-button-heads align-items-center d-flex justify-content-between ic-pb-20">
                            <h4>Books per format per language</h4>
                        </div>
                        <div id="tableLanguage">
                            Loading. . .
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection


@section('js')
    <script src="{{ asset('dashboard/assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

    <!-- chart js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/variable-pie.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
@endsection

@section('script')

<script>
$(function () {
    $(document).ready(function() {
        $('.select2').select2();
    });

if ($('#doughunt').length > 0) {
       Highcharts.setOptions({
        colors: ['#FF3F24', '#FE852D', '#54D352']
        });
        Highcharts.chart('doughunt', {
        chart: {
            height: 200,
            type: 'variablepie'
        },
        title: {
                verticalAlign: 'middle',
            floating: true,
            text: 'eBook'
        },
    exporting: { enabled: false },
    tooltip: {
        headerFormat: '',
    },
    plotOptions: {
        pie: {
            innerSize: '90%'
        }
        },
    series: [{
        minPointSize: 10,
        innerSize: '60%',
        zMin: 0,
        name: 'countries',
        data: [{
        name: '35%',
        y: 505370,
        z: 92.9
        }, {
        name: '30%',
        y: 551500,
        z: 118.7
        }, {
        name: '35%',
        y: 312685,
        z: 124.6
        }]
    }]
});
}
if ($('#doughunt1').length > 0) {
       Highcharts.setOptions({
        colors: ['#FF3F24', '#FE852D', '#54D352']
        });
        Highcharts.chart('doughunt1', {
        chart: {
            height: 200,
            type: 'variablepie'
        },
        title: {
                verticalAlign: 'middle',
            floating: true,
            text: 'POD1'
        },
    exporting: { enabled: false },
    tooltip: {
        headerFormat: '',
    },
    plotOptions: {
        pie: {
            innerSize: '90%'
        }
        },
    series: [{
        minPointSize: 10,
        innerSize: '60%',
        zMin: 0,
        name: 'countries',
        data: [{
        name: '35%',
        y: 505370,
        z: 92.9
        }, {
        name: '30%',
        y: 551500,
        z: 118.7
        }, {
        name: '35%',
        y: 312685,
        z: 124.6
        }]
    }]
});
}
if ($('#doughunt2').length > 0) {
       Highcharts.setOptions({
        colors: ['#FF3F24', '#FE852D', '#54D352']
        });
        Highcharts.chart('doughunt2', {
        chart: {
            height: 200,
            type: 'variablepie'
        },
        title: {
                verticalAlign: 'middle',
            floating: true,
            text: 'Audio'
        },
    exporting: { enabled: false },
    tooltip: {
        headerFormat: '',
    },
    plotOptions: {
        pie: {
            innerSize: '90%'
        }
        },
    series: [{
        minPointSize: 10,
        innerSize: '60%',
        zMin: 0,
        name: 'countries',
        data: [{
        name: '35%',
        y: 505370,
        z: 92.9
        }, {
        name: '30%',
        y: 551500,
        z: 118.7
        }, {
        name: '35%',
        y: 312685,
        z: 124.6
        }]
    }]
});
}
if ($('#doughunt3').length > 0) {
       Highcharts.setOptions({
        colors: ['#FF3F24', '#FE852D', '#54D352']
        });
        Highcharts.chart('doughunt3', {
        chart: {
            height: 200,
            type: 'variablepie'
        },
        title: {
                verticalAlign: 'middle',
            floating: true,
            text: 'POD2'
        },
    exporting: { enabled: false },
    tooltip: {
        headerFormat: '',
    },
    plotOptions: {
        pie: {
            innerSize: '90%'
        }
        },
    series: [{
        minPointSize: 10,
        innerSize: '60%',
        zMin: 0,
        name: 'countries',
        data: [{
        name: '35%',
        y: 505370,
        z: 92.9
        }, {
        name: '30%',
        y: 551500,
        z: 118.7
        }, {
        name: '35%',
        y: 312685,
        z: 124.6
        }]
    }]
});
}
if ($('#doughunt4').length > 0) {
       Highcharts.setOptions({
        colors: ['#FF3F24', '#FE852D', '#54D352']
        });
        Highcharts.chart('doughunt4', {
        chart: {
            height: 200,
            type: 'variablepie'
        },
        title: {
                verticalAlign: 'middle',
            floating: true,
            text: 'GFP'
        },
    exporting: { enabled: false },
    tooltip: {
        headerFormat: '',
    },
    plotOptions: {
        pie: {
            innerSize: '90%'
        }
        },
    series: [{
        minPointSize: 10,
        innerSize: '60%',
        zMin: 0,
        name: 'countries',
        data: [{
        name: '35%',
        y: 505370,
        z: 92.9
        }, {
        name: '30%',
        y: 551500,
        z: 118.7
        }, {
        name: '35%',
        y: 312685,
        z: 124.6
        }]
    }]
});
}


if ($("#column_chart_datalabel").length > 0) {
  var options = {
    chart: {
      height: 350,
      type: "bar",
      toolbar: {
        show: !1,
      },
    },
    plotOptions: {
      bar: {
        borderRadius: 10,
        dataLabels: {
          position: "top",
        },
      },
    },
    dataLabels: {
      enabled: !0,
      formatter: function (e) {
        return e;
      },
      offsetY: -22,
      style: {
        fontSize: "12px",
        colors: ["#304758"],
      },
    },
    series: [
      {
        name: "Total",
        data: [
            @foreach($totale_title_language_counts as $key=>$totale_title_language_count)
            "{{ $totale_title_language_count->total }}",
            @endforeach
            ],
      },
    ],
    fill: {
      type: "gradient",
      gradient: {
        type: "vertical",
        shadeIntensity: 1,
        opacityFrom: 0.7,
        opacityTo: 0.9,
        colorStops: [
          {
            offset: 0,
            color: "#f7b104ab",
            opacity: 1,
          },
          {
            offset: 100,
            color: "#f7b10400",
            opacity: 1,
          },
        ],
      },
    },
    grid: {
      borderColor: "#6D6D6D",
    },
    xaxis: {
      categories: [
        @foreach($totale_title_language_counts as $key=>$totale_title_language_count)
        "{{ $totale_title_language_count->language }}",
        @endforeach
        ],
    },
  };
  var chart = new ApexCharts(
    document.querySelector("#column_chart_datalabel"),
    options
  );
  chart.render();
}
  var data = {
    labels: [
        @foreach($totale_title_language_counts as $key=>$totale_title_language_count)
        "{{ $totale_title_language_count->language }}",
        @endforeach
    ],
    datasets: [{
      label: '',
      data: [
        @foreach($totale_title_language_counts as $key=>$totale_title_language_count)
                "{{ $totale_title_language_count->total }}",
        @endforeach
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
            $('#dataTable').dataTable({
                language: {
                    paginate: {
                    next: '<i class="icon-right-arrow"></i>',
                    previous: '<i class="icon-left-arrow"></i>',
                    },
                    searchPlaceholder: "Search",
                    search: '<i class="fas fa-search"></i>',
                },
                });
            $(".dataTable").wrap('<div class="table-responsive"><div>');
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
    $key=str_replace("-","_",$key);
    $key=str_replace(" ","_",$key);
@endphp
var doughnutPieData{{ $key }} = {
    datasets: [{
      label: "",
      data: [
          @foreach($col as $c=>$co)
            @php
                $total+=$co;
            @endphp
          @endforeach
          @foreach($col as $c=>$co)
            @php
                if($co>0)
                {
                    $percentages=($co/$total)*100;
                }else{
                    $percentages=0;
                }
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
  var doughnutPieOptions{{ $key }} = {
    responsive: true,
    animation: {
      animateScale: true,
      animateRotate: true
    }
  };
if ($("#doughnutChart{{ $key }}").length) {
    var doughnutChartCanvas{{ $key }} = $("#doughnutChart{{ $key }}").get(0).getContext("2d");
    var doughnutChart = new Chart(doughnutChartCanvas{{ $key }}, {
      type: 'line',
      data: doughnutPieData{{ $key }},
      options: {
          showAllTooltips: true,
          legend: {
                display: false
            },
            tooltips: {
                callbacks: {
                label: function(tooltipItem) {
                        return tooltipItem.yLabel;
                }
                }
            }
        }
    });
  }
@endforeach
//   Lanugae Seppdo Meter
$("#languageCount").speedometer({divFact:10,eventListenerType:'click'});
$("#languageCount").click();
</script>

@endsection