<?php
require_once __DIR__ . '/../Utils/Response.php';

class AuthMiddleware
{
    public static function check()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario_escola'])) {
            Response::json(["error" => "Acesso negado"], 401);
            exit;
        }
        $usuario = $_SESSION['usuario_escola'];
        if ($usuario['status_atividade'] !== 1) {
            session_destroy();
            Response::json(["error" => "Sua conta está inativa. Procure a administração."], 403);
            exit;
        }
    }
}
