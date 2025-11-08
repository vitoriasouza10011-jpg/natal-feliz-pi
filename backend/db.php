<?php
$db_path = __DIR__ . '/../database/natal.db';

try {
    $pdo = new PDO("sqlite:$db_path");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e){
    die("Erro ao conectar ao banco: " . $e->getMessage());
}
