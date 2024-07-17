<?php
$servername = "82.112.244.172";  // ou o endereço do seu servidor MySQL
$username = "myuser";         // o nome de usuário do seu MySQL
$password = "mypassword"; // a senha do usuário
$dbname = "mydatabase"; // o nome do banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// echo "Conexão bem-sucedida";
?>
