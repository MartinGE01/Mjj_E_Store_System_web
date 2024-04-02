// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Cantidad de productos por categoría',
            backgroundColor: 'rgba(2,117,216,1)',
            borderColor: 'rgba(2,117,216,1)',
            data: []
        }]
    },
    options: {
        scales: {
            xAxes: [{
                time: {
                    unit: 'month'
                },
                gridLines: {
                    display: false
                },
                ticks: {
                    maxTicksLimit: 6
                }
            }],
            yAxes: [{
                ticks: {
                    min: 0,
                    maxTicksLimit: 5
                },
                gridLines: {
                    display: true
                }
            }]
        },
        legend: {
            display: false
        }
    }
});

// Obtener los datos de getProductosPorCategoria desde el controlador
fetch('/get-productos-por-categoria')
.then(response => response.json())
.then(data => {
    // Actualizar los datos del gráfico con los datos obtenidos del controlador
    myBarChart.data.labels = data.map(item => item.nombre);
    myBarChart.data.datasets[0].data = data.map(item => item.count);
    myBarChart.update();
})
.catch(error => {
    console.error('Error al obtener los datos del controlador:', error);
});
