<?php

// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dash";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];

// Verifica se as datas foram recebidas como parâmetros GET
if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
    // Obtém as datas dos parâmetros GET
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];

    // Consulta SQL para obter os dados da tabela usando placeholders
    $sql = "SELECT pix, credito, boleto, dinheiro, debito FROM pagamento WHERE data >= ? AND data <= ?";
    
    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);
    
    // Vincula os valores dos parâmetros às posições dos placeholders
    $stmt->bind_param("ss", $startDate, $endDate);
    
    // Executa a consulta
    $stmt->execute();
    
    // Obtém o resultado da consulta
    $result = $stmt->get_result();
} else {
    // Caso as datas não sejam fornecidas, retorne um erro ou faça alguma outra ação
    die("Datas não fornecidas.");
}

// Array para armazenar os dados do gráfico
$dados = array(
    array(
        "value" => 0,
        "name" => "Pix"
    ),
    array(
        "value" => 0,
        "name" => "Credito"
    ),
    array(
        "value" => 0,
        "name" => "Boleto"
    ),
    array(
        "value" => 0,
        "name" => "Dinheiro"
    ),
    array(
        "value" => 0,
        "name" => "Debito"
    )
);

// Verifica se há resultados e armazena os dados no array
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Soma os valores para cada tipo de pagamento
        $dados[0]["value"] += floatval($row['pix']);
        $dados[1]["value"] += floatval($row['credito']);
        $dados[2]["value"] += floatval($row['boleto']);
        $dados[3]["value"] += floatval($row['dinheiro']);
        $dados[4]["value"] += floatval($row['debito']);
    }
} else {
    // Caso não haja resultados, retorne um erro ou faça alguma outra ação
    die("Nenhum dado encontrado.");
}

// Fecha a conexão com o banco de dados
$conn->close();

// Retorna os dados como JSON
$jsonData = json_encode($dados);

// Salvar os dados em um arquivo de texto
$file = fopen('dados.txt', 'w');
if ($file) {
    fwrite($file, $jsonData);
    fclose($file);
    echo "Arquivo atualizado com sucesso.";
} else {
    echo "Erro ao abrir o arquivo para escrita.";
}

?>
