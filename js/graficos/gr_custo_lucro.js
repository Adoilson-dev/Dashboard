const dataCustoLucro = {
    labels: ['Custo', 'Lucro'],
    datasets: [{
      data: [5000, 3000],
      borderWidth: 1,
      cutout: '60%',
    }]
  };

  const configCustoLucro = {
    type: 'doughnut',
    data: dataCustoLucro,
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
            const labels = context.chart.data.labels; // Obtém as etiquetas de custo e lucro
            const datapoints = context.chart.data.datasets[0].data;

            function totalSum(total, datapoint) {
              return total + datapoint;
            }

            const totalValue = datapoints.reduce(totalSum, 0);
            const percentageValue = ((value / totalValue) * 100).toFixed(1);
            const label = labels[context.dataIndex]; // Obtém o nome de custo ou lucro correspondente ao rótulo atual
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

  const myChartCustoLucro = new Chart(
    document.getElementById('chart-custo-lucro'),
    configCustoLucro
  );