<?php

use App\Controllers\AuthController;
use App\Controllers\CartaController;
use App\Controllers\DoacaoController;
use App\Middleware\AuthMiddleware;
use Slim\App;
use App\Controllers\HomeController;

return function (App $app) {
    $app->get('/.well-known/{path:.*}', function ($request, $response) {
        return $response->withStatus(204);
    });

    $app->get('/', [HomeController::class, 'home']);

    $app->get('/login', [AuthController::class, 'viewLogin']);
    $app->post(pattern: '/login', callable: [AuthController::class, 'login']);

    $app->get('/register', [AuthController::class, 'viewRegister']);
    $app->post('/register', [AuthController::class, 'register']);


    $app->group('', function ($group) {



        $group->get('/cartas', [CartaController::class, 'listar']);

        $group->post('/cartas', [CartaController::class, 'criar']);

        $group->post('/cartas/{id}/adotar', [DoacaoController::class, 'adotar']);
        $group->post('/cartas/{id}/entregar', [CartaController::class, 'confirmarEntrega']);
        $group->post('/cartas/{id}/agradecer', [CartaController::class, 'agradecer']);

        $group->get('/criar-carta', [CartaController::class, 'cartaCriarView']);

        $group->get('/cartas-view', [CartaController::class, 'cartasView']);
        $group->get('/minha-carta', [CartaController::class, 'minhaCarta']);

    })->add(AuthMiddleware::class);


};