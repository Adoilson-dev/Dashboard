<?php
// Conexão com o banco de dados (substitua as informações de conexão com as suas)
$host = '127.0.0.1';
$dbName = 'sistemasit';
$username = 'root';
$password = '123456';

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Consulta SQL para obter os dados do banco de dados
  $sql = "SELECT padocum, pavalor FROM sfepaav";
  $stmt = $conn->query($sql);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Preparar os dados para o formato esperado pelo gráfico
  $labels = [];
  $values = [];

  foreach ($result as $row) {
    $labels[] = $row['padocum'];
    $values[] = (int)$row['pavalor'];
  }

  // Montar o array com os dados para retornar no formato JSON
  $data = [
    'labels' => $labels,
    'data' => $values
  ];

  // Retornar os dados no formato JSON
  header('Content-Type: application/json');
  echo json_encode($data);
} catch (PDOException $e) {
  echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
}
?>
