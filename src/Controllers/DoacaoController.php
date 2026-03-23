<?php

namespace App\Controllers;

use App\Models\Carta;
use App\Models\Doacao;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DoacaoController
{
    private PDO $db;
    private Carta $cartaModel;
    private Doacao $doacaoModel;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->cartaModel = new Carta($db);
        $this->doacaoModel = new Doacao($db);
    }
    public function adotar(Request $request, Response $response, $args)
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['tipo'] !== 'doador') {
            return $response->withStatus(403);
        }

        $idCarta = $args['id'];
        $idDoador = $_SESSION['user']['id'];

        try {

            $this->db->beginTransaction();

            // 🔍 Verifica status
            $stmt = $this->db->prepare("
            SELECT status
            FROM cartas
            WHERE id_carta = ?
        ");

            $stmt->execute([$idCarta]);
            $carta = $stmt->fetch();

            if (!$carta || $carta['status'] !== 'aguardando') {
                $this->db->rollBack();

                return $response
                    ->withHeader('Location', '/cartas-view?erro=ja_adotada')
                    ->withStatus(302);
            }

            // 💾 Inserir doação
            $stmt = $this->db->prepare("
            INSERT INTO doacoes (id_doador, id_carta)
            VALUES (?, ?)
        ");

            $stmt->execute([$idDoador, $idCarta]);

            // 🔄 Atualizar status
            $stmt = $this->db->prepare("
            UPDATE cartas
            SET status = 'adotada'
            WHERE id_carta = ?
        ");
            $stmt->execute([$idCarta]);

            $this->db->commit();

            // 🎉 Sucesso
            return $response
                ->withHeader('Location', '/cartas-view?sucesso=adotada')
                ->withStatus(302);

        } catch (\Exception $e) {
            $this->db->rollBack();

            return $response
                ->withHeader('Location', '/cartas-view?erro=falha')
                ->withStatus(302);
        }
    }

}

