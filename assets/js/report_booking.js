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

function drawApexPopularRoomBarChart(){

    var element = document.getElementById('booking_popularity_bar');

    if (!element) {
        return;
    }

    var options = {
        series: [{
            name: 'Number',
            data: [4, 5, 2, 4, 6]
        }],
        chart: {
            type: 'bar',
            height:'220px',
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                borderRadius: 4,
                columnWidth: ['40%'],
                endingShape: 'rounded',
                barHeight: '100%',
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
            categories: ['A-101', 'A-101', 'A-101', 'A-101', 'A-101'],
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    fontSize: '12px'
                },
            },
        },
        yaxis: {
            labels: {
                style: {
                    colors: '#D2D5E1',
                    fontSize: '13px'
                }
            },
            min: 0,
            max: 8,
            tickAmount: 4,
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
                    return val + ' bookings'
                }
            }
        },
        colors: ['#FFC700'],
        grid: {
            borderColor: '#D2D5E1',
            strokeDashArray: 3,
        }
    };

    var chart = new ApexCharts(element, options);
    chart.render();
}

function drawApexPopularRoomPieChart(){

    var element = document.getElementById('booking_popularity_pie');

    if (!element) {
        return;
    }

    var options = {
        series: [2, 6, 1, 5],
        plotOptions: {
            pie: {
                dataLabels: {
                    offset: -10,
                }, 
            }
        },
        chart: {
            type: 'pie',
            height:'220px',
            sparkline: {
                enabled: true
            }
        },
        legend: {
            show:false
        },
        dataLabels: {
            enabled: true,
            formatter: function(value, { seriesIndex, dataPointIndex, w }) {
                return [w.config.labels[seriesIndex].split(' ')[0], ` (${parseInt(value)}%)`]
            },
            style: {
                fontSize: '12px',
                fontFamily: 'Helvetica, Arial, sans-serif',
                fontWeight: 'bold',
            },
            background: {
                enabled: true,
                foreColor: '#000',
                padding: 4,
                borderRadius: 2,
                borderWidth: 1,
                borderColor: '#000',
                opacity: 0.2,
            },
            dropShadow: {
                enabled: false,
                top: 1,
                left: 1,
                blur: 1,
                color: '#222',
                opacity: 0.45
            },
        },
        colors: [
            'rgba(255, 26, 104, 0.5)',
            'rgba(54, 162, 235, 0.5)',
            'rgba(255, 206, 86, 0.5)',
            'rgba(25, 135, 84, 0.5)',
        ],
        labels: ['Single Room', 'Double Room', 'VIP Room', 'Deluxe Room'],
        tooltip: {
            custom: function({seriesIndex, dataPointIndex, w}) {

              var name = w.config.labels[seriesIndex].split(' ')[0];
              var value = w.config.series[seriesIndex];
              var color = w.config.colors[seriesIndex];

              return `<div class='py-2 px-3' style="background:${color}">
                <span>${name}: ${value} rooms</span>
              </div>`;
            },
            fillSeriesColor: true,
        }
    };

    var chart = new ApexCharts(element, options);
    chart.render();
}

function setActiveRevenuePeriod(period){
    var period_lang;
  
    if(period==="1w") period_lang = "report.revenue.duration.week";
    if(period==="1m") period_lang = "report.revenue.duration.month";
    if(period==="6m") period_lang = "report.revenue.duration.half";
    if(period==="1y") period_lang = "report.revenue.duration.year";
  
    $('.period_value').attr("data-i18n", period_lang);

    $("#report-revenue").localize();
}
  

drawApexBookingLineChart();
drawApexPopularRoomBarChart();
drawApexPopularRoomPieChart();