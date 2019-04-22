var myChartObject = document.getElementById('myChart');
var chart = new Chart(myChartObject,{
    type: 'line',

    data: {
        labels: ['1.4.2019','','5.4.2019','10.4.2019','15.4.2019','20.4.2019','25.4.2019','31.4.2019'],
        datasets: [{
            label: 'Clothes',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(235, 79, 112)',
            data: [0,-5,5,20]
        }]
    },

    options: {
    }
})