<?php
header("Content-Type: application/json");

require 'db.php';
require 'session.php';

requireAuth();

$id_crianca = getUserId();
$tipo = getUserType();

if ($tipo !== 'crianca') {
    echo json_encode(["status" => "error", "mensagem" => "Acesso negado"]);
    exit;
}

try {
    $sql = "SELECT * FROM Cartas WHERE id_crianca = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_crianca]);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode(["status" => "error", "mensagem" => "Erro ao listar cartas"]);
}
