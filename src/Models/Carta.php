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
                u.nome AS crianca
            FROM cartas c
            JOIN usuarios u ON u.id_usuario = c.id_crianca
            WHERE c.status = 'aguardando'
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
            UPDATE cartas
            SET status = 'adotada'
            WHERE id_carta = :id
        ");

        return $stmt->execute([
            'id' => $idCarta
        ]);
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
}
