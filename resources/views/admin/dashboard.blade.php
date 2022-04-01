@extends('admin.layout._master')

@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<!-- DataTables -->
<link href="{{ asset('dashboard/update_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dashboard/update_assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    .highcharts-credits{
        display: none;
    }
</style>
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
                <p>Series</p>
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
                <p>Titles (all)</p>
                <h3>{{ $total_titles }}</h3>
            </div>
        </div>
        <div class="ic-dashboard-card-items box blue">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-1.png') }}" class="first-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-2.png') }}" class="second-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purlple-3.png') }}" class="third-img" alt="">
            <div class="icon">
                <i class="icon-books-break"></i>
            </div>
            <div class="ic-card-content">
                <p>Books (all)</p>
                <h3>{{ $total_books }}</h3>
            </div>
        </div>

        <div class="ic-dashboard-card-items box blue">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-1.png') }}" class="first-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-2.png') }}" class="second-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purlple-3.png') }}" class="third-img" alt="">
            <div class="icon">
            <i class="icon-books"></i>
            </div>
            <div class="ic-card-content">
                <p>Titles (Published)</p>
                <h3>{{ $total_title_published }}</h3>
            </div>
        </div>

        <div class="ic-dashboard-card-items box blue">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-1.png') }}" class="first-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-2.png') }}" class="second-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purlple-3.png') }}" class="third-img" alt="">
            <div class="icon">
                <i class="icon-list"></i>
            </div>
            <div class="ic-card-content">
                <p>Books (Published)</p>
                {{-- <h3>{{ $total_books_published }}</h3> --}}
                <h3>{{ $total_books_published }}</h3>
            </div>
        </div>

        <!-- <i class="icon-print"></i>
        <i class="icon-audiobooks"></i>
        <i class="icon-book2"></i> -->

        <div class="ic-dashboard-card-items box sky-blue">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-1.png') }}" class="first-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-2.png') }}" class="second-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purlple-3.png') }}" class="third-img" alt="">
            <div class="icon">
                <i class="icon-language"></i>
            </div>
            <div class="ic-card-content">
                <p>Languages</p>
                <h3>{{ $language_count }}</h3>
            </div>
        </div>

        <div class="ic-dashboard-card-items box sky-blue">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-1.png') }}" class="first-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purple-2.png') }}" class="second-img" alt="">
            <img src="{{ asset('dashboard/update_assets/images/purple/purlple-3.png') }}" class="third-img" alt="">
            <div class="icon">
                <i class="icon-language"></i>
            </div>
            <div class="ic-card-content">
                <p>ZTF? (Published)</p>
                <h3>{{ $total_published_by_ztf }}</h3>
            </div>
        </div>

        @php
            $bootstrap_colors=['sky-blue','tia','brown','red','sky-blue',''];
        @endphp

        @foreach ($form_builder_name_with_counts as $key=>$form_builder_count)

            <div class="ic-dashboard-card-items box {{ $bootstrap_colors[$loop->iteration]??'brown' }}">
                <img src="{{ asset('dashboard/update_assets/images/purple/purple-1.png') }}" class="first-img" alt="">
                <img src="{{ asset('dashboard/update_assets/images/purple/purple-2.png') }}" class="second-img" alt="">
                <img src="{{ asset('dashboard/update_assets/images/purple/purlple-3.png') }}" class="third-img" alt="">
                <div class="icon">

                    @if($key == "eBook")
                        <i class="icon-list"></i>
                    @elseif($key == "POD-S")
                        <i class="icon-books"></i>
                    @elseif($key == "Audio")
                        <i class="icon-audiobooks"></i>
                    @elseif($key == "POD-H")
                        <i class="icon-book2"></i>
                    @elseif($key == "GFP")
                        <i class="icon-print"></i>
                    @else
                        <i class="icon-book2"></i>
                    @endif
                </div>
                <div class="ic-card-content">
                    @if($key == "eBook")
                        <p>eBooks</p>
                    @elseif($key == "POD-S")
                        <p>POD (paperback)</p>
                    @elseif($key == "Audio")
                        <p>Audiobooks</p>
                    @elseif($key == "POD-H")
                        <p>POD (hardcover)</p>
                    @elseif($key == "GFP")
                        <p>{{ $key }}</p>
                    @else
                        <p>{{ $key }}</p>
                    @endif

                    <h3>{{ $form_builder_count }}</h3>
                </div>
            </div>

        @endforeach
    </div>



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
                        <h4>Percent Titles Status per Series</h4>
                    </div>
                    <div class="card-body pt-0 ps-0 pe-0" style="height: 380px; overflow-y: scroll">
                        <div id="bar_chart_datalabel" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cc-mt-80">
        <div class="ic-pie-chart-heads">
            @foreach ($coughnut_charts as $builder=>$status)
            @php
                $column_number=count($status);

                $percentages=0;
                $builder=str_replace("-","_",$builder);
                $builder=str_replace(" ","_",$builder);
            @endphp

                @foreach($status as $s=>$value)



                @endforeach

                    <div class="card">
                        <div class="card-body p-2">
                        <div id="doughunt-{{ $builder }}"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="ic-doughunt-text" style="{{ $builder=='GFP'?'padding-left: 60px':'' }}">
                                    @php
                                        $colors=['#FF3F24', '#FE852D', '#54D352','#5dfdad','#99cadb','#d94c12','#168b64','#ffa500','#9beb34','#1ebbd7'];
                                        $color_count=0;
                                    @endphp
                                    @foreach ($status as $s=>$value)
                                        @if($builder!='GFP')
                                            @if(strtolower($s)=='todo' || strtolower($s)=='progress' || strtolower($s)=='done')

                                                <li>
                                                    <span style="color:{{ $colors[$color_count] }}">{{ $s }}</span><span class="">{{ number_format($value,1) }}</span>
                                                </li>


                                            @endif
                                        @else
                                            <li>
                                                <span style="color:{{ $colors[$color_count] }}">{{ $s }}</span><span class="">{{ number_format($value,1) }}</span>
                                            </li>
                                        @endif

                                        @php
                                            $color_count+=1;
                                        @endphp
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        </div>
                    </div>


            @endforeach
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



    @foreach ($coughnut_charts as $builder=>$status)
    @php
        $column_number=count($status);
        $percentages=0;
        $total=0;
        $builder=str_replace("-","_",$builder);
        $builder=str_replace(" ","_",$builder);
    @endphp

        @foreach($status as $s=>$value)

        @php
            $total+=$value;
        @endphp

        @endforeach

       Highcharts.setOptions({
        });
        Highcharts.chart('doughunt-{{ $builder }}', {
        chart: {
            height: 400,

            type: 'variablepie'
        },
        title: {
            verticalAlign: 'middle',
            floating: true,
            text:'{{ $builder }}'
        },
    exporting: { enabled: false },
    tooltip: {
        headerFormat: '',
        formatter: function () {
            console.log(this);
            return ' <b>' + this.key +'</b>';
        }
    },

    plotOptions: {
        pie: {
            innerSize: '90%'
        },
        },
    series: [{
        minPointSize: 10,
        innerSize: '60%',
        dataLabels: {
                enabled: false
            },
        zMin: 0,
        name: '{{ $builder }}',

        data: [
            @php
                $colors=['#FF3F24', '#FE852D', '#54D352','#5dfdad','#99cadb','#d94c12','#168b64','#ffa500','#9beb34','#1ebbd7'];
                $color_count=0;
            @endphp
            @foreach ($status as $s=>$value)
            @php
                $status=strtolower($s);
                if($value==0){
                    $percentages=0;
                }else{
                    $percentages=($value/$total)*100;
                }
            @endphp
            @if($builder!='GFP')
                @if(strtolower($s)=='todo' || strtolower($s)=='progress' || strtolower($s)=='done')

                        {
                            name: '{{ $s }}: {{ number_format($percentages,1) }}%',
                            y: {{  number_format($percentages,1) }},
                            z: {{ number_format($percentages,1) }},
                            color: '{{ $colors[$color_count] }}'
                        },



                @endif
            @else
                {
                    name: '{{ $s }}: {{ number_format($percentages,1) }}%',
                    y: {{  number_format($percentages,1) }},
                    z: {{ number_format($percentages,1) }},
                    color: '{{ $colors[$color_count] }}'
                },


            @endif
                        @php
                            $color_count+=1;
                        @endphp
            @endforeach

      ]
    }]
});


