function animateButton() {
    const button = document.querySelector('.search-bar button');
    button.classList.add('clicked');

    setTimeout(function () {
        button.classList.remove('clicked');
    }, 1000);

    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;

    // Executar a busca com as datas selecionadas
    console.log('Data Inicial:', startDate);
    console.log('Data Final:', endDate);
}


document.addEventListener('DOMContentLoaded', function () {


    // Inicializando o gráfico 1
    var chart1 = echarts.init(document.getElementById('chart-container1'));

    // Configuração dos dados do gráfico 1
    var data1 = [
        {
            "value": 1000,
            "name": "Pix"
        },
        {
            "value": 2000,
            "name": "credito"
        },
        {
            "value": 5000,
            "name": "boleto"
        },
        {
            "value": 500,
            "name": "dinheiro"
        },
        {
            "value": 800,
            "name": "debito"
        }
    ]

    // Configuração do gráfico 1
    var option1 = {


        series: [
            {
               
                type: 'pie',
                radius: [60, 100],
                top: '10%',
                height: '85%',
                left: 'center',
                width: '100%',
                data: data1,
                label: {
                    formatter: '{b}:R${c}'
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: 15,
                        fontWeight: 'bold',
                        formatter: '{b}:({d}%)'
                    }
                }
            }
        ],
        legend: {
            orient: 'horizontal',
            left: 'center',
            right: 10,
            top: 10,
            bottom: 20,
            data: data1.map(function (item) {
                return item.name;
            })
        },
    };

    // Aplicando a configuração ao gráfico 1
    chart1.setOption(option1);

    // Inicializando o gráfico 2
    var chart2 = echarts.init(document.getElementById('chart-container2'));

    // Configuração dos dados do gráfico 2
    var data2 = [
        { value: 200.50, name: 'Hortfriut' },
        { value: 800.75, name: 'Perfumaria' },
        { value: 650.25, name: 'Petshop' },
        { value: 400.00, name: 'Frios' },
        { value: 300.80, name: 'Congelados' },
        { value: 699.32, name: 'Alimentos' },
    ];

    // Configuração do gráfico 2
    var option2 = {
        series: [
            {
                type: 'pie',
                radius: [60, 100],
                top: '10%',
                height: '85%',
                left: 'center',
                width: '100%',
                data: data2,
                label: {
                    formatter: '{b}:R${c}'
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: 14,
                        fontWeight: 'bold',
                        formatter: '{b}:({d}%)'
                    }
                }
            }
        ],
        legend: {
            orient: 'horizontal',
            left: 'center',
            right: 10,
            top: 10,
            bottom: 20,
            data: data2.map(function (item) {
                return item.name;
            })
        },
    };

    // Aplicando a configuração ao gráfico 2
    chart2.setOption(option2);


    // Inicializando o gráfico 3
    var chart3 = echarts.init(document.getElementById('chart-container3'));

    // Configuração dos dados do gráfico 3
    var data3 = [
        { value: 200.50, name: 'Custo' },
        { value: 800.75, name: 'Lucro' },

    ];

    // Configuração do gráfico 3
    var option3 = {
        series: [
            {
                type: 'pie',
                radius: [60, 100],
                top: '10%',
                height: '85%',
                left: 'center',
                width: '100%',
                data: data3,
                label: {
                    formatter: '{b}:R${c}'
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: 14,
                        fontWeight: 'bold',
                        formatter: '{b}:({d}%)'
                    }
                }
            }
        ],
        legend: {
            orient: 'horizontal',
            left: 'center',
            right: 10,
            top: 10,
            bottom: 20,
            data: data3.map(function (item) {
                return item.name;
            })
        },
    };

    // Aplicando a configuração ao gráfico 3
    chart3.setOption(option3);





    // Inicializando o gráfico 3
    var chart4 = echarts.init(document.getElementById('chart-container4'));

    // Configuração dos dados do gráfico 3
    var data4 = [
        { value: 200.50, name: 'Neto' },
        { value: 400.00, name: 'Danielson' },
        { value: 153.85, name: 'Allan' },
        { value: 3000.00, name: 'Rubem jr' },
        { value: 1259.97, name: 'Cris' },

    ];

    // Configuração do gráfico 3
    var option4 = {
        series: [
            {
                type: 'pie',
                radius: [60, 100],
                top: '10%',
                height: '85%',
                left: 'center',
                width: '100%',
                data: data4,
                label: {
                    formatter: '{b}:R${c}'
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: 14,
                        fontWeight: 'bold',
                        formatter: '{b}:({d}%)'
                    }
                }
            }
        ],
        legend: {
            orient: 'horizontal',
            left: 'center',
            right: 10,
            top: 10,
            bottom: 20,
            data: data4.map(function (item) {
                return item.name;
            })
        },
    };

    // Aplicando a configuração ao gráfico 3
    chart4.setOption(option4);




    // Grafico de barras 1

    var chartDom = document.getElementById('bar1');
    var myChart = echarts.init(chartDom);
    var option;

    option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        grid: {
            left: '1%',
            right: '1%',
            bottom: '1%',
            containLabel: true
        },
        xAxis: [
            {
                type: 'category',
                data: ['Seg', 'Ter', 'Quar', 'Qui', 'Sex', 'Sab', 'Dom'],
                axisTick: {
                    alignWithLabel: true
                }
            }
        ],
        yAxis: [
            {
                type: 'value'
            }
        ],
        series: [
            {
                name: 'Valor R$',
                type: 'bar',
                barWidth: '80%',
                data: [10.00, 52.30, 200.29, 334.00, 390.99, 330.58, 220]
            }
        ]
    };

    option && myChart.setOption(option);


});