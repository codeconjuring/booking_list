@extends('admin.layout._master')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/buttons/1.6.3/css/buttons.bootstrap4.min.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
@endsection

@section('content')
<div class="page-content">
  <div class="container-fluid">
    <!-- start page title -->
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">{{ $page_title }}</h4>
          {{-- <div class="page-title-right">
            <button class="btn btn-primary"><i data-feather="plus"></i> Create Book</button>
          </div> --}}
        </div>
      </div>
    </div>
    <!-- end page title -->
  </div>
  <!-- container-fluid -->
  <div class="row my-2">
    <div class="col-lg-4">
      <div class="ic-dashboard-card-items box green"> <img src="{{ asset('dashboard/update_assets/images/purple/purple-1.png')}}" class="first-img" alt=""> <img src="{{ asset('dashboard/update_assets/images/purple/purple-2.png') }}" class="second-img" alt=""> <img src="{{ asset('dashboard/update_assets/images/purple/purlple-3.png') }}" class="third-img" alt="">
        <div class="icon"> <i class="icon-book-open"></i> </div>
        <div class="ic-card-content">
          <p>Production Houses</p>
          <h3>{{ $total_production_houses }}</h3> </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="ic-dashboard-card-items box red"> <img src="{{ asset('dashboard/update_assets/images/purple/purple-1.png')}}" class="first-img" alt=""> <img src="{{ asset('dashboard/update_assets/images/purple/purple-2.png') }}" class="second-img" alt=""> <img src="{{ asset('dashboard/update_assets/images/purple/purlple-3.png') }}" class="third-img" alt="">
        <div class="icon"> <i class="icon-a-books"></i> </div>
        <div class="ic-card-content">
          <p>Books (Produced)</p>
          <h3>{{ $total_book_copies }}</h3> </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="ic-dashboard-card-items box orange"> <img src="{{ asset('dashboard/update_assets/images/purple/purple-1.png')}}" class="first-img" alt=""> <img src="{{ asset('dashboard/update_assets/images/purple/purple-2.png') }}" class="second-img" alt=""> <img src="{{ asset('dashboard/update_assets/images/purple/purlple-3.png') }}" class="third-img" alt="">
        <div class="icon"> <i class="icon-a-books"></i> </div>
        <div class="ic-card-content">
          <p>Books (Titles)</p>
          <h3>{{ $total_book_titles }}</h3> </div>
      </div>
    </div>    
  </div>
  <div class="row">
    <div class="col-lg-4">
      <div class="ic-dashboard-card-items box green"> <img src="{{ asset('dashboard/update_assets/images/purple/purple-1.png')}}" class="first-img" alt=""> <img src="{{ asset('dashboard/update_assets/images/purple/purple-2.png') }}" class="second-img" alt=""> <img src="{{ asset('dashboard/update_assets/images/purple/purlple-3.png') }}" class="third-img" alt="">
        <div class="icon"> <i class="icon-book-open"></i> </div>
        <div class="ic-card-content">
          <p>Languages (Books)</p>
          <h3>{{ $languages_produced_books }}</h3> </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="ic-dashboard-card-items box green"> <img src="{{ asset('dashboard/update_assets/images/purple/purple-1.png')}}" class="first-img" alt=""> <img src="{{ asset('dashboard/update_assets/images/purple/purple-2.png') }}" class="second-img" alt=""> <img src="{{ asset('dashboard/update_assets/images/purple/purlple-3.png') }}" class="third-img" alt="">
        <div class="icon"> <i class="icon-book-open"></i> </div>
        <div class="ic-card-content">
          <p>Tracts (Produced)</p>
          <h3>{{ $total_tract_copies }}</h3> </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="ic-dashboard-card-items box sky-blue"> <img src="{{ asset('dashboard/update_assets/images/purple/purple-1.png')}}" class="first-img" alt=""> <img src="{{ asset('dashboard/update_assets/images/purple/purple-2.png') }}" class="second-img" alt=""> <img src="{{ asset('dashboard/update_assets/images/purple/purlple-3.png') }}" class="third-img" alt="">
        <div class="icon"> <i class="icon-book-open"></i> </div>
        <div class="ic-card-content">
          <p>Tracts (Titles)</p>
          <h3>{{ $total_tract_titles }}</h3> </div>
      </div>
    </div>
  </div>  
  <div class="row my-2">
    <div class="col-lg-4">
      <div class="ic-dashboard-card-items box green"> <img src="{{ asset('dashboard/update_assets/images/purple/purple-1.png')}}" class="first-img" alt=""> <img src="{{ asset('dashboard/update_assets/images/purple/purple-2.png') }}" class="second-img" alt=""> <img src="{{ asset('dashboard/update_assets/images/purple/purlple-3.png') }}" class="third-img" alt="">
        <div class="icon"> <i class="icon-book-open"></i> </div>
        <div class="ic-card-content">
          <p>Languages (Tracts)</p>
          <h3>{{ $languages_produced_tracts }}</h3> </div>
      </div>
    </div>
  </div>
  <section class="cc-mt-80">
    {{-- <div class="ic-select-heads">
      <select name="" id="" class="ic-seclect">
        <option value="0">Country</option>
        <option value="1">Country</option>
        <option value="2">Country</option>
      </select>
      <select name="" id="" class="ic-seclect">
        <option value="0">Channel</option>
        <option value="1">Channel</option>
        <option value="2">Channel</option>
      </select>
      <select name="" id="" class="ic-seclect">
        <option value="0">Free/Paid</option>
        <option value="1">Free/Paid</option>
        <option value="2">Free/Paid</option>
      </select>
      <select name="" id="" class="ic-seclect">
        <option value="0">Medium</option>
        <option value="1">Medium</option>
        <option value="2">Medium</option>
      </select>
    </div> --}}
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Annual Production (#Titles)</h4> </div>
          <div class="card-body pt-0 ps-0 pe-0">
            <div id="column_chart_trend" class="apex-charts" dir="ltr"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Annual Production (#Books)</h4> </div>
          <div class="card-body pt-0 ps-0 pe-0">
            <div id="column_chart_trend2" class="apex-charts" dir="ltr"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4>Top 10 Production by Title</h4> </div>
          <div class="card-body pt-0 ps-0 pe-0">
            <div id="bar_chart_top10_prod_title" class="apex-charts" dir="ltr"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4>Top 10 Production by Language</h4> </div>
          <div class="card-body pt-0 ps-0 pe-0">
            <div id="bar_chart_top10_prod_lan" class="apex-charts" dir="ltr"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4>Top 10 Production by Series</h4> </div>
          <div class="card-body pt-0 ps-0 pe-0">
            <div id="bar_chart_top10_prod_series" class="apex-charts" dir="ltr"></div>
          </div>
        </div>
      </div>
      {{-- <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Report By Year 
            </h4> 
          </div>
          <div class="card-body pt-0 ps-0 pe-0">
            <div class="ic-select-heads">
              <select width="100%" name="production_year" id="production_year_id" class="ic-seclect form-control" onchange="populateDataOnAYearChart()" >
                @for($y = date('Y'); $y >= 1975 ; $y--)
                  <option value={{ $y }}>{{ $y }}</option>
                @endfor
              </select>
            </div>
            <span id="loading_id" class="d-none">Loading...</span>
            <div id="column_chart_trend3" class="apex-charts" dir="ltr"></div>
          </div>
        </div>
      </div> --}}
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Production Report (by Publishing House) 
            </h4> 
          </div>
          <div class="card-body pt-0 ps-0 pe-0" id="production_house_table_div">
            <div class="cc-table-button-heads align-items-center d-flex justify-content-between ic-pb-20">
              Loading...
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Global Footprint of Our Publishing Houses
            </h4> 
          </div>
          <div class="card-body pt-0 ps-0 pe-0" id="production_house_table_div">
             <div id="map" style="height: 480px";></div>
          </div>
        </div>
      </div>
    </div>
  </section>
{{--   <section class="cc-mt-80">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4>Top 10 Titles Sold by Qty</h4> </div>
          <div class="card-body pt-0 ps-0 pe-0">
            <div id="bar_chart_sold" class="apex-charts" dir="ltr"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4>Top 10 Titles by Royalty $</h4> </div>
          <div class="card-body pt-0 ps-0 pe-0">
            <div id="bar_chart_sold2" class="apex-charts" dir="ltr"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="cc-mt-80">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4>Top 10 Countries by Qty Sold </h4> </div>
          <div class="card-body pt-0 ps-0 pe-0">
            <div id="bar_chart_sold3" class="apex-charts" dir="ltr"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4>Top 10 Countries by Sales Paid</h4> </div>
          <div class="card-body pt-0 ps-0 pe-0">
            <div id="bar_chart_sold4" class="apex-charts" dir="ltr"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="cc-mt-80">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4>Top 10 Countries by Qty Sold </h4> </div>
          <div class="card-body pt-0 ps-0 pe-0">
            <div id="bar_chart_sold5" class="apex-charts" dir="ltr"></div>
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
            <div class="cc-table-button-heads align-items-center d-flex justify-content-between ic-pb-20">
              <h4>Available Languages and Titles</h4>
              <select name="" id="" class="ic-seclect">
                <option value="0">Filter by Language</option>
                <option value="1">Filter by Language</option>
                <option value="2">Filter by Language</option>
              </select>
            </div>
            <table cellpadding="2" class="cc-datatable table nowrap w-100">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">eBook</th>
                  <th class="text-center">POD1</th>
                  <th class="text-center">Audio</th>
                  <th class="text-center">POD2</th>
                  <th class="text-center">GFP</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-center">EN</td>
                  <td class="text-center">144</td>
                  <td>136</td>
                  <td class="text-center">75</td>
                  <td class="text-center">20</td>
                  <td class="text-center">27</td>
                </tr>
                <tr>
                  <td class="text-center">EN</td>
                  <td class="text-center">144</td>
                  <td>136</td>
                  <td class="text-center">75</td>
                  <td class="text-center">20</td>
                  <td class="text-center">27</td>
                </tr>
                <tr>
                  <td class="text-center">EN</td>
                  <td class="text-center">144</td>
                  <td>136</td>
                  <td class="text-center">75</td>
                  <td class="text-center">20</td>
                  <td class="text-center">27</td>
                </tr>
                <tr>
                  <td class="text-center">EN</td>
                  <td class="text-center">144</td>
                  <td>136</td>
                  <td class="text-center">75</td>
                  <td class="text-center">20</td>
                  <td class="text-center">27</td>
                </tr>
                <tr>
                  <td class="text-center">EN</td>
                  <td class="text-center">144</td>
                  <td>136</td>
                  <td class="text-center">75</td>
                  <td class="text-center">20</td>
                  <td class="text-center">27</td>
                </tr>
                <tr>
                  <td class="text-center">EN</td>
                  <td class="text-center">144</td>
                  <td>136</td>
                  <td class="text-center">75</td>
                  <td class="text-center">20</td>
                  <td class="text-center">27</td>
                </tr>
                <tr>
                  <td class="text-center">EN</td>
                  <td class="text-center">144</td>
                  <td>136</td>
                  <td class="text-center">75</td>
                  <td class="text-center">20</td>
                  <td class="text-center">27</td>
                </tr>
                <tr>
                  <td class="text-center">EN</td>
                  <td class="text-center">144</td>
                  <td>136</td>
                  <td class="text-center">75</td>
                  <td class="text-center">20</td>
                  <td class="text-center">27</td>
                </tr>
                <tr>
                  <td class="text-center">EN</td>
                  <td class="text-center">144</td>
                  <td>136</td>
                  <td class="text-center">75</td>
                  <td class="text-center">20</td>
                  <td class="text-center">27</td>
                </tr>
                <tr>
                  <td class="text-center">EN</td>
                  <td class="text-center">144</td>
                  <td>136</td>
                  <td class="text-center">75</td>
                  <td class="text-center">20</td>
                  <td class="text-center">27</td>
                </tr>
                <tr>
                  <td class="text-center">EN</td>
                  <td class="text-center">144</td>
                  <td>136</td>
                  <td class="text-center">75</td>
                  <td class="text-center">20</td>
                  <td class="text-center">27</td>
                </tr>
                <tr>
                  <td class="text-center">EN</td>
                  <td class="text-center">144</td>
                  <td>136</td>
                  <td class="text-center">75</td>
                  <td class="text-center">20</td>
                  <td class="text-center">27</td>
                </tr>
                <tr>
                  <td class="text-center">EN</td>
                  <td class="text-center">144</td>
                  <td>136</td>
                  <td class="text-center">75</td>
                  <td class="text-center">20</td>
                  <td class="text-center">27</td>
                </tr>
                <tr>
                  <td class="text-center">EN</td>
                  <td class="text-center">144</td>
                  <td>136</td>
                  <td class="text-center">75</td>
                  <td class="text-center">20</td>
                  <td class="text-center">27</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section> --}}
</div>

@endsection


@section('js')
{{-- <script src="{{ asset('dashboard/update_assets/libs/apexcharts/apexcharts.init.js')}}"></script> --}}
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.6.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/buttons/1.6.3/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script type="text/javascript">
   var options = {
          series: [{
          name: 'Books',
          data: [@foreach($prod_year as $y) {{ $yearly_book_titles_arr[$y] }}, @endforeach]
        }, {
          name: 'Tracts',
          data: [@foreach($prod_year as $y) {{ $yearly_tract_titles_arr[$y] }}, @endforeach]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: [@foreach($prod_year as $y) '{{ $y }}', @endforeach],
        },
        yaxis: {
          title: {
            text: 'Total Titles Produced'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "" + val
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#column_chart_trend"), options);
        chart.render();


   var options2 = {
          series: [{
          name: 'Books',
          data: [@foreach($prod_year as $y) {{ $yearly_book_copies_arr[$y] }}, @endforeach]
        }, {
          name: 'Tracts',
          data: [@foreach($prod_year as $y) {{ $yearly_tract_copies_arr[$y] }}, @endforeach]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: [@foreach($prod_year as $y) '{{ $y }}', @endforeach],
        },
        yaxis: {
          title: {
            text: 'Total Copies Produced'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "" + val
            }
          }
        }
        };

        var chart2 = new ApexCharts(document.querySelector("#column_chart_trend2"), options2);
        chart2.render();


  // var book_data  = [
  {{-- @foreach($months as $month) {{ $month[0] }}, @endforeach]; --}}
  // var tract_data = [
  {{-- @foreach($months as $month) {{ $month[1] }}, @endforeach]; --}}
  // dataOnAYearChart();
  // function dataOnAYearChart()
  // {
  //      var options3 = {
  //         series: [{
  //         name: 'Books',
  //         data: book_data
  //       }, {
  //         name: 'Tracts',
  //         data: tract_data
  //       }],
  //         chart: {
  //         type: 'bar',
  //         height: 350
  //       },
  //       plotOptions: {
  //         bar: {
  //           horizontal: false,
  //           columnWidth: '55%',
  //           endingShape: 'rounded'
  //         },
  //       },
  //       dataLabels: {
  //         enabled: false
  //       },
  //       stroke: {
  //         show: true,
  //         width: 2,
  //         colors: ['transparent']
  //       },
  //       xaxis: {
  //         categories: [ 
  {{-- @foreach($months as $month => $production) '{{ $month }}', @endforeach], --}}
  //       },
  //       yaxis: {
  //         title: {
  //           text: "Production"
  //         }
  //       },
  //       fill: {
  //         opacity: 1
  //       },
  //       tooltip: {
  //         y: {
  //           formatter: function (val) {
  //             return "" + val
  //           }
  //         }
  //       }
  //       };

  //       var chart3 = new ApexCharts(document.querySelector("#column_chart_trend3"), options3);
  //       chart3.render();
  // }

  // function populateDataOnAYearChart()
  // {
  //   $('#loading_id').removeClass('d-none');
  //   var year = $('#production_year_id').val();
  //   $.ajax({
  //     url:'
  {{-- {{ route('admin.production.get-data-on-a-year') }}' --}}
  //     method: 'GET',
  //     data:{production_year:year},
  //     success:function(response)
  //     {
  //       var months_arr = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
  //       console.log(response.months['Jan']);

  //       for(let m = 0; m < 12; m++)
  //       {
  //         book_data[m] = response.months[months_arr[m]][0];
  //       }
  //       for(let m = 0; m < 12; m++)
  //       {
  //         tract_data[m] = response.months[months_arr[m]][1];
  //       }
  //       dataOnAYearChart();
  //       $('#loading_id').addClass('d-none');
  //     }
  //   });
  // }
var options = {
    series: [{
      name:"Quantity",
      data: [@if(sizeof($top10_production_by_title) >= 10) @foreach($top10_production_by_title as $title) {{ $title->sum_quantity }},  @endforeach @else @foreach($top10_production_by_title as $title) {{ $title->sum_quantity }}, @endforeach @for($i=0; $i < 10 - sizeof($top10_production_by_title); $i++) '{{ 0 }}', @endfor @endif]
    }],
      chart: {
      type: 'bar',
      height: 500,
      toolbar: {
        show: !1,
      },
    },
    plotOptions: {
      bar: {
        borderRadius: 10,
        horizontal: true,
        barHeight: '70%',
      }
    },
    fill: {
      type: "gradient",
      opacity: 1,
      gradient: {
        type: "horizontal",
        shadeIntensity: 1,
        opacityFrom: 0.7,
        opacityTo: 0.9,
        colorStops: [
          {
            offset: 0,
            color: "#ffffff00",
            opacity: 1,
          },
          {
            offset: 100,
            color: "#FE8058",
            opacity: 1,
          },
        ],
      },
    },
    dataLabels: {
      enabled: false
    },
    xaxis: {
      categories: [@if(sizeof($top10_production_by_title) >= 10) @foreach($top10_production_by_title as $title) '{{ $title->book_list != null ? $title->book_list->title : '' }}',  @endforeach @else @foreach($top10_production_by_title as $title) '{{ $title->book_list != null ? $title->book_list->title : '' }}', @endforeach @for($i=0; $i < 10 - sizeof($top10_production_by_title); $i++) '{{ '-' }}', @endfor @endif
      ],
    }
  };

  var chart = new ApexCharts(
    document.querySelector("#bar_chart_top10_prod_title"),
    options
  );
  chart.render();


var options = {
    series: [{
      name:"Quantity",
      data: [@foreach($top10_production_by_lan as $lan) {{ $lan->lan_quantity }},  @endforeach @if(sizeof($top10_production_by_lan) < 10) @for($i = 0; $i < 10 - sizeof($top10_production_by_lan); $i++) {{ 0 }}, @endfor @endif]
    }],
      chart: {
      type: 'bar',
      height: 500,
      toolbar: {
        show: !1,
      },
    },
    plotOptions: {
      bar: {
        borderRadius: 10,
        horizontal: true,
        barHeight: '70%',
      }
    },
    fill: {
      type: "gradient",
      opacity: 1,
      gradient: {
        type: "horizontal",
        shadeIntensity: 1,
        opacityFrom: 0.7,
        opacityTo: 0.9,
        colorStops: [
          {
            offset: 0,
            color: "#ffffff00",
            opacity: 1,
          },
          {
            offset: 100,
            color: "#3BCA43",
            opacity: 1,
          },
        ],
      },
    },
    dataLabels: {
      enabled: false
    },
    xaxis: {
      categories: [@foreach($top10_production_by_lan as $lan) '{{ $lan->lan }}', @endforeach @if(sizeof($top10_production_by_lan) < 10) @for($i = 0; $i < 10 - sizeof($top10_production_by_lan); $i++) '{{ '-' }}', @endfor @endif
      ],
    }
  };

  var chart = new ApexCharts(
    document.querySelector("#bar_chart_top10_prod_lan"),
    options
  );
  chart.render();


var options = {
    series: [{
      name:"Quantity",
      data: [@foreach($top10_production_by_series as $series) {{ $series->series_quantity }},  @endforeach @if(sizeof($top10_production_by_series) < 10) @for($i = 0; $i < 10 - sizeof($top10_production_by_series); $i++) {{ 0 }}, @endfor @endif]
    }],
      chart: {
      type: 'bar',
      height: 500,
      toolbar: {
        show: !1,
      },
    },
    plotOptions: {
      bar: {
        borderRadius: 10,
        horizontal: true,
        barHeight: '70%',
        columnWidth: 60,
      }
    },
    fill: {
      type: "gradient",
      opacity: 1,
      gradient: {
        type: "horizontal",
        shadeIntensity: 1,
        opacityFrom: 0.7,
        opacityTo: 0.9,
        colorStops: [
          {
            offset: 0,
            color: "#ffffff00",
            opacity: 1,
          },
          {
            offset: 100,
            color: "#FF832A",
            opacity: 1,
          },
        ],
      },
    },
    dataLabels: {
      enabled: false
    },
    xaxis: {
      categories: [@foreach($top10_production_by_series as $series) '{{ $series->name }}', @endforeach @if(sizeof($top10_production_by_series) < 10) @for($i = 0; $i < 10 - sizeof($top10_production_by_series); $i++) '{{ '-' }}', @endfor  @endif
      ],
    }
  };

  var chart = new ApexCharts(
    document.querySelector("#bar_chart_top10_prod_series"),
    options
  );
  chart.render();



  loadProductionHouseTable();

  function loadProductionHouseTable()
  {
    $.ajax({
      url:'{{ route('admin.production.get-production-house-data') }}',
      method:'GET',
      data:{id:1},
      success:function(response)
      {
        console.log(response);
        $('#production_house_table_div').html(response.table);
        $('#production_table_id').dataTable({
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
      }
    });
  }

</script>
 <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
   <script type="text/javascript">
    var map = L.map('map').setView([0, 0], 2);
     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    maxZoom: 20,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'your.mapbox.access.token'
}).addTo(map);
     // var marker = L.marker([51.5, -0.09]).addTo(map);
     // var marker = L.marker([23.7861979,90.4026151]).addTo(map);
     var mapApi = "AIzaSyBX1SxyEiEXwI6eU6jRv0kdHPl6LQlF4GU";

     @php
      $house_i = 0;
     @endphp
     var house_arr = [];
     var city_arr = [];
     @foreach ($production_houses as $house)
      house_arr[{{ $house_i }}] = "{{$house->city.' '.$house->state.' '.$house->nation }}";
      city_arr[{{ $house_i }}] = "{{$house->city}}";
      @php $house_i += 1; @endphp
     @endforeach

     var count_req = 0;
     var house_interval = setInterval(function(){
        $.get(location.protocol + '//nominatim.openstreetmap.org/search?format=json&q='+house_arr[count_req], function(data){
            console.log(house_arr[count_req]);
            console.log(data);
            count_req += 1;
            if(data.length > 0)
            {
              console.log("count: "+count_req); 
              var data_arr = data[0].display_name.split(',');
              L.marker([data[0].lat, data[0].lon]).bindTooltip(data_arr[0]+", "+data_arr[data_arr.length-1],
              {
                permanent: true, 
                direction: 'right'
              }).addTo(map)
            }
            if(count_req >= house_arr.length)
            {clearInterval(house_interval);}
        });}, 1000);
     
   </script>
@endsection