<?php

use App\Controllers\AuthController;
use Slim\App;
use App\Controllers\HomeController;

return function (App $app) {

    $app->get('/', [HomeController::class, 'home']);
    $app->get('/login', [AuthController::class, 'viewLogin']);
    $app->get('/register', [AuthController::class, 'viewRegister']);

    $app->post('/auth/login', [AuthController::class,'login']);
    $app->post('/auth/register', [AuthController::class,'register']);

};