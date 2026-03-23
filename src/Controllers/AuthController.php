<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Models\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthController
{
    private User $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function viewLogin(Request $request, Response $response)
    {
        return View::render($response, 'login');
    }

    public function viewRegister(Request $request, Response $response)
    {
        return View::render($response, 'register');
    }

    public function login(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        if (!isset($data['email']) || !isset($data['senha'])) {

            $response->getBody()->write(json_encode([
                'error' => 'Email e senha são obrigatórios'
            ]));

            return $response
                ->withStatus(400)
                ->withHeader('Content-Type', 'application/json');
        }

        $user = $this->userModel->findByEmail($data['email']);
    
        if (!$user || !password_verify($data['senha'], $user['senha'])) {
            $response->getBody()->write("Email ou senha inválidos");
            return $response->withStatus(401);
        }

        $_SESSION['user'] = [
            'id' => $user['id_usuario'],
            'nome' => $user['nome'],
            'tipo' => $user['tipo']
        ];

        // 🔥 REDIRECIONAMENTO POR TIPO
        if ($user['tipo'] === 'crianca') {
            $rota = '/criar-carta'; // criar/visualizar própria carta
        } else {
            $rota = '/cartas-view'; // listar cartas para doação
        }

        return $response
            ->withHeader('Location', $rota)
            ->withStatus(302);
    }

    public function register(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        try {

            // 🔒 Validação básica
            if (
                empty($data['nome']) ||
                empty($data['email']) ||
                empty($data['senha']) ||
                empty($data['tipo'])
            ) {
                throw new \Exception("Preencha todos os campos obrigatórios.");
            }

            
            // 💾 Cria usuário
            $id = $this->userModel->create([
                'nome' => $data['nome'],
                'idade' => $data['idade'] ?? null,
                'email' => $data['email'],
                'senha' => $data['senha'],
                'tipo' => $data['tipo'],
                'telefone' => $data['telefone'] ?? null,
                'endereco' => $data['endereco'] ?? null
            ]);
            // 🔥 CRIA SESSÃO (auto login)
            $_SESSION['user'] = [
                'id' => $id,
                'nome' => $data['nome'],
                'tipo' => $data['tipo']
            ];
            // 🔁 Redirecionamento por tipo
            if ($data['tipo'] === 'crianca') {
                $rota = '/criar-carta';
            } else {
                $rota = '/cartas-view';
            }

            return $response
                ->withHeader('Location', $rota)
                ->withStatus(302);

        } catch (\Exception $e) {

            $response->getBody()->write(json_encode([
                'error' => $e->getMessage()
            ]));

            return $response
                ->withStatus(400)
                ->withHeader('Content-Type', 'application/json');
        }
    }
}
