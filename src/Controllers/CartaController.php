<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Models\Carta;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CartaController
{
    private Carta $cartaModel;

    public function __construct(Carta $carta)
    {
        $this->cartaModel = $carta;
    }

    public function listar(Request $request, Response $response)
    {
        $cartas = $this->cartaModel->listarDisponiveis();

        $response->getBody()->write(json_encode($cartas));

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function criar(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $idCrianca = $_SESSION['user']['id'];

        $this->cartaModel->create(
            $idCrianca,
            $data['titulo'],
            $data['conteudo']
        );

        $response->getBody()->write("Carta criada com sucesso");

        return $response;
    }
}
