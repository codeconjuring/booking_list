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
        name: "Series 1",
        data: [2, 23, 19, 45, 38, 52, 45],
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
      categories: ["AM", "AR", "DE", "EL", "ES", "EN", "FR", "HI"],
    },
  };

  var chart = new ApexCharts(
    document.querySelector("#column_chart_datalabel"),
    options
  );

  chart.render();
}

if ($("#bar_chart_datalabel").length > 0) {
  var options = {
    colors: ["#F44336", "#E91E63"],
    series: [
      {
        name: "Marine Sprite",
        data: [44, 55, 41],
        borderRadius: 10,
      },
      {
        name: "Striking Calf",
        data: [53, 32, 33],
        borderRadius: 10,
      },
    ],
    chart: {
      type: "bar",
      height: 350,
      stacked: true,
      toolbar: {
        show: !1,
      },
      dropShadow: {
        enabled: false,
        blur: 0,
        opacity: 1,
      },
    },
    plotOptions: {
      bar: {
        borderRadius: 10,

        horizontal: true,
        // barHeight: "60%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      width: 0,
    },
    xaxis: {
      categories: ["Prayer", "Practical help", "The Way"],
      borderColor: "#5B6572",
    },
    yaxis: {
      title: {
        text: undefined,
      },
    },
    grid: {
      borderColor: "#5B6572",
    },
    tooltip: {
      shared: false,
      y: {
        formatter: function (val) {
          return val;
        },
      },
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
            color: "#2D8AFD",
            opacity: 1,
          },
        ],
      },
    },
    states: {
      hover: {
        filter: "none",
      },
    },
    legend: {
      show: false,
      position: "top",
      offsetY: 40,
    },
  };

  var chart = new ApexCharts(
    document.querySelector("#bar_chart_datalabel"),
    options
  );
  chart.render();
}

if ($("#bar_chart_sold").length > 0) {
  var options = {
    series: [{
      data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
    }],
      chart: {
      type: 'bar',
      height: 780,
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
      categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan',
        'United States', 'China', 'Germany'
      ],
    }
  };

  var chart = new ApexCharts(
    document.querySelector("#bar_chart_sold"),
    options
  );
  chart.render();
}
if ($("#bar_chart_sold2").length > 0) {
  var options = {
    series: [{
      data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
    }],
      chart: {
      type: 'bar',
      height: 780,
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
      categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan',
        'United States', 'China', 'Germany'
      ],
    }
  };

  var chart = new ApexCharts(
    document.querySelector("#bar_chart_sold2"),
    options
  );
  chart.render();
}
if ($("#bar_chart_sold3").length > 0) {
  var options = {
    series: [{
      data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
    }],
      chart: {
      type: 'bar',
      height: 780,
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
      categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan',
        'United States', 'China', 'Germany'
      ],
    }
  };

  var chart = new ApexCharts(
    document.querySelector("#bar_chart_sold3"),
    options
  );
  chart.render();
}
if ($("#bar_chart_sold4").length > 0) {
  var options = {
    series: [{
      data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
    }],
      chart: {
      type: 'bar',
      height: 780,
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
            color: "#86C6F8",
            opacity: 1,
          },
        ],
      },
    },
    dataLabels: {
      enabled: false
    },
    xaxis: {
      categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan',
        'United States', 'China', 'Germany'
      ],
    }
  };

  var chart = new ApexCharts(
    document.querySelector("#bar_chart_sold4"),
    options
  );
  chart.render();
}
if ($("#bar_chart_sold5").length > 0) {
  var options = {
    colors:['#F44336', '#E91E63'],
    series: [{
      data: [44, 55, 41, 64, 22, 43, 21]
    }, {
      data: [53, 32, 33, 52, 13, 44, 32]
    }],
      chart: {
      type: 'bar',
      height: 780,
    },
    plotOptions: {
      bar: {
        horizontal: true,
        borderRadius: 10,
        dataLabels: {
          position: 'top',
        },
      }
    },
    dataLabels: {
      enabled: true,
      offsetX: -6,
      style: {
        fontSize: '12px',
        colors: ['#fff']
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
            color: "#86C6F8",
            opacity: 1,
          },
        ],
      },
    },
    stroke: {
      show: true,
      width: 1,
      colors: ['#fff']
    },
    tooltip: {
      shared: true,
      intersect: false
    },
    xaxis: {
      categories: [2001, 2002, 2003, 2004, 2005, 2006, 2007],
    },
  };

  var chart = new ApexCharts(
    document.querySelector("#bar_chart_sold5"),
    options
  );
  chart.render();
}

if($('#column_chart_trend').length > 0){
  var options = {
    series: [{
    name: '',
    type: 'column',
    data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160]
  }, {
    name: '',
    type: 'line',
    data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16]
  }],
  legend: {
    show: false,
  },
  plotOptions: {
    bar: {
      borderRadius: 10,
      dataLabels: {
        position: "top",
      },
    },
  },
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
    chart: {
      height: 350,
      type: 'line',
      toolbar: {
        show: !1,
      },
  },

  stroke: {
    width: [0, 2]
  },
  markers: {
    size: 3,
    colors: '#F7B104',
    strokeColors: '#F7B104',
    strokeWidth: 2,
    strokeOpacity: 0.9,
    strokeDashArray: 0,
    fillOpacity: 1,
    discrete: [0],
    shape: "circle",
    radius: 2,
    offsetX: 0,
    offsetY: 0,
    onClick: undefined,
    onDblClick: undefined,
    showNullDataPoints: true,
},
  dataLabels: {
    enabled: false,
    enabledOnSeries: [2],
  },

  labels: ['01 Jan 2001', '02 Jan 2001', '03 Jan 2001', '04 Jan 2001', '05 Jan 2001', '06 Jan 2001', '07 Jan 2001', '08 Jan 2001', '09 Jan 2001', '10 Jan 2001', '11 Jan 2001', '12 Jan 2001'],
  xaxis: {
    type: 'datetime'
  },
  yaxis: [{
    
  }, {
    opposite: true,
  }]
  };
  
  var chart = new ApexCharts(document.querySelector("#column_chart_trend"), options);
  chart.render();
  
}
