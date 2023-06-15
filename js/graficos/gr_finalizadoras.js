

// Setup
const data = {
  labels: ['Dinheiro', 'Pix', 'C.Credito', 'C.Debito', 'Boleto', 'A Prazo', 'Trnsf.Bancaria'],
  datasets: [{
    label: 'Vendas por Finalizadoras',
    data: [1500, 2000, 3000, 600, 800, 454, 745],

    borderWidth: 1,
    cutout: '60%',
  }]
};


// config do grafico
const config = {
  type: 'doughnut',
  data: data,
  options: {
    plugins: {
      tooltip: {
        enabled: true // Desabilita os tooltips
      },
      datalabels: {
        color: 'black',
        anchor: 'center',
        align:'end',

        
        formatter: (value, context) => {
          const labels = context.chart.data.labels; // Obtém as etiquetas das formas de pagamento
          const datapoints = context.chart.data.datasets[0].data;
        
          function totalSum(total, datapoint) {
            return total + datapoint;
          }
        
          const totalValue = datapoints.reduce(totalSum, 0);
          const percentageValue = ((value / totalValue) * 100).toFixed(1);
          const label = labels[context.dataIndex]; // Obtém o nome da forma de pagamento correspondente ao rótulo atual
          const display = [`${label}: R$${value} (${percentageValue}%)`]; // Adiciona o nome, valor e porcentagem ao rótulo
          return display;
        }
      }
    },
    responsive: true,
    maintainAspectRatio: false
  },
  plugins: [ChartDataLabels]
};


const myChart = new Chart(
  document.getElementById('chart-finalizadoras'),
  config
);