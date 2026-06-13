<?php

class AuthMiddleware{
    public static function check(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }   

        if (!isset($_SESSION['usuario_escola'])){
            Response::json(["error" => "Acesso negado"], 401);
            exit;
        }
    }
}