<?php
$host = 'localhost';
$dbname = 'apprpg'; // O nome do seu banco de dados
$user = 'root'; // Seu usuário do MySQL
$pass = ''; // Sua senha do MySQL (deixe em branco se não houver)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}
?>
