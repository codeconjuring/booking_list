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
  // var options = {
  //   colors: ["#2D8AFD", "#4576b5"],
  //   series: [
  //     {
  //       name: "Marine Sprite",
  //       borderRadius: 10,
  //       data: [44, 55, 41],
  //     },
  //     {
  //       name: "Striking Calf",
  //       data: [53, 32, 33],
  //     },
  //   ],
  //   chart: {
  //     type: "bar",
  //     height: 350,
  //     stacked: true,
  //   },
  //   plotOptions: {
  //     bar: {
  //       borderRadius: 10,
  //       horizontal: true,
  //     },
  //   },
  //   stroke: {
  //     width: 1,
  //     colors: ["#fff"],
  //   },
  //   title: {
  //     text: "Fiction Books Sales",
  //   },
  //   xaxis: {
  //     categories: [2008, 2009, 2010, 2011, 2012, 2013, 2014],
  //     labels: {
  //       formatter: function (val) {
  //         return val + "K";
  //       },
  //     },
  //   },
  //   yaxis: {
  //     title: {
  //       text: undefined,
  //     },
  //   },
  //   tooltip: {
  //     y: {
  //       formatter: function (val) {
  //         return val + "K";
  //       },
  //     },
  //   },
  //   fill: {
  //     type: "gradient",
  //     gradient: {
  //       type: "horizontal",
  //       shadeIntensity: 1,
  //       opacityFrom: 0.7,
  //       opacityTo: 0.9,
  //       colorStops: [
  //         {
  //           offset: 0,
  //           color: "#f7b10400",
  //           opacity: 1,
  //         },
  //         {
  //           offset: 100,
  //           color: "#f7b104ab",
  //           opacity: 1,
  //         },
  //       ],
  //     },
  //   },
  //   legend: {
  //     position: "top",
  //     horizontalAlign: "left",
  //     offsetX: 40,
  //   },
  // };

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
