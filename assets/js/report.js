const ctx = document.getElementById('myChart');

const data = {
    labels:['January', 'February', 'March', 'April'],
    datasets: [{
      data: [300, 50, 100, 20],
      backgroundColor: [
        '#8540F5',
        '#0D6EFD',
        '#FF144F',
        '#198754'
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
        responsive: true,
    }
};

new Chart(ctx, config);