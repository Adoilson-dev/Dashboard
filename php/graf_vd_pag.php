<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dash";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificação da conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta para obter os dados das vendas por forma de pagamento
$sql = "SELECT pix, credito, boleto, dinheiro, debito FROM pagamento";
$result = $conn->query($sql);

// Verificação do resultado da consulta
if ($result->num_rows > 0) {
    // Array para armazenar os dados
    $data = array();

    // Adiciona os dados da consulta ao array
    $row = $result->fetch_assoc();
    $data['PIX'] = $row['pix'];
    $data['Crédito'] = $row['credito'];
    $data['Boleto'] = $row['boleto'];
    $data['Dinheiro'] = $row['dinheiro'];
    $data['Débito'] = $row['debito'];

    // Criação do gráfico
    echo "<script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>";
    echo "<canvas id=\"chart\"></canvas>";
    echo "<script>";
    echo "var ctx = document.getElementById('chart').getContext('2d');";
    echo "var myChart = new Chart(ctx, {";
    echo "type: 'doughnut',";
    echo "data: {";
    echo "labels: " . json_encode(array_keys($data)) . ",";
    echo "datasets: [{";
    echo "data: " . json_encode(array_values($data)) . ",";
    echo "backgroundColor: [";
    echo "'rgba(255, 99, 132, 0.8)',";
    echo "'rgba(54, 162, 235, 0.8)',";
    echo "'rgba(255, 206, 86, 0.8)',";
    echo "'rgba(75, 192, 192, 0.8)',";
    echo "'rgba(153, 102, 255, 0.8)'";
    echo "]";
    echo "}]";
    echo "},";
    echo "options: {";
    echo "legend: {";
    echo "position: 'right',";
    echo "labels: {";
    echo "fontColor: 'black',";
    echo "fontSize: 12,";
    echo "padding: 10";
    echo "}";
    echo "}";
    echo "}";
    echo "});";
    echo "</script>";
} else {
    echo "Nenhum dado encontrado.";
}

// Fechamento da conexão com o banco de dados
$conn->close();
