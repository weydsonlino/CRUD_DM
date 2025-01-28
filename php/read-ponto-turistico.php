<?php
// Inclui o arquivo de conexão com o banco de dados
require_once 'db.php';
require_once 'authenticate.php';

// Obtém o ID do ponto turisitco a partir da URL usando o método GET
$id = $_GET['id'];

// Prepara a instrução SQL para selecionar o ponto turisitco pelo ID
$stmt = $pdo->prepare("SELECT * FROM pontos_turisticos WHERE id = ?");
// Executa a instrução SQL, passando o ID do ponto turisitco como parâmetro
$stmt->execute([$id]);

// Recupera os dados do ponto turisitco como um array associativo
$pontoTuristico = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Ponto turistico</title>
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
        <section class="area-card">
            <h1>Detalhes do Ponto Turistico</h1>
            <?php if ($pontoTuristico): ?>
                <div class="card">
                    <p class="card-itens"><strong>ID:</strong> <?= $pontoTuristico['id'] ?></p>
                    <p class="card-itens"><strong>Nome:</strong> <?= $pontoTuristico['nome'] ?></p>
                    <p class="card-itens"><strong>Descrição:</strong> <?= $pontoTuristico['descricao'] ?></p>
                    <div class="card-links">
                        <a href="index-ponto-turistico.php">voltar</a>
                        <a href="update-ponto-turistico.php?id=<?= $pontoTuristico['id'] ?>">Editar</a>
                        <a href="delete-ponto-turistico.php?id=<?= $pontoTuristico['id'] ?>">Excluir</a>
                    </div>
                </div>
            <?php else: ?>
                <!-- Exibe uma mensagem caso o aluno não seja encontrado -->
                <p>Ponto Turistico não encontrado.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 - Descubra Mais</p>
    </footer>
</body>

</html>