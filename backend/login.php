<?php
header("Content-Type: application/json");

require 'db.php';
require 'session.php';

validateCSRF();

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($email) || empty($senha)) {
    echo json_encode(["status" => "error", "mensagem" => "Email e senha são obrigatórios"]);
    exit;
}

try {
    $sql = "SELECT * FROM Usuarios WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($senha, $user['senha'])){
        session_regenerate_id(true);
        setSession($user['id_usuario'], $user['tipo']);
        echo json_encode([
            "status" => "success",
            "id_usuario" => $user['id_usuario'],
            "tipo" => $user['tipo']
        ]);
    } else {
        echo json_encode(["status" => "error", "mensagem" => "Credenciais inválidas"]);
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode(["status" => "error", "mensagem" => "Erro ao processar login"]);
}
