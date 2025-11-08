<?php
header("Content-Type: application/json");

require 'db.php';
require 'session.php';

requireAuth();
validateCSRF();

$id_crianca = getUserId();
$tipo = getUserType();

if ($tipo !== 'crianca') {
    echo json_encode(["status" => "error", "mensagem" => "Acesso negado"]);
    exit;
}

$titulo = $_POST['titulo'] ?? '';
$conteudo = $_POST['conteudo'] ?? '';

if (empty($titulo) || empty($conteudo)) {
    echo json_encode(["status" => "error", "mensagem" => "Título e conteúdo são obrigatórios"]);
    exit;
}

try {
    $sql = "INSERT INTO Cartas (id_crianca, titulo, conteudo) VALUES (?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_crianca, $titulo, $conteudo]);
    echo json_encode(["status" => "success"]);
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode(["status" => "error", "mensagem" => "Erro ao cadastrar carta"]);
}
