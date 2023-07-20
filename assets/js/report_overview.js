const room_status_donut = document.getElementById('room_status_donut');
const room_type_pie = document.getElementById('room_type_pie');
const income_line = document.getElementById('annual_revenue_line');
const popular_radar = document.getElementById('popularity_radar');
const popular_bar = document.getElementById('popular_room_bar');

function drawDonutRoomStats(el){
  if(!el) return;

  const data = {
      labels:['Free', 'Staying', 'Reserved', 'Maintenance'],
      datasets: [{
          label:'Rooms',
          data: [6, 2, 4, 0],
          backgroundColor: [
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 25, 104, 0.2)',
          ],
          borderColor: [
              'rgba(75, 192, 192, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(255, 25, 104, 1)',
          ],
          borderWidth: 1,
          hoverOffset: 7
      }]
  };
  
  const config = {
      type: 'doughnut',
      data: data,
      options: {
          plugins: {
              legend: {
                  position: 'bottom',
                  align:"start",
                  labels:{
                      padding: 10,
                  }
              },
              title: {
                  display: false,
              }
          },
      },
  };

  new Chart(el, config);
}

function drawBarPopularRooms(el){

  if(!el) return;

  const data = {
      labels: ['room1', 'room2', 'room3', 'room4', 'room5'],
      datasets: [
        {
          label: ' Booked Amount',
          data: [10, 4, 2, 5, 3],
          borderColor: 'rgba(255, 129, 4)',
          backgroundColor: 'rgba(255, 129, 4, 0.3)',
        },
      ]
  };
  
  const config = {
      type: 'bar',
      data: data,
      options: {
        indexAxis: 'x',
        scales:{
          x:{
              grid:{
                display:false  
              }
          },
          y:{
              max: 12,
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

function drawLineIncome(el){
  if(!el) return;

  const labels = ['test1', 'test2', 'test3', 'test4', 'test5' , 'test6', 'test7']
  
  const data = {
      labels: labels,
      datasets: [{
          label: 'My First Dataset',
          data: [65, 59, 80, 81, 56, 55, 40],
          fill: false,
          borderColor: 'rgb(75, 192, 192)',
          tension: 0.1
      }]
  };

  const config = {
      type: 'line',
      data: data,
  };

  new Chart(el, config);

}

function drawPieRoomType(el){

  if(!el) return;

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
          position: 'bottom',
          align:"start",
          labels:{
            padding: 10,
          }
        },
        title: {
          display: false,
        }
      },
    },
  };

  new Chart(el, config);
}

function drawRadarPopularity(el){
  if(!el) return;

  const data = {
      labels: [
        'Eating',
        'Drinking',
        'Sleeping',
        'Designing',
        'Coding',
        'Cycling',
        'Running'
      ],
      datasets: [{
        label: 'My First Dataset',
        data: [65, 59, 90, 81, 56, 55, 40],
        fill: true,
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgb(255, 99, 132)',
        pointBackgroundColor: 'rgb(255, 99, 132)',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: 'rgb(255, 99, 132)'
      }, {
        label: 'My Second Dataset',
        data: [28, 48, 40, 19, 96, 27, 100],
        fill: true,
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgb(54, 162, 235)',
        pointBackgroundColor: 'rgb(54, 162, 235)',
        pointBorderColor: '#fff',
        pointHoverBackgroundColor: '#fff',
        pointHoverBorderColor: 'rgb(54, 162, 235)'
      }]
  };

  const config = {
      type: 'radar',
      data: data,
      options: {
        elements: {
          line: {
            borderWidth: 3
          }
        }
      },
  };

  new Chart(el, config);
}

$('.counter').each(function(){
    $(this).prop('Counter', 0).animate({
        Counter:$(this).text()
    },{
        duration:2000,
        easing:'swing',
        step: function (now){
            $(this).text(Math.ceil(now))
        }
    })
})

drawDonutRoomStats(room_status_donut);
drawPieRoomType(room_type_pie);
drawLineIncome(income_line);
drawRadarPopularity(popular_radar);
drawBarPopularRooms(popular_bar);