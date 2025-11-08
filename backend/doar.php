<?php
header("Content-Type: application/json");

require 'db.php';
require 'session.php';

requireAuth();
validateCSRF();

$id_doador = getUserId();
$tipo = getUserType();

if ($tipo !== 'doador') {
    echo json_encode(["status" => "error", "mensagem" => "Acesso negado"]);
    exit;
}

$id_carta = $_POST['id_carta'] ?? '';

if (empty($id_carta)) {
    echo json_encode(["status" => "error", "mensagem" => "ID da carta é obrigatório"]);
    exit;
}

try {
    $pdo->beginTransaction();

    $pdo->prepare("INSERT INTO Doacoes (id_doador, id_carta) VALUES (?,?)")
        ->execute([$id_doador, $id_carta]);

    $pdo->prepare("UPDATE Cartas SET status='adotada' WHERE id_carta=?")
        ->execute([$id_carta]);

    $pdo->commit();

    echo json_encode(["status" => "success"]);
} catch (Exception $e) {
    $pdo->rollBack();
    error_log($e->getMessage());
    echo json_encode(["status" => "error", "mensagem" => "Erro ao processar doação"]);
}
