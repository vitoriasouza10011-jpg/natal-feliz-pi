<?php

namespace App\Controllers;

use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DoacaoController
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function adotar(Request $request, Response $response, $args)
    {

        $idCarta = $args['id'];
        $idDoador = $_SESSION['user']['id'];

        $this->db->beginTransaction();

        $stmt = $this->db->prepare("
            SELECT status
            FROM cartas
            WHERE id_carta = ?
        ");

        $stmt->execute([$idCarta]);

        $carta = $stmt->fetch();

        if (!$carta || $carta['status'] !== 'aguardando') {

            $response->getBody()->write("Carta já adotada");

            return $response->withStatus(400);
        }

        $stmt = $this->db->prepare("
            INSERT INTO doacoes (id_doador, id_carta)
            VALUES (?, ?)
        ");

        $stmt->execute([$idDoador, $idCarta]);

        $stmt = $this->db->prepare("
            UPDATE cartas
            SET status = 'adotada'
            WHERE id_carta = ?
        ");

        $stmt->execute([$idCarta]);

        $this->db->commit();

        $response->getBody()->write("Carta adotada com sucesso");

        return $response;
    }
}
