<?php
// Inclui o arquivo de conexão com o banco de dados
require_once 'db.php';
require_once 'authenticate.php';

// Obtém o ID do ponto turistico a partir da URL usando o método GET
$id = $_GET['id'];

// Prepara a instrução SQL para selecionar o ponto turistico pelo ID
$stmt = $pdo->prepare("SELECT * FROM pontos_turisticos WHERE id = ?");

// Executa a instrução SQL, passando o ID do ponto turistico como parâmetro
$stmt->execute([$id]);

// Recupera os dados do ponto turistico como um array associativo
$pontoTuristico = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se o formulário foi submetido através do método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados enviados pelo formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    // Prepara a instrução SQL para atualizar os dados do ponto turistico
    $stmt = $pdo->prepare("UPDATE pontos_turisticos SET nome = ?, descricao = ? WHERE id = ?");

    // Executa a instrução SQL com os novos dados do formulário
    $stmt->execute([$nome, $descricao, $id]);

    // Redireciona para a página de listagem de ponto turistico
    header('Location: index-ponto-turistico.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ponto Turistico</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="container">
    <header class="cabecalho">
        <img class="logo" src="/assets/image 10.png" alt="">
        <nav class="navegacao">
            <ul class="navegacao-itens">
                <li><a href="/index.php" class="nav-links">Home</a></li>
                <li><a href="index-ponto-turistico.php" class="nav-links">Listar Pontos Turisticos</a></li>
                <li><a href="create-ponto-turistico.php" class="nav-links">Adicionar Pontos Turisticos</a></li>
            </ul>
        </nav>
    </header>

    <main class="conteudo">
        <section class="area-form">
            <h1>Editar Ponto Turistico</h1>
            <!-- Formulário para editar os dados do ponto turistico -->
            <form method="POST" class="form">

                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?= $pontoTuristico['nome'] ?>" required>

                <label for="descricao">Descirção:</label>
                <input type="text" id="descricao" name="descricao" value="<?= $pontoTuristico['descricao'] ?>" required>

                <button type="submit">Atualizar</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 - Descubra Mais</p>
    </footer>
</body>

</html>