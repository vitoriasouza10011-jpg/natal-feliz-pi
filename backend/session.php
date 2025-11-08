<?php
ini_set('session.cookie_samesite', 'Strict');
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_secure', '0');
session_start();

function requireAuth() {
    if (!isset($_SESSION['id_usuario'])) {
        http_response_code(401);
        echo json_encode(["status" => "error", "mensagem" => "Não autenticado"]);
        exit;
    }
}

function validateCSRF() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        $referer = $_SERVER['HTTP_REFERER'] ?? '';
        
        $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $expected = $scheme . '://' . $_SERVER['HTTP_HOST'];
        
        $valid = false;
        
        if ($origin) {
            $valid = ($origin === $expected);
        } elseif ($referer) {
            $refererBase = parse_url($referer, PHP_URL_SCHEME) . '://' . parse_url($referer, PHP_URL_HOST);
            if (parse_url($referer, PHP_URL_PORT)) {
                $refererBase .= ':' . parse_url($referer, PHP_URL_PORT);
            }
            $valid = ($refererBase === $expected);
        }
        
        if (!$valid) {
            error_log("CSRF check failed - Origin: $origin, Referer: $referer, Expected: $expected");
            http_response_code(403);
            echo json_encode(["status" => "error", "mensagem" => "Requisição inválida"]);
            exit;
        }
    }
}

function getUserId() {
    return $_SESSION['id_usuario'] ?? null;
}

function getUserType() {
    return $_SESSION['tipo'] ?? null;
}

function setSession($id_usuario, $tipo) {
    $_SESSION['id_usuario'] = $id_usuario;
    $_SESSION['tipo'] = $tipo;
}

function destroySession() {
    $_SESSION = [];
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }
    session_destroy();
}
