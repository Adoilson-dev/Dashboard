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
        enabled: false // Desabilita os tooltips
      },
      datalabels: {
        align: 'center',
        anchor: 'end',
        align: 'center',

        formatter: (value, context) => { // Função de formatação dos rótulos
          const datapoints = context.chart.data.datasets[0].data;
          function totalSum(total, datapoint) {
            return total + datapoint;
          }
          const totalValue = datapoints.reduce(totalSum, 0); // Calcula a soma total dos valores
          const percentageValue = ((value / totalValue) * 100).toFixed(1); // Calcula a porcentagem correspondente ao valor
          const display = [`${value} R$`, `${percentageValue} %`]; // Formata o rótulo com o valor e a porcentagem
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
  document.getElementById('chart1'),
  config
);