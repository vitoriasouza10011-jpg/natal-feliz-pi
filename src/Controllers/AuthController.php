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

        $response->getBody()->write("Login realizado com sucesso");

        return $response;
    }

    public function register(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        try {

            $id = $this->userModel->create([
                'nome' => $data['nome'],
                'idade' => $data['idade'] ?? null,
                'email' => $data['email'],
                'senha' => $data['senha'],
                'tipo' => $data['tipo'],
                'telefone' => $data['telefone'] ?? null,
                'endereco' => $data['endereco'] ?? null
            ]);

            $response->getBody()->write("Usuário criado com ID: " . $id);

            return $response->withStatus(201);

        } catch (\Exception $e) {

            $response->getBody()->write($e->getMessage());

            return $response->withStatus(400);
        }
    }
}
