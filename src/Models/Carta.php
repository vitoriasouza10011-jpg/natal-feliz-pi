<?php

namespace App\Models;

use PDO;

class Carta
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function create($idCrianca, $titulo, $conteudo)
    {
        $stmt = $this->db->prepare("
            INSERT INTO cartas (id_crianca, titulo, conteudo, status)
            VALUES (:id_crianca, :titulo, :conteudo, 'aguardando')
        ");

        return $stmt->execute([
            'id_crianca' => $idCrianca,
            'titulo' => $titulo,
            'conteudo' => $conteudo
        ]);
    }

    public function listarDisponiveis()
    {
        $stmt = $this->db->query("
        SELECT 
            c.id_carta,
            c.titulo,
            c.conteudo,
            c.status,
            u.nome AS crianca,
            c.created_at 
        FROM cartas c
        JOIN usuarios u ON u.id_usuario = c.id_crianca
        WHERE c.status = 'aguardando'
		ORDER BY c.created_at DeSC
    ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findAll(): array
    {
        $stmt = $this->db->query("
        SELECT 
            c.id_carta,
            c.titulo,
            c.conteudo,
            c.status,
            u.nome AS crianca
        FROM cartas c
        JOIN usuarios u ON u.id_usuario = c.id_crianca
    ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function find($id)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM cartas
            WHERE id_carta = :id
        ");

        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function marcarAdotada($idCarta)
    {
        $stmt = $this->db->prepare("
        UPDATE cartas SET status = 'adotada'
        WHERE id = :id
    ");

        return $stmt->execute(['id' => $idCarta]);
    }

    public function marcarEntregue($idCarta)
    {
        $stmt = $this->db->prepare("
            UPDATE cartas
            SET status = 'entregue'
            WHERE id_carta = :id
        ");

        return $stmt->execute([
            'id' => $idCarta
        ]);
    }

    public function findByUsuario($idUsuario)
    {
        $stmt = $this->db->prepare("
        SELECT 
            c.id_carta,
            c.titulo,
            c.conteudo,
            c.status,
            u.nome AS crianca
        FROM cartas c
        JOIN usuarios u ON u.id_usuario = c.id_crianca
        WHERE c.id_crianca = :id
    ");

        $stmt->execute(['id' => $idUsuario]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorCrianca($idCrianca)
    {
        $stmt = $this->db->prepare("
        SELECT id_carta, titulo, conteudo, status, created_at
        FROM cartas
        WHERE id_crianca = :id_crianca
        LIMIT 1
    ");

        $stmt->execute([
            'id_crianca' => $idCrianca
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarStatus($idCarta, $status)
    {
        $validos = ['aguardando', 'adotada', 'entregue', 'agradecida'];

        if (!in_array($status, $validos)) {
            throw new \Exception("Status inválido");
        }

        $stmt = $this->db->prepare("
        UPDATE cartas 
        SET status = :status
        WHERE id_carta = :id
    ");

        return $stmt->execute([
            'status' => $status,
            'id' => $idCarta
        ]);
    }
    public function salvarAgradecimento($idCarta, $mensagem)
    {
        $stmt = $this->db->prepare("
            UPDATE cartas 
            SET mensagem_agradecimento = :mensagem
            WHERE id_carta = :id
        ");

        return $stmt->execute([
            'mensagem' => $mensagem,
            'id' => $idCarta
        ]);
    }
}
