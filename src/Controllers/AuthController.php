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

    public function viewLogin(Request $request, Response $response){
        return View::render($response,'login');
    }

    public function viewRegister(Request $request, Response $response){
        return View::render($response,'register');
    }


    public function login(Request $request, Response $response)
    {

        dd('TA ERRADO MANO');

        $data = $request->getParsedBody();

        $user = $this->userModel->findByEmail($data['email']);

        if (!$user || !password_verify($data['senha'], $user['senha'])) {
            $response->getBody()->write("Login inválido");
            return $response;
        }

        $_SESSION['user'] = $user['id'];

        $response->getBody()->write("Login realizado");

        return $response;
    }

    public function register(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        dd($data);
        $this->userModel->create(
            $data['nome'],
            $data['email'],
            $data['senha'],
            $data['tipo']
        );

        $response->getBody()->write("Usuário criado");

        return $response;
    }
}