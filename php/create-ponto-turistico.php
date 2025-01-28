<?php
// Inclui o arquivo de conexão com o banco de dados
require_once 'db.php';
require_once 'authenticate.php';

// Verifica se o formulário foi submetido através do método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados enviados pelo formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    $stmt = $pdo->prepare("INSERT INTO pontos_turisticos (nome, descricao) VALUES (?, ?)");
    // Executa a instrução SQL com os dados do formulário
    $stmt->execute([$nome, $descricao]);

    // Redireciona para a página de listagem de pontos turisticos
    header('Location: index-ponto-turistico.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Ponto Turistico</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="container">
    <header class="cabecalho">
        <img class="logo" src="/assets/image 10.png" alt="">
        <nav class="navegacao">
            <ul class="navegacao-itens">
                <li><a href="/index.php" class="nav-links">Home</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="/php/index-ponto-turistico.php" class="nav-links">Listar Pontos Turisticos</a></li>
                    <li><a href="/php/create-ponto-turistico.php" class="nav-links">Adicionar Pontos Turisticos</a></li>
                    <li><a href="/php/logout.php" class="nav-links">Logout (<?= $_SESSION['username'] ?>)</a></li>
                <?php else: ?>
                    <li><a href="/php/user-login.php" class="nav-links">Login</a></li>
                    <li><a href="/php/user-register.php" class="nav-links">Registrar</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main class="conteudo">
        <section class="area-form">
            <h1>Adicionar Ponto Turistico</h1>
            <!-- Formulário para adicionar um novo Ponto Turistico-->
            <form method="POST" class="form">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="descricao">Descrição:</label>
                <input type="text" id="descricao" name="descricao" required>

                <button type="submit">Adicionar</button>
            </form>
        </section>
    </main>

    <footer>
        <<p>&copy; 2025 - Descubra Mais</p>
    </footer>
</body>

</html>