@endforeach



// column_chart_datalabel - starts
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
            "{{ $totale_title_language_counts[$key] }}",
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
        "{{ $key }}",
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
// column_chart_datalabel - ends

// bar_chart_datalabel - starts
if($('#bar_chart_datalabel').length > 0){
var options = {
    colors : ['#519EFD', '#f7b104'],
          series: [{
          name: 'Done Titles',
          data: [
            @foreach($title_percentage_per_series as $title=>$percentage)
                "{{ round($percentage) }}",
            @endforeach
          ]
        }, {
          name: 'Not Done',
          data: [
            @foreach($title_percentage_per_series as $title=>$percentage)
                "{{ 100 - round($percentage)}}",
            @endforeach
            ]
        }],
          chart: {
          type: 'bar',
          height: 650,
          toolbar: {
            show: !1,
          },
          stacked: true,
          stackType: '100%'
        },
        plotOptions: {
          bar: {
            borderRadius: 3,
            horizontal: true,
            barHeight: '80%',
            columnWidth: 100,
          },
        },
        stroke: {
          width:0,
          colors: ['#fff']
        },
        title: {
          // text: '100% Stacked Bar'
        },
        xaxis: {
            categories:[
            @foreach($title_percentage_per_series as $title=>$percentage)
                "{{ $title }}",
            @endforeach
            ],
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return (Math.round(val*10)/10) + "%"
            }
          }
        },
        fill: {
          type: "gradient",
            gradient: {
            type: "horizontal",
            shadeIntensity: 1,
            opacityFrom: 0.7,
            opacityTo: 0.9,
            colorStops: [
            [
                {
                    offset: 0,
                    color: "#fff",
                    opacity: 1,
                },
                {
                    offset: 100,
                    color: "#519EFD",
                    opacity: 1,
                },
            ],
            [
                {
                    offset: 0,
                    color: "#fff",
                    opacity: 1,
                },
                {
                    offset: 100,
                    color: "#f7b104",
                    opacity: 1,
                },
            ]
        ],
      },

        },
        legend: {
          position: 'top',
          horizontalAlign: 'left',
          offsetX: 20,
          show:true
        }
        };

        var chart = new ApexCharts(document.querySelector("#bar_chart_datalabel"), options);
        chart.render();
}
// bar_chart_datalabel - ends

  var data = {
    labels: [

    ],
    datasets: [{
      label: '',
      data: [

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
                aaSorting: [],
                bSort: false,
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

            // $('#dataTable th').unbind('click.DT');
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
