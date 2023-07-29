const overview_page = document.getElementById('overview_report');
const revenue_page = document.getElementById('revenue_report');
const navLinks = document.querySelectorAll('.nav-link');

var revenueLineChart, revenuePieChart, revenueBarChart;

const concat2Arrays=(arr1, arr2)=>{
  const newData = arr1.reduce((acc, name) => {
    const matchItem= arr2.find((item)=>item.name===name);
    acc.push({name: name, total: matchItem ? matchItem.total : 0});
    return acc;
  }, []).sort((a,b)=> new Date(a.name) - new Date(b.name));

  return newData
}

function numberCounter(el){
  $(el).prop('Counter', 0).animate({
    Counter:$(el).text()
  },{
    duration:2000,
    easing:'swing',
    step: function (now){
      $(el).text(formatNumber(Math.ceil(now)))
    }
  })
}

// Overview Graph

function last7Days() {
  var result = [];
  for (var i=0; i<7; i++) {
      var d = new Date();
      d.setDate(d.getDate() - i);
      result.push( formatDate(d) )
  }

  return result;
}

function drawDonutRoomStats(){
  const el = document.getElementById('room_status_donut');
  if(!el) return;

  $.ajax({
    url:`./controllers/report.php?chart&roomStat`,
    type:"GET",
    dataType:"JSON",
    success: function(data){
      const pieGenerateLabels = Chart.controllers.doughnut.overrides.plugins.legend.labels.generateLabels;

      const graphData = {
        labels:data.map(a => a.name),
        datasets: [{
          label:'Rooms',
          data: data.map(a => a.total),
          backgroundColor: [
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 159, 64, 0.2)',
          ],
          borderColor: [
            'rgba(75, 192, 192, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(255, 25, 104, 1)',
          ],
          borderWidth: 1,
          cutout: '70%',
          hoverOffset: 7
        }]
      };

      const centerText = {
        id: 'centerText',
        afterDatasetsDraw(chart, args, pluginOptions){
          const { ctx } = chart;
          const x = chart.getDatasetMeta(0).data[0].x;
          const y = chart.getDatasetMeta(0).data[0].y;
          const total = chart.data.datasets[0].data.reduce((a, b) => {
            return parseInt(a) + parseInt(b);
          });

          ctx.font = "bolder 20px Times New Roman";
          ctx.textAlign = "center";
          ctx.textBaseline = "middle";

          ctx.fillText(`Total: ${total}`, x, y)
        }
      }

      const config = {
        type: 'doughnut',
        data: graphData,
        options: {
          plugins: {
            legend: {
              position: 'bottom',
              align:"start",
              labels:{
                padding: 10,
                font:{
                  weight:"bold"
                },
                generateLabels(chart){
                  const labels = pieGenerateLabels(chart);
                  let total = chart.data.datasets[0].data.reduce((a, b) => {
                    return parseInt(a) + parseInt(b);
                  });

                  labels.map((item, index)=>{
                    let value = chart.data.datasets[0].data[index];
                    item.text +=`::   ${value} Rooms   (${(value / total * 100).toFixed(0)}%)`;
                  })

                  return labels
                }
              }
            },
            title: {
              display: false,
            }
          },
        },
        plugins:[centerText]
      };
    
      new Chart(el, config);
    }   
  })


}

function drawBarPopularRooms(){
  const el = document.getElementById('popular_room_bar');
  if(!el) return;

  $.ajax({
    url:`./controllers/report.php?chart&room_popularity`,
    type:"GET",
    dataType:"JSON",
    success: function(data){

      const maxValue = Math.max(...data.map(o => o.total));
      
      const graphData = {
        labels: data.map(a=>a.name),
        datasets: [{
          label: 'Booked Amount',
          data: data.map(a=>a.total),
          borderColor: 'rgba(255, 129, 4)',
          backgroundColor: 'rgba(255, 129, 4, 0.3)',
        }]
      };

      const config = {
        type: 'bar',
        data: graphData,
        options: {
          maintainAspectRatio: false,
          indexAxis: 'x',
          scales:{
            x:{
              grid:{
                display:false  
              }
            },
            y:{
              max: maxValue + 1,
              ticks:{
                stepSize:Math.ceil(maxValue / 5)
              }
            }
          },
          barPercentage: 0.5,
          elements: {
            bar: {
              borderWidth: 2,
            }
          },
          responsive: true,
          plugins: {
            legend: {
              display:false
            },
            title: {
              display: false,
            }
          }
        },
      };

      new Chart(el, config);
    }
  })

}

