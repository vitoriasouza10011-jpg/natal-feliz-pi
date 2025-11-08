<?php
header("Content-Type: application/json");

require 'db.php';
require 'session.php';

validateCSRF();

$nome = $_POST['nome'] ?? '';
$idade = $_POST['idade'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$tipo = $_POST['tipo'] ?? '';
$endereco = $_POST['endereco'] ?? '';
$telefone = $_POST['telefone'] ?? '';

if (empty($nome) || empty($email) || empty($senha) || empty($tipo)) {
    echo json_encode(["status" => "error", "mensagem" => "Campos obrigatórios não preenchidos"]);
    exit;
}

if (!in_array($tipo, ['crianca', 'doador'])) {
    echo json_encode(["status" => "error", "mensagem" => "Tipo de usuário inválido"]);
    exit;
}

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO Usuarios (nome, idade, email, senha, tipo, endereco, telefone)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([$nome, $idade, $email, $senha_hash, $tipo, $endereco, $telefone]);
    echo json_encode(["status" => "success"]);
} catch(Exception $e) {
    error_log($e->getMessage());
    if (strpos($e->getMessage(), 'UNIQUE constraint failed') !== false) {
        echo json_encode(["status" => "error", "mensagem" => "Email já cadastrado"]);
    } else {
        echo json_encode(["status" => "error", "mensagem" => "Erro ao cadastrar usuário"]);
    }
}
