<?php

namespace App\Helpers;

use Psr\Http\Message\ResponseInterface as Response;

class View
{
    /**
     * Summary of render
     * @param Response $response
     * @param string $view
     * @param array $data
     * @return Response
     */
    public static function render(Response $response, string $view, array $data = [])
    {
        extract($data);

        ob_start();
        require __DIR__ . "/../View/$view.php";
        $content = ob_get_clean();

        $response->getBody()->write($content);

        return $response;
    }
}