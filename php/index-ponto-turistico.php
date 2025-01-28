<?php
// Inclui o arquivo de conexão com o banco de dados

require_once 'db.php';
require_once 'authenticate.php';
// Executa a consulta para obter todos os pontos turisticos
$stmt = $pdo->query("SELECT * FROM pontos_turisticos");
// Recupera todos os resultados da consulta como um array associativo
$pontosTuristicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descubra Mais</title>
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
        <section id="listagem">
            <h1>Lista de Pontos Turisticos</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>DESCRIÇÃO</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pontosTuristicos as $pontoTuristico): ?>
                        <tr>
                            <td><?= $pontoTuristico['id'] ?></td>
                            <td><?= $pontoTuristico['nome'] ?></td>
                            <td><?= $pontoTuristico['descricao'] ?></td>
                            <td>
                                <a href="read-ponto-turistico.php?id=<?= $pontoTuristico['id'] ?>">Visualizar</a>
                                <a href="update-ponto-turistico.php?id=<?= $pontoTuristico['id'] ?>">Editar</a>
                                <a href="delete-ponto-turistico.php?id=<?= $pontoTuristico['id'] ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 - Descubra Mais</p>
    </footer>
</body>

</html>