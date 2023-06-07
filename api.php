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

// Consulta SQL para obter os dados da tabela
$sql = "SELECT pix, credito, boleto, dinheiro, debito FROM pagamento";

$result = $conn->query($sql);

// Array para armazenar os dados do gráfico
$dados = array();

// Verifica se há resultados e armazena os dados no array
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Adiciona cada tipo de pagamento como um objeto com as propriedades value e name
        $dados[] = array(
            "value" => floatval($row['pix']),
            "name" => "Pix"
        );
        $dados[] = array(
            "value" => floatval($row['credito']),
            "name" => "Credito"
        );
        $dados[] = array(
            "value" => floatval($row['boleto']),
            "name" => "Boleto"
        );
        $dados[] = array(
            "value" => floatval($row['dinheiro']),
            "name" => "Dinheiro"
        );
        $dados[] = array(
            "value" => floatval($row['debito']),
            "name" => "Debito"
        );
    }
}

// Fecha a conexão com o banco de dados
$conn->close();

// Retorna os dados como JSON
echo json_encode($dados);

// Salvar os dados em um arquivo de texto
$file = fopen('dados.txt', 'w');
fwrite($file, json_encode($dados,JSON_PRETTY_PRINT));
fclose($file);
?>
