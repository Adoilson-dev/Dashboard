const dataVendasVendedor = {
    labels: ['Vendedor 1', 'Vendedor 2', 'Vendedor 3', 'Vendedor 4', 'Vendedor 5'],
    datasets: [{
      data: [2500, 1800, 3200, 1500, 2800],
      borderWidth: 1,
      cutout: '60%',
    }]
  };

  const configVendasVendedor = {
    type: 'bar',
    data: dataVendasVendedor,
    options: {
      indexAxis: 'y',
      plugins: {
        tooltip: {
          enabled: true // Desabilita os tooltips
        },
        datalabels: {
          color: 'black',
          anchor: 'center',
          align:'end',
          formatter: (value, context) => {
            const labels = context.chart.data.labels; // Obtém as etiquetas dos vendedores
            const datapoints = context.chart.data.datasets[0].data;

            function totalSum(total, datapoint) {
              return total + datapoint;
            }

            const totalValue = datapoints.reduce(totalSum, 0);
            const percentageValue = ((value / totalValue) * 100).toFixed(1);
            const label = labels[context.dataIndex]; // Obtém o nome do vendedor correspondente ao rótulo atual
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

  const myChartVendasVendedor = new Chart(
    document.getElementById('chart-vendas-vendedor'),
    configVendasVendedor
  );