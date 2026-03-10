<?php

namespace App\Models;

use PDO;

class User
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function create($nome, $email, $senha, $tipo)
    {
        $stmt = $this->db->prepare("
            INSERT INTO usuarios (nome,email,senha,tipo)
            VALUES (:nome,:email,:senha,:tipo)
        ");

        return $stmt->execute([
            'nome' => $nome,
            'email' => $email,
            'senha' => password_hash($senha, PASSWORD_DEFAULT),
            'tipo' => $tipo
        ]);
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM usuarios
            WHERE email = :email
        ");

        $stmt->execute([
            'email' => $email
        ]);

        return $stmt->fetch();
    }
}