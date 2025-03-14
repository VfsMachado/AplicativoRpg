<?php
// Conexão com o banco de dados
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pega os dados do formulário
    $nome = $_POST['nome'];
    $classe = $_POST['classe'];
    $sistema_rpg_id = 1; // Aqui você pode definir qual é o sistema de RPG associado à ficha (talvez escolhido pelo usuário)
    $usuario_id = 1; // Isso pode ser obtido da sessão ou de algum sistema de login.

    // Data de criação da ficha
    $criado_em = date('Y-m-d H:i:s'); // Data atual no formato adequado

    // Inserir ficha no banco
    $stmt = $pdo->prepare("INSERT INTO fichas (nome, classe, sistema_rpg_id, usuario_id, criado_em) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nome, $classe, $sistema_rpg_id, $usuario_id, $criado_em]);

    // Obter o ID da ficha recém-criada
    $ficha_id = $pdo->lastInsertId();

    // Adicionar atributos personalizados (se houver)
    if (isset($_POST['atributos']) && !empty($_POST['atributos'])) {
        foreach ($_POST['atributos'] as $nome_atributo => $valor) {
            // Inserir no banco de dados os atributos da ficha
            $stmt = $pdo->prepare("INSERT INTO atributos_ficha (ficha_id, nome_atributo, valor) VALUES (?, ?, ?)");
            $stmt->execute([$ficha_id, $nome_atributo, $valor]);
        }
    }

    echo "Ficha criada com sucesso!";
}
?>

<!-- Formulário HTML para inserir ficha e atributos -->
<form method="POST">
    <input type="text" name="nome" placeholder="Nome do Personagem" required><br>
    <input type="text" name="classe" placeholder="Classe" required><br>

    <!-- Exemplo de como adicionar atributos personalizados -->
    <input type="text" name="atributos[Poder Psíquico]" placeholder="Poder Psíquico" value="0"><br>
    <input type="text" name="atributos[Relação Espiritual]" placeholder="Relação Espiritual" value="0"><br>

    <button type="submit">Criar Ficha</button>
</form>
