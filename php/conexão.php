<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "consulta";
$port = 3306;

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=". $dbname,$user,$pass);

    echo "Conexão Com o banco de dados realizado com sucesso."
} catch (PDOException $err){
    echo "Erro: Não foi possivel realizar conexão com o banco de dados. Erro gerado" . $err->getMessage();
}
