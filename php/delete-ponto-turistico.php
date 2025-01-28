<?php
// Inclui o arquivo de conexão com o banco de dados
require_once 'db.php';
require_once 'authenticate.php';

$id = $_GET['id'];

// Prepara a instrução SQL para excluir o ponto turistico pelo ID
$stmt = $pdo->prepare("DELETE FROM pontos_turisticos WHERE id = ?");

// Executa a instrução SQL com o ID
$stmt->execute([$id]);

header('Location: index-ponto-turistico.php');
?>