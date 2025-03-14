<?php
$host = 'localhost';  // Endereço do servidor MySQL
$dbname = 'apprpg';  // Certifique-se de que o nome seja 'apprpg'
$username = 'root';   // Nome de usuário do MySQL
$password = '';       // Senha do MySQL

try {
    // Conexão com o banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
}
?>
