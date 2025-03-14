<?php
require 'config.php';  // Conecta ao banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];

    // Inserir o sistema de RPG
    $stmt = $pdo->prepare("INSERT INTO sistemas_rpg (nome, tipo) VALUES (?, ?)");
    $stmt->execute([$nome, $tipo]);

    $sistema_rpg_id = $pdo->lastInsertId();  // Obter o ID do sistema de RPG recém-criado

    // Inserir atributos para esse sistema
    if (isset($_POST['atributos'])) {
        foreach ($_POST['atributos'] as $atributo) {
            $stmt = $pdo->prepare("INSERT INTO fichas (sistema_rpg_id, nome_atributo, tipo, obrigatorio) VALUES (?, ?, ?, ?)");
            $stmt->execute([$sistema_rpg_id, $atributo, "número", 1]); // Aqui, "número" pode ser alterado dependendo do tipo do atributo
        }
    }

    echo "Sistema de RPG e atributos criados com sucesso!";
}
?>

<form method="POST">
    <input type="text" name="nome" placeholder="Nome do RPG" required><br>
    <input type="text" name="tipo" placeholder="Tipo do RPG" required><br>

    <!-- Campos para definir os atributos do sistema -->
    <input type="text" name="atributos[]" placeholder="Atributo 1" required><br>
    <input type="text" name="atributos[]" placeholder="Atributo 2" required><br>
    <input type="text" name="atributos[]" placeholder="Atributo 3" required><br>
    <input type="text" name="atributos[]" placeholder="Atributo 4" required><br>
    <input type="text" name="atributos[]" placeholder="Atributo 5" required><br>

    <button type="submit">Criar Sistema de RPG</button>
</form>
