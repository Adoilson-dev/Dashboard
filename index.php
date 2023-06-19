<?php

// variavel para Conexão com o banco de dados
$host = '127.0.0.1';
$dbName = 'sistemasit';
$username = 'root';
$password = '123456';
$port = 3306;

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter as datas do formulário
    $dataInicial = $_POST['data-inicial'];
    $dataFinal = $_POST['data-final'];

    // Conexão com o banco de dados
    $conexao = mysqli_connect($host, $username, $password, $dbName, $port);

    // Verificar se ocorreram erros de conexão
    if (mysqli_connect_errno()) {
        die("Falha na conexão: " . mysqli_connect_error());
    }

    // Consulta SQL com busca por data
    $query = "SELECT GROUP_CONCAT(fodesc) AS nome, GROUP_CONCAT(valor) AS valor
        FROM (
            SELECT sfeform.focodi, SUM(sfepaav.pavalor) AS valor
            FROM sfepaav
            JOIN sfeform ON sfepaav.padocum = sfeform.focodi
            WHERE sfepaav.padata BETWEEN '$dataInicial' AND '$dataFinal'
            GROUP BY sfeform.focodi
        ) AS subquery
        JOIN sfeform ON subquery.focodi = sfeform.focodi";

    $resultado = mysqli_query($conexao, $query);

    // Verificar erros de consulta
    if (!$resultado) {
        die("Erro na consulta: " . mysqli_error($conexao));
    }

    $dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

    $nomes = explode(',', $dados['nome']);
    $valores = explode(',', $dados['valor']);

    // Fechar a conexão com o banco de dados
    mysqli_close($conexao);
} else {
    
    // se o formulario retornar vazio atribuir dados inciais vazios
    
    $dataInicial = '';
    $dataFinal = '';
    $nomes = [];
    $valores = [];
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://Idealer-up.com.br/logo_sit.png" type="image/png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./assets/frameworks/cdn.jsdelivr.net_npm_chart.js@4.3.0_dist_chart.umd.min.js"></script>
    <script src="./assets/frameworks/cdn.jsdelivr.net_npm_chartjs-plugin-datalabels@2.0.0"></script>
    <link href='./assets/frameworks/unpkg.com_boxicons@2.1.4_css_boxicons.min.css' rel='stylesheet' hrf="menu">
    <link rel="stylesheet" href="./assets/frameworks/cdnjs.cloudflare.com_ajax_libs_font-awesome_5.15.3_css_all.min.css">
    <link rel="stylesheet" href="./assets/frameworks/cdnjs.cloudflare.com_ajax_libs_normalize_8.0.1_normalize.min.css">
    <link rel="stylesheet" href="./assets/css/menu.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
    <link rel="stylesheet" href="./assets/css/seach-bar.css">
    <link rel="stylesheet" href="./assets/css/nav-bar.css">
    <link rel="stylesheet" href="./assets/css/charts.css">
    <link rel="stylesheet" href="./assets/css/preloader.css">
    <title>Sit web</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');

        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>

</head>

<body>

    <header>
        <nav class="navbar">
            <img class="navbar-icon" src="https://Idealer-up.com.br/logo_sit.png">
            <span class="navbar-title">Sit Dashboard</span>

            <ul class="nav-list">
                <li><i class='bx bxs-basket'></i></i><a href="#">Vendas</a></li>
                <li><i class='bx bx-package'></i><a href="#">Estoque</a></li>
                <li><i class='bx bxs-dollar-circle'></i><a href="#">Financeiro</a></li>
            </ul>


            <button class="logout-button">Sair <i class="fas fa-sign-out-alt"></i></button>
        </nav>

        <div class="menu-mobile">
            <div class="menu_content">
                <div class="item floating_item" style="background-color: #0081CF; z-index: 1; rotate: 45deg;">
                    <i class='bx bx-x'></i>
                </div>
                <div class="options">
                    <div class="item" style="background-color: #333;">
                        <i class='bx bxs-basket'></i>
                    </div>
                    <div class="item" style="background-color: #333;">
                        <i class='bx bx-package'></i>
                    </div>
                    <div class="item" style="background-color: #333;">
                        <i class='bx bxs-dollar-circle'></i>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="search-bar">
        <div class="usuario-colun">
            <div class="infor-usuario">
                <label for="Empresa"><i class="fas fa-city"></i> Empresa: Nome empresa aqui</label>

            </div>
            <div class="infor-usuario">
                <label for="user"><i class="fas fa-address-card"></i> Usuario: Rubem jr</label>
            </div>
        </div>

   

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div>
            <label class="data-legend" for="data-inicial">Data Inicial:</label>
            <input type="date" id="data-inicial" name="data-inicial" value="<?php echo $dataInicial; ?>">
            <label class="data-legend" for="data-final">Data Final:</label>
            <input type="date" id="data-final" name="data-final" value="<?php echo $dataFinal; ?>">
            <button type="submit">Buscar</button>
        </div>
    </form>

 </div>


    <div class="quadro">

        <div class="quadrado_fundo_totalizadores">
            <i class="fas fa-cash-register"></i>
            <h2>Fluxo de Vendas</h2>
            <p>Quantidade: 5</p>
        </div>

        <div class="quadrado_fundo_totalizadores">
            <i class="fas fa-file-invoice-dollar"></i>
            <h2>Total do Faturamento</h2>
            <p>R$ 10.000,00</p>
        </div>

        <div class="quadrado_fundo_totalizadores">
            <i class="fas fa-chart-line"></i>
            <h2>Lucro no periodo</h2>
            <p>R$ 5.000,00</p>
        </div>

        <div class="quadrado_fundo_totalizadores">
            <i class="fas fa-tags"></i>
            <h2>Descontos concedidos</h2>
            <p>R$ 2.000,00</p>
        </div>

        <div class="quadrado_fundo_totalizadores">
            <i class="fas fa-ticket-alt"></i>
            <h2>Ticket Médio</h2>
            <p>R$ 100,00</p>
        </div>

        <div class="quadrado_fundo_totalizadores">
            <i class="fas fa-ban"></i>
            <h2>Vendas Canceladas</h2>
            <p>Quantidade: 5</p>
            <p>Valor Total: R$ 500,00</p>
        </div>



    </div>

    <div class="alinhamento">
        <div class="square">
            <div class="chart-title"><i class="fas fa-wallet"></i> Vendas x Finalizadoras</div>
            <div class="chart-container">
                <canvas id="chart-finalizadoras"></canvas>
            </div>
        </div>

        <div class="square">
            <div class="chart-title"><i class="fas fa-table"></i> Vendas x Categoria/linha</div>
            <div class="chart-container">
                <canvas id="chart-categoria"></canvas>
            </div>
        </div>

        <div class="square">
            <div class="chart-title"><i class="fas fa-balance-scale"></i> Custo x Lucro</div>
            <div class="chart-container">
                <canvas id="chart-custo-lucro"></canvas>
            </div>
        </div>

        <div class="square">
            <div class="chart-title"><i class="fas fa-users"></i> Vendas por vendedor</div>
            <div class="chart-container">
                <canvas id="chart-vendas-vendedor"></canvas>
            </div>
        </div>

        <div class="square">
            <div class="chart-title"><i class="far fa-calendar-alt"></i> Comparativo Semanal</div>
            <div class="chart-container">
                <canvas id="chart-comparativo-semanal"></canvas>
            </div>
        </div>

    </div>

    </div>
    </head>
    <!-- início do preloader -->
    <div id="preloader">
        <div class="inner">
            <!-- HTML DA ANIMAÇÃO MUITO LOUCA DO SEU PRELOADER! -->
            <div class="bolas">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- fim do preloader -->

    <footer class="footer">
        <div class="container">
            <p>© 2023 Sit Dashboard. Todos os direitos reservados.
                Desenvolvido por <a href="https://sitsys.com.br">SistemaSIT</a>.</p>
        </div>
    </footer>


    <script src="./js/menu.js"></script>
    <script src="./js/preloader.js"></script>
    <!--<script src="./js/graficos/gr_finalizadoras.js"></script>
    <script src="./js/graficos/gr_categoria.js"></script>
    <script src="./js/graficos/gr_custo_lucro.js"></script>
    <script src="./js/graficos/gr_vendedor.js"></script>
    <script src="./js/graficos/gr_comparatipo.js"></script>-->
</body>

<script>
    const dataFinalizadoras = {
      labels: [<?php echo "'" . implode("','", $nomes) . "'"; ?>],
      datasets: [{
        data: [<?php echo implode(',', $valores); ?>],
        borderWidth: 1,
        cutout: '60%',
      }]
    };

    const configFinalizadoras = {
      type: 'doughnut',
      data: dataFinalizadoras,
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

    const myChartFinalizadoras = new Chart(
      document.getElementById('chart-finalizadoras'),
      configFinalizadoras
    );
  </script>

</html>