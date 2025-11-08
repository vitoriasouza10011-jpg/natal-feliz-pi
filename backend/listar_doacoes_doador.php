<?php
header("Content-Type: application/json");

require 'db.php';
require 'session.php';

requireAuth();

$id_doador = getUserId();
$tipo = getUserType();

if ($tipo !== 'doador') {
    echo json_encode(["status" => "error", "mensagem" => "Acesso negado"]);
    exit;
}

try {
    $sql = "SELECT Cartas.titulo, Cartas.status 
            FROM Doacoes
            JOIN Cartas ON Doacoes.id_carta = Cartas.id_carta
            WHERE Doacoes.id_doador = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_doador]);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode(["status" => "error", "mensagem" => "Erro ao listar doações"]);
}
