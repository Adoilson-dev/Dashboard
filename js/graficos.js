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
    
    // Chamar a função para atualizar os dados no PHP
    atualizarDadosPHP(startDate, endDate);
}

// Função para atualizar os dados no PHP
function atualizarDadosPHP(startDate, endDate) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'api.php?startDate=' + startDate + '&endDate=' + endDate, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log('Dados atualizados com sucesso.');
            // Após atualizar os dados no PHP, chame a função para atualizar o gráfico
            atualizarGrafico();
        } else {
            console.error('Erro ao atualizar os dados:', xhr.status);
        }
    };
    xhr.send();
}

// Inicializando o gráfico
var chart1 = echarts.init(document.getElementById('chart-container1'));

// Função para atualizar o gráfico com os dados do arquivo
function atualizarGrafico() {
    fetch('dados.txt')
      .then(response => response.json())
      .then(dados => {
        // Configuração do gráfico
        var option1 = {
          series: [
            {
              type: 'pie',
              radius: [60, 100],
              top: '10%',
              height: '85%',
              left: 'center',
              width: '100%',
              data: dados,
              label: {
                formatter: '{b}: R${c}'
              },
              emphasis: {
                label: {
                  show: true,
                  fontSize: 15,
                  fontWeight: 'bold',
                  formatter: '{b}: ({d}%)'
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
            data: dados.map(function (item) {
              return item.name;
            })
          }
        };

        // Atualizar o gráfico com os novos dados
        chart1.setOption(option1);
      })
      .catch(error => {
        console.error('Erro ao buscar os dados do arquivo:', error);
      });
}

// Chamar a função para atualizar o gráfico com os dados iniciais
atualizarGrafico();
