function drawApexBookingLineChart(){

    var element = document.querySelector("#main_booking_graph");

    if (!element) {
        return;
    }

    var options = {
        chart: {
          height: 280,
          type: "area"
        },
        legend: {
            show: false
        },
        dataLabels: {
            enabled: false
        },
        series: [
          {
            name: "Net Profit",
            data: [45, 52, 38, 45, 19, 23, 2]
          }
        ],
        fill: {
          type: "gradient",
          gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.7,
            opacityTo: 0.9,
            stops: [0, 90, 100]
          }
        },
        xaxis: {
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
            tooltip: {
                enabled: true,
                formatter: undefined,
                offsetY: 0,
                style: {
                    fontSize: '12px'
                }
            }
        },
        tooltip: {
            style: {
                fontSize: '12px'
            },
            y: {
                formatter: function (val) {
                    return '$' + val + ' thousands'
                }
            }
        },
      };
      
      var chart = new ApexCharts(element, options);
      
      chart.render();
}

function drawApexPopularRoomBarChart(element){

    var element = document.getElementById('booking_popularity_bar');

    if (!element) {
        return;
    }

    var options = {
        series: [{
            name: 'Net Profit',
            data: [44, 55, 57, 56, 61, 58]
        }],
        chart: {
            fontFamily: 'inherit',
            type: 'bar',
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: true,
                columnWidth: ['30%'],
                endingShape: 'rounded'
            },
        },
        legend: {
            show: false
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
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    colors: '#D2D5E1',
                    fontSize: '12px'
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: '#D2D5E1',
                    fontSize: '12px'
                }
            }
        },
        fill: {
            opacity: 1
        },
        states: {
            normal: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            hover: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            active: {
                allowMultipleDataPointsSelection: false,
                filter: {
                    type: 'none',
                    value: 0
                }
            }
        },
        tooltip: {
            style: {
                fontSize: '12px'
            },
            y: {
                formatter: function (val) {
                    return '$' + val + ' thousands'
                }
            }
        },
        colors: ['#FFC700'],
        grid: {
            borderColor: '#D2D5E1',
            strokeDashArray: 4,
            yaxis: {
                lines: {
                    show: true
                }
            }
        }
    };

    var chart = new ApexCharts(element, options);
    chart.render();
}

function drawApexPopularRoomTypePieChart(){
    var element = document.getElementById('booking_popularity_pie');
    if (!element) {
        return;
    }
    const data = {
        labels: [
          'Red',
          'Blue',
          'Yellow'
        ],
        datasets: [{
          label: 'My First Dataset',
          data: [300, 50, 100],
          backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
          ],
          hoverOffset: 4
        }]
    };
  
    const config = {
        type: 'pie',
        data: data,
        options: {
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: false,
                }
            },
        },
    };
  
    new Chart(element, config);
}

drawApexBookingLineChart();
drawApexPopularRoomBarChart();
drawApexPopularRoomTypePieChart();