<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descubra Mais</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
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
        <section id="home">
            <h1>Bem-vindo ao Descubra Mais</h1>
            <p>Utilize o menu para navegar pela plataforma.</p>
        </section>

    </main>

    <footer>
        <p>&copy; 2025 - Descubra Mais</p>
    </footer>
</body>

</html>