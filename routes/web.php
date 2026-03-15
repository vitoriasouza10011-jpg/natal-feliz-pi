<?php

use App\Controllers\AuthController;
use App\Controllers\CartaController;
use App\Controllers\DoacaoController;
use Slim\App;
use App\Controllers\HomeController;

return function (App $app) {

    $app->get('/', [HomeController::class, 'home']);

    $app->get('/login', [AuthController::class, 'viewLogin']);
    $app->post(pattern: '/login',callable: [AuthController::class, 'login'] );

    $app->get('/register', [AuthController::class, 'viewRegister']);
    $app->post('/register', [AuthController::class,'register']);

    $app->get('/cartas', [CartaController::class, 'listar']);

    $app->post('/cartas', [CartaController::class, 'criar']);

    $app->post('/cartas/{id}/adotar', [DoacaoController::class, 'adotar']);


};