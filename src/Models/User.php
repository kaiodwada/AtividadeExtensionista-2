<?php

require_once __DIR__ . '/../Config/Database.php';
//require_once __DIR__ . '/../Controllers/StudentController.php';
require_once __DIR__ . '/../Controllers/DirectorController.php';
//require_once __DIR__ . '/../Controllers/ProfessorController.php';

class User
{
    private $db;

    public function __construct($connection = null)
    {
        if ($connection !== null) {
            $this->db = $connection;
        } else {
            $this->db = Database::connect();
        }
    }

    public function login($matr, $senha)
    {
        $stmt = $this->db->prepare('SELECT id_usuario, 
                                           matricula_usuario,
                                           senha_hash, 
                                           tipo_usuario,
                                           status_conta,
                                           data_criacao 
                                  FROM Usuarios WHERE matricula_usuario = :id;');
        $stmt->execute(['id' => $matr]);
        $login = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($matr === $login['matricula_usuario'] && password_verify($senha, $login['senha_hash'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['usuario_escola'] = [
                'id' => $login['id_usuario'],
                'tipo' => $login['tipo_usuario'],
                'matr' => $login['matricula_usuario']
            ];

            Response::json(["message" => "Acesso concedido", "redirect" => $login['tipo_usuario']], 200);
        } else {
            Response::json(["error" => "Matrícula ou senha inválida", "login" => $login['matricula_usuario'], $login['senha_hash'], "matr" => $matr, "senha" => $senha], 404);
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
        return Response::json(["message" => "Sessão encerrada"], 200);
    }

    public function all()
    {
        return $this->db
            ->query('SELECT * FROM usuarios')
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM usuarios WHERE id_usuario = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare(
            'INSERT INTO usuarios (matricula_usuario,senha_hash,tipo_usuario,status_conta) VALUES (?,?,?,?)'
        );
        $stmt->execute([
            $data['matricula_usuario'],
            password_hash($data['senha_hash'], PASSWORD_DEFAULT),
            $data['tipo_usuario'],
            $data['status_conta'],
        ]);
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare(
            'UPDATE diretor SET matricula = ?,nome = ?,nivelAcesso = ? WHERE id_diretor = ?'
        );
        return $stmt->execute([
            $data['matricula'],
            $data['nome'],
            $data['nivelAcesso'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare('DELETE FROM diretor WHERE id_diretor = ?');
        return $stmt->execute([$id]);
    }

    public function setConnection($connection)
    {
        $this->db = $connection;
    }
}
