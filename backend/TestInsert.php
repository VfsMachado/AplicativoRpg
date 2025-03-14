<?php
// Configuração do banco de dados
include('config.php');

// Verifique se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os dados do formulário
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];

    // Verificar se os campos não estão vazios
    if (!empty($nome) && !empty($tipo)) {
        // Preparar a consulta SQL para inserir no banco de dados
        $sql = "INSERT INTO sistemas_rpg (nome, tipo) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);

        // Executar a consulta com os valores fornecidos
        if ($stmt->execute([$nome, $tipo])) {
            echo "Sistema de RPG '$nome' inserido com sucesso!";
        } else {
            echo "Erro ao inserir o sistema de RPG.";
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Adiciona uma nova ficha
    $nome = $_POST['nome'];
    $usuario_id = 1;  // Isso deve ser obtido de uma sessão ou sistema de login.

    // Inserir ficha no banco
    $stmt = $pdo->prepare("INSERT INTO fichas (nome, usuario_id) VALUES (?, ?)");
    $stmt->execute([$nome, $usuario_id]);

    $ficha_id = $pdo->lastInsertId();  // Obter o ID da ficha recém-criada

    // Adicionar atributos personalizados
    if (isset($_POST['atributos']) && !empty($_POST['atributos'])) {
        foreach ($_POST['atributos'] as $nome_atributo => $valor) {
            $stmt = $pdo->prepare("INSERT INTO atributos_ficha (ficha_id, nome_atributo, valor) VALUES (?, ?, ?)");
            $stmt->execute([$ficha_id, $nome_atributo, $valor]);
        }
    }

    // Adicionar campos personalizados (se houver)
    if (isset($_POST['campos']) && !empty($_POST['campos'])) {
        foreach ($_POST['campos'] as $nome_campo => $valor) {
            $stmt = $pdo->prepare("INSERT INTO campos_personalizados (ficha_id, nome_campo, valor) VALUES (?, ?, ?)");
            $stmt->execute([$ficha_id, $nome_campo, $valor]);
        }
    }

    echo "Ficha criada com sucesso!";
}

}
?>

<form method="POST">
    <input type="text" name="nome" placeholder="Nome do RPG" required><br>
    <input type="text" name="tipo" placeholder="Tipo do RPG" required><br>
    
    <!-- Adicionar campos personalizados -->
    <input type="text" name="atributos[Poder Psíquico]" placeholder="Poder Psíquico" value="0"><br>
    <input type="text" name="atributos[Relação Espiritual]" placeholder="Relação Espiritual" value="0"><br>

    <button type="submit">Criar RPG e Atributos</button>
</form>
