<?php
require_once 'db.php';

session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senhaHASH = password_hash($_POST['senha'], PASSWORD_BCRYPT); // Criptografa a senha

    // Verifica se o email de usuário já existe
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        echo "Nome de usuário já existe!";
    } else {
        // Insere o novo usuário no banco de dados
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, cpf, email, senha ) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$nome, $cpf, $email, $senhaHASH])) {
            echo "Usuário registrado com sucesso!";
            header('Location: user-login.php');
        } else {
            echo "Erro ao registrar usuário.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuário</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

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
                    <?php endif; ?>
                </ul>
            </nav>
        </header>
        <main class="conteudo">
            <section class="area-form">
                <h1>Faça seu Registro</h1>
                <form method="POST" class="form">
                    <label for="nome">Nome:</label>
                    <!-- Campo para inserir o nome do aluno -->
                    <input type="text" id="nome" name="nome" required>

                    <label for="cpf">CPF:</label>
                    <!-- Campo para inserir o cpf do usuario -->
                    <input type="text" id="cpf" name="cpf" required>

                    <label for="email">E-mail:</label>
                    <!-- Campo para inserir o e-mail do aluno -->
                    <input type="email" id="email" name="email" required>

                    <label for="senha">Senha:</label>
                    <!-- Campo para inserir a senha do usuario -->
                    <input type="password" id="senha" name="senha" required>

                    <!-- Botão para submeter o formulário -->
                    <button type="submit">Registrar</button>
                </form>
                <p>Já tenho uma conta, <a href="user-login.php">Login</a>.</p>
            </section>
        </main>
        <footer>
            <p>&copy; 2025 - Descubra Mais</p>
        </footer>
    </body>

</html>