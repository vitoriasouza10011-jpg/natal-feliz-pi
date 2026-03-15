<?php

namespace App\Models;

use PDO;
use PDOException;

class User
{
    private PDO $db;

    private array $tiposPermitidos = ['crianca', 'doador', 'admin'];

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function create(array $data): int
    {

        if (!in_array($data['tipo'], $this->tiposPermitidos)) {
            throw new \InvalidArgumentException("Tipo de usuário inválido");
        }

        if ($this->findByEmail($data['email'])) {
            throw new \Exception("Email já cadastrado");
        }

        try {

            $stmt = $this->db->prepare("
                INSERT INTO usuarios
                (
                    nome,
                    idade,
                    email,
                    senha,
                    tipo,
                    endereco,
                    telefone
                )
                VALUES
                (
                    :nome,
                    :idade,
                    :email,
                    :senha,
                    :tipo,
                    :endereco,
                    :telefone
                )
            ");

            $stmt->execute([
                'nome' => $data['nome'],
                'idade' => $data['idade'] ?? null,
                'email' => $data['email'],
                'senha' => password_hash($data['senha'], PASSWORD_DEFAULT),
                'tipo' => $data['tipo'],
                'endereco' => $data['endereco'] ?? null,
                'telefone' => $data['telefone'] ?? null
            ]);

            return (int) $this->db->lastInsertId();

        } catch (PDOException $e) {

            throw new \Exception("Erro ao criar usuário: " . $e->getMessage());
        }
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM usuarios
            WHERE email = :email
        ");

        $stmt->execute([
            'email' => $email
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }
}
