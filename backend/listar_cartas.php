<?php
header("Content-Type: application/json");

require 'db.php';

try {
    $sql = "SELECT Cartas.id_carta, Cartas.titulo, Cartas.conteudo, Usuarios.nome AS crianca
            FROM Cartas
            JOIN Usuarios ON Usuarios.id_usuario = Cartas.id_crianca
            WHERE Cartas.status = 'aguardando'";

    $stmt = $pdo->query($sql);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode(["status" => "error", "mensagem" => "Erro ao listar cartas"]);
}
