// inserção de dados nos gráficos
const data1 = {
    labels: ['Dinheiro', 'C.Credito', 'C.Debito'],
    datasets: [{
        data: [60, 20, 20],
        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
    }]
};

const data2 = {
    labels: ['Masculino', 'Feminino', 'infantil'],
    datasets: [{
        data: [40, 40, 20],
        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
    }]
};

const data3 = {
    labels: ['Custo', 'Lucro',],
    datasets: [{
        data: [40, 60,],
        backgroundColor: ['#FF6384', '#36A2EB',]
    }]
};

const data4 = {
    labels: ['Vendedor 1', 'Vendedor 2', 'Vendedor 3'],
    datasets: [{
        data: [15, 30, 55],
        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
    }]
};


// configurações para os gráficos 'doughnut'
const options = {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
        position: 'right',
        labels: {
            fontColor: '#333',
            fontSize: 12,
            padding: 10
        }
    }
};

// Renderização dos gráficos
const ctx1 = document.getElementById('chart1').getContext('2d');
new Chart(ctx1, {
    type: 'doughnut',
    data: data1,
    options: options
});

const ctx2 = document.getElementById('chart2').getContext('2d');
new Chart(ctx2, {
    type: 'doughnut',
    data: data2,
    options: options
});

const ctx3 = document.getElementById('chart3').getContext('2d');
new Chart(ctx3, {
    type: 'doughnut',
    data: data3,
    options: options
});

const ctx4 = document.getElementById('chart4').getContext('2d');
new Chart(ctx4, {
    type: 'doughnut',
    data: data4,
    options: options
});