function drawLineIncome(){
  const el = document.getElementById('annual_revenue_line');
  if(!el) return;

  $.ajax({
    url:`./controllers/report.php?revenue&weekly`,
    type:"GET",
    dataType:"JSON",
    success: function(data){
      const newData = concat2Arrays(last7Days(), data)

      const labels = newData.map(a=>a.name);

      const graphData = {
          labels: labels,
          datasets: [{
              label:'Revenue',
              data: newData.map(a=>a.total),
              fill: false,
              borderColor: 'rgb(114, 57, 234)',
              tension: 0.5
          }]
      };

      const config = {
          type: 'line',
          data: graphData,
          options:{
            maintainAspectRatio: false,
            scales:{
              x:{
                grid:{
                  display:false  
                }
              },
              y:{
                ticks: {
                  stepSize:2000000
                }
              }
            },
            plugins:{
              legend:{
                display:false
              }
            }
          }
      };
    
      new Chart(el, config);
    }
  })


}

function drawPieRoomType(){
  const el = document.getElementById('room_type_pie');

  if(!el) return;

  $.ajax({
    url:`./controllers/report.php?chart&roomType`,
    type:"GET",
    dataType:"JSON",
    success: function(data){
      var options = {
        labels: data.map(a => a.name),
        series: data.map(a => parseInt(a.total)),
        plotOptions: {
          pie: {
            dataLabels: {
              offset: -10,
            }, 
          }
        },
        chart: {
            type: 'pie',
            height:'240px',
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
    
      var chart = new ApexCharts(el, options);
      chart.render();
    }
  })

 
}

function reportRoomsPopular(val){
  var url;
  const ctx = Chart.getChart('popular_room_bar');

  if(val==="count") url=`./controllers/report.php?chart&room_popularity`;
  else url = `./controllers/report.php?chart&room_revenue`;

  $.ajax({
    url:url,
    type:"GET",
    dataType:"JSON",
    success: function(data){
      const maxValue = Math.max(...data.map(o => o.total));

      ctx.data.labels = data.map(a=>a.name);
      ctx.data.datasets.forEach((dataset) => {
          dataset.data=data.map(a=>a.total);
      });
      ctx.options.scales.y = {
        max: val==="count"? maxValue + 1 : Math.round(maxValue/Math.pow(10, 7)) * Math.pow(10, 7),
        ticks:{
          stepSize:val==="count"? Math.ceil(maxValue / 5) : Math.round(maxValue/Math.pow(10, 7)) * Math.pow(10, 7) / 5
        }
      };

      ctx.update();
    }
  })

}

// Revenue Graph

function lastMonthWeeks(){
  var result = [];
  const today = moment(new Date());
  const lastMonth = moment(today).subtract(1, "months");

  for(var date = today; date >= lastMonth; date.subtract(7, 'days')){
    result.push(date.format("YYYY-MM-DD"));
  }

  return result.sort()

}

function last6Months(){
  var result = [];
  const now = moment();

  for (var i=0; i<6; i++) {
      const month = now.subtract(i, 'months')
      result.push( month.format('MMMM YYYY'))
  }

  return result;
}

function last12Months(){
  var result = [];
  const now = moment();

  for (var i=0; i<12; i++) {
      const month = now.subtract(i, 'months')
      result.push( month.format('MMMM YYYY'))
  }

  return result;
}

function updateStatics(array, index, el){
  const total = array.reduce((val, item) => {
    val += parseInt(item[index]);
    return val;
  }, 0)

  $(el).text(total);
  numberCounter(el)
}

function drawApexBookingLineChart(){

  var element = document.querySelector("#main_booking_graph");

  if (!element) {
      return;
  }

  $.ajax({
    url:`./controllers/report.php?revenue&weekly`,
    type:"GET",
    dataType:"JSON",
    success: function(data){
      const newData = concat2Arrays(last7Days(), data);

      updateStatics(data, 'total', '#revenue_total');
      updateStatics(data, 'count', '#bookings_total');

      var options = {
        chart: {
          height: 300,
          type: "area",
          fontFamily: 'Times New Roman',
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
            data: newData.map(a=>a.total)
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
        yaxis:{
          labels:{
            show: true,
            style: {
              fontSize: '13px',
              fontWeight: 900,
            },
            formatter: function(value) {
              var val = Math.abs(value)
              if (val >= 1000000) {
                val = formatNumber((val / 1000)) + ' K'
              }
              return val
            }
          },
        },
        xaxis: {
            categories: newData.map(a=>a.name),
            labels:{
              show: true,
              formatter: undefined,
              offsetY: 0,
              style: {
                fontSize: '15px',
                fontWeight: 900,
              }
            },
            tooltip: {
              enabled: false,
            }
        },
        tooltip: {
          style: {
            fontSize: '12px'
          },
          y: {
            formatter: function (val) {
              return formatNumber(val) + ' KIP'
            }
          }
        },
      };
      
      revenueLineChart = new ApexCharts(element, options);
      
      revenueLineChart.render();
    }
  })

}

function drawApexPopularRoomBarChart(){

  var element = document.getElementById('booking_popularity_bar');

  if (!element) {
      return;
  }

  $.ajax({
    url:`./controllers/report.php?chart&room_bar_chart`,
    type:"POST",
    data:{
      period:"1w"
    },
    dataType:"JSON",
    success: function(data){

      const maxValue = Math.max(...data.map(o => o.total));
      $('#room_name_period').text(data.sort((a,b)=> b.total - a.total)[0].name);

      var options = {
        series: [{
          name: 'Number',
          data: data.map(a=>a.total)
        }],
        chart: {
          type: 'bar',
          height:'220px',
          fontFamily: 'Times New Roman',
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
          categories: data.map(a=>a.name),
          axisBorder: {
            show: false,
          },
          axisTicks: {
            show: false
          },
          labels: {
            style: {
              fontSize: '14px',
              fontWeight:900,
            },
          },
        },
        yaxis: {
          labels: {
            style: {
              colors: '#6C757D',
              fontSize: '13px'
            }
          },
          min: 0,
          max: Math.ceil(maxValue/5) * 5,
          tickAmount: 5,
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
      revenueBarChart = new ApexCharts(element, options);
      revenueBarChart.render();
    }
  })
}

function drawApexPopularRoomPieChart(){

  var element = document.getElementById('booking_popularity_pie');

  if (!element) {
      return;
  }

  $.ajax({
    url:`./controllers/report.php?chart&room_pie_chart`,
    type:"POST",
    data:{
      period:"1w"
    },
    dataType:"JSON",
    success: function(data){

      $('#room_type_period').text(data.sort((a,b)=> b.total - a.total)[0].name);

      var options = {
        labels: data.map(a=>a.name),
        series: data.map(a=>parseInt(a.total)),
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
            fontFamily: 'Times New Roman',
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
    
      revenuePieChart = new ApexCharts(element, options);
      revenuePieChart.render();
    }
  })

}

function updatePeriodBookings(data, el){
  var status = data.status;
  var price = data.total / data.duration

  if(status==="Staying"){
    bg = "bg-primary";
    stat_lang="booking.status.stay";
  }
  else if (status==="Reserved"){
    bg = "bg-warning";
    stat_lang="booking.status.reserve";
  }
  else if (status==="Cancelled"){
    bg = "bg-danger";
    stat_lang="booking.status.cancel";
  }
  else{
    bg = "bg-success"; 
    stat_lang="booking.status.finish";
  }
  
  var display = `
    <tr class="text-center fw-bold" style="font-size: 16px;">                            
      <td class="d-flex justify-content-start flex-column">
        <div class="text-start en-font">${data.id}</div>
        <span class="fw-semibold d-block text-body-tertiary text-start">(${data.employee})</span>
      </td>
      <td>
        <span class="text-dark en-font">${data.checkIn}</span>                                
      </td>
      <td>
        <span class="text-dark en-font">${data.checkOut}</span>                                
      </td>
      <td>
        <span class="text-dark en-font">${data.duration}</span>                                
        <span data-i18n="booking.table.night"></span>                                
      </td>
      <td>
        <span class="text-dark en-font">${formatNumber(price)} KIP</span>                                
      </td>
      <td>
        <span class="text-dark en-font">${formatNumber(data.total)} KIP</span>                                
      </td>
      <td>
        <span class="badge ${bg} pt-1" style="font-size: 13px;" data-i18n=${stat_lang}> </span>                                                                  
      </td>  
    </tr>
  `;

  el.innerHTML += display;

  $('body').localize();
}

function setActiveRevenuePeriod(period){
  var period_lang, param, array;

  if(period==="1w"){
    period_lang = "report.revenue.duration.weekly";
    param = "weekly";
    array = last7Days();
  }
  if(period==="1m"){
    period_lang = "report.revenue.duration.month";
    param = "monthly";
    array = lastMonthWeeks();
  }
  if(period==="6m"){
    period_lang = "report.revenue.duration.half";
    param = "6months";
    array = last6Months();
  }
  if(period==="1y"){
    period_lang = "report.revenue.duration.year";
    param = "yearly";
    array = last12Months();
  }

  $.ajax({
    url:`./controllers/report.php?revenue&${param}`,
    type:"GET",
    dataType:"JSON",
    success: function(data){
      const newData = concat2Arrays(array, data);

      updateStatics(data, 'total', '#revenue_total');
      updateStatics(data, 'count', '#bookings_total');

      revenueLineChart.updateOptions({
        xaxis: {
           categories: newData.map(a=>a.name)
        },
        series: [{
           data: newData.map(a=>a.total)
        }],
      });
    }
  })

  $.ajax({
    url:`./controllers/report.php?chart&room_bar_chart`,
    type:"POST",
    data:{
      period: period
    },
    dataType:"JSON",
    success: function(data){
      $('#room_name_period').text(data.sort((a,b)=> b.total - a.total)[0].name);
      
      const maxValue = Math.max(...data.map(o => o.total));

      revenueBarChart.updateOptions({
        xaxis: {
          categories: data.map(a=>a.name)
        },
        yaxis: {
          max: Math.ceil(maxValue/5) * 5,
          tickAmount: 5,
        },
        series: [{
          data: data.map(a=>a.total)
        }],
      });
    }
  })

  $.ajax({
    url:`./controllers/report.php?chart&room_pie_chart`,
    type:"POST",
    data:{
      period: period
    },
    dataType:"JSON",
    success: function(data){
      $('#room_type_period').text(data.sort((a,b)=> b.total - a.total)[0].name);
    
      revenuePieChart.updateOptions({
        labels: data.map(a=>a.name),
        series: data.map(a=>parseInt(a.total)),
     });
    }
  })

  $.ajax({
    url:`./controllers/report.php?bookings`,
    type:"POST",
    data:{
      period: period
    },
    dataType:"JSON",
    success: function(data){
      console.log(data);
      const el = document.getElementById("period_bookings");
      el.innerHTML="";

      data.map((item)=>{
        updatePeriodBookings(item, el);
      })
    }
  })

  $('.period_value').attr("data-i18n", period_lang);

  $("#revenue_report").localize();
}

if(navLinks){
  navLinks.forEach((navLink) => {
    navLink.addEventListener('click', () => {
      navLink.children[1].classList.remove('opacity-0');
      navLink.children[1].classList.add('opacity-100');
  
      navLinks.forEach((otherLink) => {
        if (otherLink !== navLink) {
          otherLink.children[1].classList.remove('opacity-100');
          otherLink.children[1].classList.add('opacity-0');
        }
      });
    });
  });
}

// init 

$('.counter').each(function(){
  numberCounter(this);
})

if(overview_page){

  drawDonutRoomStats();
  drawPieRoomType();
  drawLineIncome();
  drawBarPopularRooms();
}

if(revenue_page){
  drawApexBookingLineChart();
  drawApexPopularRoomBarChart();
  drawApexPopularRoomPieChart();
}


