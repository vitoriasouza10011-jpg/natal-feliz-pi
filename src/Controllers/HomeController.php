<?php

namespace App\Controllers;

use App\Helpers\View;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class HomeController {
    public function home(Request $request, Response $response)
    {
        return View::render($response, 'home', [
            'title' => 'Natal Feliz'
        ]);
    }
}