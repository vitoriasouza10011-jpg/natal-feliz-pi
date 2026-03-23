<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Models\Carta;
use App\Models\Doacao;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CartaController
{
    private Carta $cartaModel;
    private Doacao $doacaoModel;

    public function __construct(PDO $db,Carta $cartaModel, Doacao $doacaoModel)
    {
        $this->cartaModel = $cartaModel;
        $this->doacaoModel = $doacaoModel;
    }

    public function listar(Request $request, Response $response)
    {
        if (!isset($_SESSION['user'])) {
            return $response->withStatus(401);
        }

        // outros tipos veem todas
        $cartas = $this->cartaModel->listarDisponiveis();

        $response->getBody()->write(json_encode($cartas));

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function criar(Request $request, Response $response)
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['tipo'] !== 'crianca') {
            return $response->withStatus(403);
        }

        $idCrianca = $_SESSION['user']['id'];

        // 🔒 Verifica se já tem carta
        $cartaExistente = $this->cartaModel->buscarPorCrianca($idCrianca);

        if ($cartaExistente) {
            return $response
                ->withHeader('Location', '/minha-carta')
                ->withStatus(302);
        }

        $data = $request->getParsedBody();

        $this->cartaModel->create(
            $idCrianca,
            $data['titulo'],
            $data['conteudo']
        );

        // ✅ Redireciona corretamente
        return $response
            ->withHeader('Location', '/minha-carta')
            ->withStatus(302);
    }

    public function minhaCarta(Request $request, Response $response)
    {
        if (!isset($_SESSION['user'])) {
            return $response
                ->withHeader('Location', '/login')
                ->withStatus(302);
        }

        if ($_SESSION['user']['tipo'] !== 'crianca') {
            return $response->withStatus(403);
        }

        $userId = $_SESSION['user']['id'];

        $carta = $this->cartaModel->buscarPorCrianca($userId);

        // 📭 Não tem carta → manda criar
        if (!$carta) {
            return $response
                ->withHeader('Location', '/criar-carta')
                ->withStatus(302);
        }

        // 📬 Tem carta → mostra
        return View::render($response, 'cartas/minha-carta', [
            'carta' => $carta
        ]);
    }
    public function cartasView(Request $request, Response $response)
    {

        return View::render($response, 'cartas/listar');

    }

    public function cartaCriarView(Request $request, Response $response)
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['tipo'] !== 'crianca') {
            return $response->withStatus(403);
        }

        $userId = $_SESSION['user']['id'];

        $carta = $this->cartaModel->buscarPorCrianca($userId);

        // 🔒 Já tem carta → bloqueia acesso
        if ($carta) {
            return $response
                ->withHeader('Location', '/minha-carta')
                ->withStatus(302);
        }

        return View::render($response, 'cartas/criar');
    }

    public function confirmarEntrega(Request $request, Response $response, $args)
    {
        if (!isset($_SESSION['user'])) {
            return $response->withStatus(401);
        }

        // 🔒 Apenas criança/responsável
        if ($_SESSION['user']['tipo'] !== 'crianca') {
            return $response->withStatus(403);
        }

        $userId = $_SESSION['user']['id'];
        $idCarta = $args['id'];

        // 🔍 Verifica se a carta pertence à criança
        $carta = $this->cartaModel->buscarPorCrianca($userId);

        if (!$carta || $carta['id_carta'] != $idCarta) {
            return $response->withStatus(403);
        }

        // ❌ Só pode confirmar se já foi adotada
        if ($carta['status'] !== 'adotada') {
            $response->getBody()->write("A carta ainda não foi adotada.");
            return $response->withStatus(400);
        }

        // ✅ Atualiza status
        $this->cartaModel->atualizarStatus($idCarta, 'entregue');

        // (opcional) marcar na doação também
        $this->doacaoModel->confirmarEntrega($idCarta);

        return $response
            ->withHeader('Location', '/minha-carta')
            ->withStatus(302);
    }

    public function agradecer(Request $request, Response $response, $args)
    {
        if (!isset($_SESSION['user'])) {
            return $response->withStatus(401);
        }

        if ($_SESSION['user']['tipo'] !== 'crianca') {
            return $response->withStatus(403);
        }

        $userId = $_SESSION['user']['id'];
        $idCarta = $args['id'];
        $data = $request->getParsedBody();

        $carta = $this->cartaModel->buscarPorCrianca($userId);

        if (!$carta || $carta['id_carta'] != $idCarta) {
            return $response->withStatus(403);
        }

        // ❌ Só após entrega
        if ($carta['status'] !== 'entregue') {
            $response->getBody()->write("Confirme a entrega antes de agradecer.");
            return $response->withStatus(400);
        }

        $this->cartaModel->salvarAgradecimento($idCarta, $data['mensagem']);
        $this->cartaModel->atualizarStatus($idCarta, 'agradecida');

        return $response
            ->withHeader('Location', '/minha-carta')
            ->withStatus(302);
    }

}
