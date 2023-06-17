<?php
// Configurações de conexão com o banco de dados MySQL
$host = '127.0.0.1';
$dbname = 'sistemasit';
$username = 'root';
$password = '123456';

try {
  // Conexão com o banco de dados usando PDO
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
  
  // Consulta para obter o nome do vendedor e o valor vendido por ele
  $query = "SELECT v.venome, s.pavalor FROM sfepaav s INNER JOIN sgevend v ON s.pavend = v.vecodi";
  $stmt = $pdo->query($query);
  
  // Obter os valores retornados da consulta
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  // Criar arrays para armazenar as labels e os dados
  $labels = array();
  $dataValues = array();
  
  // Extrair os valores do nome do vendedor e do valor vendido
  foreach ($data as $row) {
    $labels[] = $row['venome'];
    $dataValues[] = $row['pavalor'];
  }
  
  // Montar o objeto JSON com as propriedades necessárias para o gráfico
  $chartData = array(
    'labels' => $labels,
    'datasets' => array(
      array(
        'data' => $dataValues
      )
    )
  );
  
  // Responder com os dados em formato JSON
  header('Content-Type: application/json');
  echo json_encode($chartData);
} catch (PDOException $e) {
  // Em caso de erro na conexão com o banco de dados
  echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
}
?>
