const room_ctx = document.getElementById('RoomChart').getContext('2d');
const popular_ctx = document.getElementById('PopularChart');

const PieData = {
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

const Pieconfig = {
    type: 'doughnut',
    data: PieData,
    options: {
        plugins: {
            legend: {
                position: 'top',
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

const bar_data = {
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

const bar_config = {
    type: 'bar',
    data: bar_data,
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

new Chart(room_ctx, Pieconfig);
new Chart(popular_ctx, bar_config);


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