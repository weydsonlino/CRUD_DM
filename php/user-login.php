<?php
require_once 'db.php';
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o email de usuário existe
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se a senha está correta
    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['nome'];
        header('Location: /index.php');
    } else {
        echo "Nome de usuário ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                    <li><a href="/php/user-register.php" class="nav-links">Registrar</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main class="conteudo">
        <section class="area-form">
            <h1>Login</h1>
            <form method="POST" class="form">
                <label for="email">E-mail do Usuário:</label>
                <input type="email" id="email" name="email" required>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
                <button type="submit">Login</button>
            </form>
            <p>Não tenho uma conta, <a href="user-register.php">Registrar</a>.</p>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 - Descubra Mais</p>
    </footer>
</body>

</html>