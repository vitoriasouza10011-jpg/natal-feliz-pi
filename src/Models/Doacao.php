<?php

namespace App\Models;

use PDO;

class Doacao
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // ✅ Marcar entrega
    public function confirmarEntrega($idCarta)
    {
        $stmt = $this->db->prepare("
            UPDATE doacoes 
            SET entregue = 1
            WHERE id_carta = :id_carta
        ");

        return $stmt->execute([
            'id_carta' => $idCarta
        ]);
    }
}