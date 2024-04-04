// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Line Chart Example
var ctx = document.getElementById("myLineChart");
var myLineChart = new Chart(ctx, {
  type: 'horizontalBar', // Cambiado a horizontalBar
  data: {
      labels: [],
      datasets: [{
          label: 'Cantidad de productos vendidos',
          backgroundColor: 'rgba(2,117,216,1)',
          borderColor: 'rgba(2,117,216,1)',
          data: []
      }]
  },
  options: {
      scales: {
          xAxes: [{
              ticks: {
                  min: 0,
                  maxTicksLimit: 5
              },
              gridLines: {
                  display: true
              }
          }],
          yAxes: [{
              time: {
                  unit: 'month'
              },
              gridLines: {
                  display: false
              },
              ticks: {
                  maxTicksLimit: 6
              }
          }]
      },
      legend: {
          display: false
      }
  }
});
// Obtener datos del API
fetch('/venta-por-dia')
.then(response => response.json())
.then(data => {
  // Actualizar las etiquetas del gráfico con las fechas obtenidas del API
  myLineChart.data.labels = data.map(item => item.fecha);
  // Actualizar los datos del gráfico con la cantidad de productos vendidos obtenida del API
  myLineChart.data.datasets[0].data = data.map(item => parseFloat(item.cantidad_productos_vendidos));
  // Actualizar el gráfico
  myLineChart.update();
})
.catch(error => {
  console.error('Error al obtener los datos del API:', error);
});
